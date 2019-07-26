<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once 'Secure_Controller.php';

class Items extends Secure_Controller
{
    public function __construct()
    {
        parent::__construct('items');

        $this->load->library('item_lib');
    }

    public function index()
    {
        $data['table_headers'] = $this->xss_clean(get_items_manage_table_headers());

        $data['stock_location'] = $this->xss_clean($this->item_lib->get_item_location());
        $data['stock_locations'] = $this->xss_clean($this->Stock_location->get_allowed_locations());

        // filters that will be loaded in the multiselect dropdown
        $data['filters'] = array(
            'cat_avail_computer' => $this->lang->line('items_cat_avail_computer'),
            'cat_sold_computer' => $this->lang->line('items_cat_sold_computer'),
            'cat_hold_computer' => $this->lang->line('items_cat_hold_computer'),
            'in_stock' => $this->lang->line('items_in_stock'),
            'in_stock_all' => $this->lang->line('items_in_stock_all'),
            'out_stock' => $this->lang->line('items_out_stock'),
            'out_stock_all' => $this->lang->line('items_out_stock_all'),
            'is_deleted' => $this->lang->line('items_is_deleted'));

        $this->load->view('items/manage', $data);
    }

    public function stocklist()
    {
        $this->data['stocklist'] = $this->Item->get_stocklist(); // calling Item model method get_stocklist()
        $this->load->view('items/stocklist', $this->data); // load the view file , we are passing $data array to view file
    }

    public function sales_ticket()
    {
        $cbvid_check = $this->input->post('cbvid_check');
        $this->data['cbvid_check'] = $this->Item->get_sales_ticket($cbvid_check); // calling Item model method get_stocklist()
        $this->load->view('items/sales_ticket', $this->data); // load the view file , we are passing $data array to view file
    }

    // redirect handler for the CBV ID lookup
    public function redir()
    {
        $this->load->view('items/redir'); // load the view file , we are passing $data array to view file
    }

    /*
    Returns Items table data rows. This will be called with AJAX.
     */
    public function search()
    {
        $search = $this->input->get('search');
        $limit = $this->input->get('limit');
        $offset = $this->input->get('offset');
        $sort = $this->input->get('sort');
        $order = $this->input->get('order');

        $this->item_lib->set_item_location($this->input->get('stock_location'));

        $filters = array('start_date' => $this->input->get('start_date'),
            'end_date' => $this->input->get('end_date'),
            'stock_location_id' => $this->item_lib->get_item_location(),
            'in_stock' => false,
            'in_stock_all' => false,
            'out_stock' => false,
            'out_stock_all' => false,
            'cat_avail_computer' => false,
            'cat_sold_computer' => false,
            'cat_hold_computer' => false,
            'is_deleted' => false);

        // check if any filter is set in the multiselect dropdown
        $filledup = array_fill_keys($this->input->get('filters'), true);
        $filters = array_merge($filters, $filledup);

        $items = $this->Item->search($search, $filters, $limit, $offset, $sort, $order);

        $total_rows = $this->Item->get_found_rows($search, $filters);

        $data_rows = array();
        foreach ($items->result() as $item) {
            $data_rows[] = $this->xss_clean(get_item_data_row($item));
            if ($item->pic_filename != '') {
                $this->_update_pic_filename($item);
            }
        }

        echo json_encode(array('total' => $total_rows, 'rows' => $data_rows));
    }

    public function pic_thumb($pic_filename)
    {
        $this->load->helper('file');
        $this->load->library('image_lib');

        // in this context, $pic_filename always has .ext
        $ext = pathinfo($pic_filename, PATHINFO_EXTENSION);
        $images = glob('./uploads/item_pics/' . $pic_filename);

        // make sure we pick only the file name, without extension
        $base_path = './uploads/item_pics/' . pathinfo($pic_filename, PATHINFO_FILENAME);
        if (sizeof($images) > 0) {
            $image_path = $images[0];
            $thumb_path = $base_path . $this->image_lib->thumb_marker . '.' . $ext;
            if (sizeof($images) < 2) {
                $config['image_library'] = 'gd2';
                $config['source_image'] = $image_path;
                $config['maintain_ratio'] = true;
                $config['create_thumb'] = true;
                $config['width'] = 52;
                $config['height'] = 32;
                $this->image_lib->initialize($config);
                $image = $this->image_lib->resize();
                $thumb_path = $this->image_lib->full_dst_path;
            }
            $this->output->set_content_type(get_mime_by_extension($thumb_path));
            $this->output->set_output(file_get_contents($thumb_path));
        }
    }

    /*
    Gives search suggestions based on what is being searched for
     */
    public function suggest_search()
    {
        $suggestions = $this->xss_clean($this->Item->get_search_suggestions($this->input->post_get('term'),
            array('search_custom' => $this->input->post('search_custom'), 'is_deleted' => $this->input->post('is_deleted') != null), false, 25, true));

        echo json_encode($suggestions);
    }

    public function suggest()
    {
        $suggestions = $this->xss_clean($this->Item->get_search_suggestions($this->input->post_get('term'),
            array('search_custom' => false, 'is_deleted' => false), true));

        echo json_encode($suggestions);
    }

    public function suggest_kits()
    {
        $suggestions = $this->xss_clean($this->Item->get_kit_search_suggestions($this->input->post_get('term'),
            array('search_custom' => false, 'is_deleted' => false), true));

        echo json_encode($suggestions);
    }

    /*
    Gives search suggestions based on what is being searched for
     */
    public function suggest_category()
    {
        $suggestions = $this->xss_clean($this->Item->get_category_suggestions($this->input->get('term')));

        echo json_encode($suggestions);
    }

    /*
    Gives search suggestions based on what is being searched for
     */
    public function suggest_location()
    {
        $suggestions = $this->xss_clean($this->Item->get_location_suggestions($this->input->get('term')));

        echo json_encode($suggestions);
    }

    /*
    Gives search suggestions based on what is being searched for
     */
    public function suggest_custom()
    {
        $suggestions = $this->xss_clean($this->Item->get_custom_suggestions($this->input->post('term'), $this->input->post('field_no')));

        echo json_encode($suggestions);
    }

    public function get_row($item_ids)
    {
        $item_infos = $this->Item->get_multiple_info(explode(':', $item_ids), $this->item_lib->get_item_location());

        $result = array();
        foreach ($item_infos->result() as $item_info) {
            $result[$item_info->item_id] = $this->xss_clean(get_item_data_row($item_info));
        }

        echo json_encode($result);
    }

    public function view($item_id = -1)
    {
        $data['item_tax_info'] = $this->xss_clean($this->Item_taxes->get_info($item_id));
        $data['default_tax_1_rate'] = $this->config->item('default_tax_1_rate'); // Passing down the tax rate regardless of whether or not this is a new item. Doesn't seem to break anything.
        $data['default_tax_2_rate'] = $this->config->item('default_tax_2_rate');
        $data['item_kits_enabled'] = $this->Employee->has_grant('item_kits', $this->Employee->get_logged_in_employee_info()->person_id);

        $item_info = $this->Item->get_info($item_id);
        foreach (get_object_vars($item_info) as $property => $value) {
            $item_info->$property = $this->xss_clean($value);
        }

        if ($item_id == -1) {

            $item_info->receiving_quantity = 1;
            $item_info->reorder_level = 0;
            $item_info->item_type = ITEM; // standard
            $item_info->stock_type = HAS_STOCK;
            $item_info->tax_category_id = 1; // Standard
        }

        $data['item_info'] = $item_info;

        $suppliers = array('' => $this->lang->line('items_none'));
        foreach ($this->Supplier->get_all()->result_array() as $row) {
            $suppliers[$this->xss_clean($row['person_id'])] = $this->xss_clean($row['company_name']);
        }
        $data['suppliers'] = $suppliers;
        $data['selected_supplier'] = $item_info->supplier_id;

        $customer_sales_tax_support = $this->config->item('customer_sales_tax_support');
        if ($customer_sales_tax_support == '1') {
            $data['customer_sales_tax_enabled'] = true;
            $tax_categories = array();
            foreach ($this->Tax->get_all_tax_categories()->result_array() as $row) {
                $tax_categories[$this->xss_clean($row['tax_category_id'])] = $this->xss_clean($row['tax_category']);
            }
            $data['tax_categories'] = $tax_categories;
            $data['selected_tax_category'] = $item_info->tax_category_id;
        } else {
            $data['customer_sales_tax_enabled'] = false;
            $data['tax_categories'] = array();
            $data['selected_tax_category'] = '';
        }

        $data['logo_exists'] = $item_info->pic_filename != '';
        $ext = pathinfo($item_info->pic_filename, PATHINFO_EXTENSION);
        if ($ext == '') {
            // if file extension is not found guess it (legacy)
            $images = glob('./uploads/item_pics/' . $item_info->pic_filename . '.*');
        } else {
            // else just pick that file
            $images = glob('./uploads/item_pics/' . $item_info->pic_filename);
        }
        $data['image_path'] = sizeof($images) > 0 ? base_url($images[0]) : '';
        $stock_locations = $this->Stock_location->get_undeleted_all()->result_array();
        foreach ($stock_locations as $location) {
            $location = $this->xss_clean($location);

            $quantity = $this->xss_clean($this->Item_quantity->get_item_quantity($item_id, $location['location_id'])->quantity);
            $quantity = ($item_id == -1) ? 1 : $quantity;
            $location_array[$location['location_id']] = array('location_name' => $location['location_name'], 'quantity' => $quantity);
            $data['stock_locations'] = $location_array;
        }

        $this->load->view('items/form', $data);
    }

    public function inventory($item_id = -1)
    {
        $item_info = $this->Item->get_info($item_id);
        foreach (get_object_vars($item_info) as $property => $value) {
            $item_info->$property = $this->xss_clean($value);
        }
        $data['item_info'] = $item_info;

        $data['stock_locations'] = array();
        $stock_locations = $this->Stock_location->get_undeleted_all()->result_array();
        foreach ($stock_locations as $location) {
            $location = $this->xss_clean($location);
            $quantity = $this->xss_clean($this->Item_quantity->get_item_quantity($item_id, $location['location_id'])->quantity);

            $data['stock_locations'][$location['location_id']] = $location['location_name'];
            $data['item_quantities'][$location['location_id']] = $quantity;
        }

        $this->load->view('items/form_inventory', $data);
    }

    public function count_details($item_id = -1)
    {
        $item_info = $this->Item->get_info($item_id);
        foreach (get_object_vars($item_info) as $property => $value) {
            $item_info->$property = $this->xss_clean($value);
        }
        $data['item_info'] = $item_info;

        $data['stock_locations'] = array();
        $stock_locations = $this->Stock_location->get_undeleted_all()->result_array();
        foreach ($stock_locations as $location) {
            $location = $this->xss_clean($location);
            $quantity = $this->xss_clean($this->Item_quantity->get_item_quantity($item_id, $location['location_id'])->quantity);

            $data['stock_locations'][$location['location_id']] = $location['location_name'];
            $data['item_quantities'][$location['location_id']] = $quantity;
        }

        $this->load->view('items/form_count_details', $data);
    }

    public function generate_barcodes($item_ids)
    {
        $this->load->library('barcode_lib');

        $item_ids = explode(':', $item_ids);
        $result = $this->Item->get_multiple_info($item_ids, $this->item_lib->get_item_location())->result_array();
        $config = $this->barcode_lib->get_barcode_config();

        $data['barcode_config'] = $config;

        // check the list of items to see if any item_number field is empty
        foreach ($result as &$item) {
            $item = $this->xss_clean($item);

            // update the barcode field if empty / NULL with the newly generated barcode
            if (empty($item['item_number']) && $this->config->item('barcode_generate_if_empty')) {
                // get the newly generated barcode
                $barcode_instance = Barcode_lib::barcode_instance($item, $config);
                $item['item_number'] = $barcode_instance->getData();

                $save_item = array('item_number' => $item['item_number']);

                // update the item in the database in order to save the barcode field
                $this->Item->save($save_item, $item['item_id']);
            }
        }
        $data['items'] = $result;

        // display barcodes
        $this->load->view('barcodes/barcode_sheet', $data);
    }

    public function bulk_edit()
    {
        $suppliers = array('' => $this->lang->line('items_none'));
        foreach ($this->Supplier->get_all()->result_array() as $row) {
            $row = $this->xss_clean($row);

            $suppliers[$row['person_id']] = $row['company_name'];
        }
        $data['suppliers'] = $suppliers;
        $data['allow_alt_description_choices'] = array(
            '' => $this->lang->line('items_do_nothing'),
            1 => $this->lang->line('items_change_all_to_allow_alt_desc'),
            0 => $this->lang->line('items_change_all_to_not_allow_allow_desc'));

        $data['serialization_choices'] = array(
            '' => $this->lang->line('items_do_nothing'),
            1 => $this->lang->line('items_change_all_to_serialized'),
            0 => $this->lang->line('items_change_all_to_unserialized'));

        $this->load->view('items/form_bulk', $data);
    }

    public function save($item_id = -1)
    {

        $upload_success = $this->_handle_image_upload();
        $upload_data = $this->upload->data();

        //Save item data
        $item_data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'category' => $this->input->post('category'),
            'stock_type' => $this->input->post('stock_type') == null ? HAS_STOCK : $this->input->post('stock_type'),
            'supplier_id' => $this->input->post('supplier_id') == '' ? null : $this->input->post('supplier_id'),
            'item_number' => $this->input->post('item_number') == '' ? null : $this->input->post('item_number'),
            'on_hold' => $this->input->post('on_hold') == false ? false : $this->input->post('on_hold'),
            'hold_for' => $this->input->post('on_hold') == false ? '' : $this->input->post('hold_for'), // if on_hold is not checked then save this as blank
            'unit_price' => parse_decimals($this->input->post('unit_price')),
            'allow_alt_description' => $this->input->post('allow_alt_description') != null,
            'is_serialized' => $this->input->post('is_serialized') != null,
            'deleted' => $this->input->post('is_deleted') != null,
            'custom1' => $this->input->post('custom1') == null ? '' : $this->input->post('custom1'),
            'custom2' => $this->input->post('custom2') == null ? '' : $this->input->post('custom2'),
            'custom3' => $this->input->post('custom3') == null ? '' : $this->input->post('custom3'),
            'custom4' => $this->input->post('custom4') == null ? '' : $this->input->post('custom4'),
            'custom5' => $this->input->post('custom5') == null ? '' : $this->input->post('custom5'),
            'custom6' => $this->input->post('custom6') == null ? '' : $this->input->post('custom6'),
            'custom7' => $this->input->post('custom7') == null ? '' : $this->input->post('custom7'),
            'custom8' => $this->input->post('custom8') == null ? '' : $this->input->post('custom8'),
            'custom9' => $this->input->post('custom9') == null ? '' : $this->input->post('custom9'),
            'custom10' => $this->input->post('custom10') == null ? '' : $this->input->post('custom10'),
            'custom11' => $this->input->post('custom11') == null ? '' : $this->input->post('custom11'),
            'custom12' => $this->input->post('custom12') == null ? '' : $this->input->post('custom12'),
            'custom13' => $this->input->post('custom13') == null ? '' : $this->input->post('custom13'),
            'custom14' => $this->input->post('custom14') == null ? '' : $this->input->post('custom14'),
            'custom15' => $this->input->post('custom15') == null ? '' : $this->input->post('custom15'),
            'custom16' => $this->input->post('custom16') == null ? '' : $this->input->post('custom16'),
            'custom17' => $this->input->post('custom17') == null ? '' : $this->input->post('custom17'),
            'custom18' => $this->input->post('custom18') == null ? '' : $this->input->post('custom18'),
            'custom19' => $this->input->post('custom19') == null ? '' : $this->input->post('custom19'),
            'custom20' => $this->input->post('custom20') == null ? '' : $this->input->post('custom20'),
        );

        $x = $this->input->post('tax_category_id');
        if (!isset($x)) {
            $item_data['tax_category_id'] = '';
        } else {
            $item_data['tax_category_id'] = $this->input->post('tax_category_id');
        }

        if (!empty($upload_data['orig_name'])) {
            // XSS file image sanity check
            if ($this->xss_clean($upload_data['raw_name'], true) === true) {
                $item_data['pic_filename'] = $upload_data['raw_name'];
            }
        }

        if ($item_data['category'] == 'Desktop' || $item_data['category'] == 'Laptop') { // if its a laptop or desktop
            $exists = $this->Item->nameExists($item_data['name']); // check if the item name already exists
            if ($exists && $item_id == -1) { // only check if its a new item
                $message = $this->xss_clean('An item with this name already exists' . ' ' . $item_data['name']);
                echo json_encode(array('success' => false, 'message' => $message, 'id' => $item_id)); // exit with error if it does
                die();
            }
        }

        $employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
        $cur_item_info = $this->Item->get_info($item_id);

        if ($this->Item->save($item_data, $item_id)) {
            $success = true;
            $new_item = false;
            //New item
            if ($item_id == -1) {
                $item_id = $item_data['item_id'];
                $new_item = true;
            }

            $items_taxes_data = array();
            $tax_names = $this->input->post('tax_names');
            $tax_percents = $this->input->post('tax_percents');
            $count = count($tax_percents);
            for ($k = 0; $k < $count; ++$k) {
                $tax_percentage = parse_decimals($tax_percents[$k]);
                if (is_numeric($tax_percentage)) {
                    $items_taxes_data[] = array('name' => $tax_names[$k], 'percent' => $tax_percentage);
                }
            }
            $success &= $this->Item_taxes->save($items_taxes_data, $item_id);

            //Save item quantity
            $stock_locations = $this->Stock_location->get_undeleted_all()->result_array();
            foreach ($stock_locations as $location) {
                $updated_quantity = parse_decimals($this->input->post('quantity_' . $location['location_id']));
                $location_detail = array('item_id' => $item_id,
                    'location_id' => $location['location_id'],
                    'quantity' => $updated_quantity);
                $item_quantity = $this->Item_quantity->get_item_quantity($item_id, $location['location_id']);
                if ($item_quantity->quantity != $updated_quantity || $new_item) {
                    $success &= $this->Item_quantity->save($location_detail, $item_id, $location['location_id']);

                    $inv_data = array(
                        'trans_date' => date('Y-m-d H:i:s'),
                        'trans_items' => $item_id,
                        'trans_user' => $employee_id,
                        'trans_location' => $location['location_id'],
                        'trans_comment' => $this->lang->line('items_manually_editing_of_quantity'),
                        'trans_inventory' => $updated_quantity - $item_quantity->quantity,
                    );

                    $success &= $this->Inventory->insert($inv_data);
                }
            }

            if ($success && $upload_success) {
                $message = $this->xss_clean($this->lang->line('items_successful_' . ($new_item ? 'adding' : 'updating')) . ' ' . $item_data['name']);

                echo json_encode(array('success' => true, 'message' => $message, 'id' => $item_id));
            } else {
                $message = $this->xss_clean($upload_success ? $this->lang->line('items_error_adding_updating') . ' ' . $item_data['name'] : strip_tags($this->upload->display_errors()));

                echo json_encode(array('success' => false, 'message' => $message, 'id' => $item_id));
            }
        } else // failure
        {
            $message = $this->xss_clean($this->lang->line('items_error_adding_updating') . ' ' . $item_data['name']);

            echo json_encode(array('success' => false, 'message' => $message, 'id' => -1));
        }

        // update the stocklist if the url (env) is set AND category is a laptop or desktop
        if (getenv('STOCKLIST_UPDATE_URL')) {

            if (($this->input->post('category') == 'Laptop') || ($this->input->post('category') == 'Desktop')) {

                $request_opts = array(
                    'http' => array(
                        'method' => 'GET',
                    ),
                );

                $context = stream_context_create($request_opts);
                $stocklist_update = file_get_contents(getenv('STOCKLIST_UPDATE_URL'), null, $context);

            }

        }

    }

    public function check_item_number()
    {
        $exists = $this->Item->item_number_exists($this->input->post('item_number'), $this->input->post('item_id'));
        echo !$exists ? 'true' : 'false';
    }

    /*
    If adding a new item check to see if an item kit with the same name as the item already exists.
     */
    public function check_kit_exists()
    {
        if ($this->input->post('item_number') === -1) {
            $exists = $this->Item_kit->item_kit_exists_for_name($this->input->post('name'));
        } else {
            $exists = false;
        }
        echo !$exists ? 'true' : 'false';
    }

    private function _handle_image_upload()
    {
        /* Let files be uploaded with their original name */

        // load upload library
        $config = array('upload_path' => './uploads/item_pics/',
            'allowed_types' => 'gif|jpg|png',
            'max_size' => '100',
            'max_width' => '640',
            'max_height' => '480',
        );
        $this->load->library('upload', $config);
        $this->upload->do_upload('item_image');

        return strlen($this->upload->display_errors()) == 0 || !strcmp($this->upload->display_errors(), '<p>' . $this->lang->line('upload_no_file_selected') . '</p>');
    }

    public function remove_logo($item_id)
    {
        $item_data = array('pic_filename' => null);
        $result = $this->Item->save($item_data, $item_id);

        echo json_encode(array('success' => $result));
    }

    public function save_inventory($item_id = -1)
    {
        $employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
        $cur_item_info = $this->Item->get_info($item_id);
        $location_id = $this->input->post('stock_location');
        $inv_data = array(
            'trans_date' => date('Y-m-d H:i:s'),
            'trans_items' => $item_id,
            'trans_user' => $employee_id,
            'trans_location' => $location_id,
            'trans_comment' => $this->input->post('trans_comment'),
            'trans_inventory' => parse_decimals($this->input->post('newquantity')),
        );

        $this->Inventory->insert($inv_data);

        //Update stock quantity
        $item_quantity = $this->Item_quantity->get_item_quantity($item_id, $location_id);
        $item_quantity_data = array(
            'item_id' => $item_id,
            'location_id' => $location_id,
            'quantity' => $item_quantity->quantity + parse_decimals($this->input->post('newquantity')),
        );

        if ($this->Item_quantity->save($item_quantity_data, $item_id, $location_id)) {
            $message = $this->xss_clean($this->lang->line('items_successful_updating') . ' ' . $cur_item_info->name);

            echo json_encode(array('success' => true, 'message' => $message, 'id' => $item_id));
        } else //failure
        {
            $message = $this->xss_clean($this->lang->line('items_error_adding_updating') . ' ' . $cur_item_info->name);

            echo json_encode(array('success' => false, 'message' => $message, 'id' => -1));
        }
    }

    public function bulk_update()
    {
        $items_to_update = $this->input->post('item_ids');
        $item_data = array();

        foreach ($_POST as $key => $value) {
            //This field is nullable, so treat it differently
            if ($key == 'supplier_id' && $value != '') {
                $item_data['$key'] = $value;
            } elseif ($value != '' && !(in_array($key, array('item_ids', 'tax_names', 'tax_percents')))) {
                $item_data['$key'] = $value;
            }
        }

        //Item data could be empty if tax information is being updated
        if (empty($item_data) || $this->Item->update_multiple($item_data, $items_to_update)) {
            $items_taxes_data = array();
            $tax_names = $this->input->post('tax_names');
            $tax_percents = $this->input->post('tax_percents');
            $tax_updated = false;
            $count = count($tax_percents);
            for ($k = 0; $k < $count; ++$k) {
                if (!empty($tax_names[$k]) && is_numeric($tax_percents[$k])) {
                    $tax_updated = true;

                    $items_taxes_data[] = array('name' => $tax_names[$k], 'percent' => $tax_percents[$k]);
                }
            }

            if ($tax_updated) {
                $this->Item_taxes->save_multiple($items_taxes_data, $items_to_update);
            }

            echo json_encode(array('success' => true, 'message' => $this->lang->line('items_successful_bulk_edit'), 'id' => $this->xss_clean($items_to_update)));
        } else {
            echo json_encode(array('success' => false, 'message' => $this->lang->line('items_error_updating_multiple')));
        }
    }

    public function delete()
    {
        $items_to_delete = $this->input->post('ids');

        if ($this->Item->delete_list($items_to_delete)) {
            $message = $this->lang->line('items_successful_deleted') . ' ' . count($items_to_delete) . ' ' . $this->lang->line('items_one_or_multiple');
            echo json_encode(array('success' => true, 'message' => $message));
        } else {
            echo json_encode(array('success' => false, 'message' => $this->lang->line('items_cannot_be_deleted')));
        }
    }

    /*
    Items import from excel spreadsheet
     */
    public function excel()
    {
        $name = 'import_items.csv';
        $data = file_get_contents('../application/views/items/' . $name);
        force_download($name, $data);
    }

    public function excel_import()
    {
        $this->load->view('items/form_excel_import', null);
    }

    /**
     * Imports items from CSV formatted file.
     */
    public function do_excel_import()
    {
        if ($_FILES['file_path']['error'] != UPLOAD_ERR_OK) {
            echo json_encode(array('success' => false, 'message' => $this->lang->line('items_excel_import_failed')));
        } else {
            if (file_exists($_FILES['file_path']['tmp_name'])) {

                $file_name = $_FILES['file_path']['tmp_name'];

                ini_set("auto_detect_line_endings", true);

                if (($csv_file = fopen($file_name, 'r')) !== false) {
                    //Skip Byte-Order Mark
                    fseek($csv_file, 3);

                    while (($data = fgetcsv($csv_file)) !== false) {
                        $line_array[] = $data;
                    }
                } else {
                    return false;
                }

                $failCodes = array();
                $keys = $line_array[0];

                $this->db->trans_begin();
                for ($i = 1; $i < count($line_array); $i++) {
                    $invalidated = false;
                    $line = array_combine($keys, $this->xss_clean($line_array[$i])); //Build a XSS-cleaned associative array with the row to use to assign values

                    if (!empty($line)) {
                        $item_data = array(

                            'name' => $line['Item Name'],
                            'category' => $line['Item Category'],
                            'unit_price' => $line['Unit Price'],
                            'custom1' => $line['Build Date'],
                            'custom2' => $line['Brand/Model'],
                            'custom3' => $line['CPU Type'],
                            'custom4' => $line['CPU Speed'],
                            'custom5' => $line['RAM'],
                            'custom6' => $line['Storage'],
                            'custom7' => $line['Operating System'],
                            'custom8' => $line['Screen Size'],
                            'custom9' => $line['Optical Drive'],
                            'custom10' => $line['Desktop Type'],
                            'custom11' => $line['Battery Life'],
                            'custom12' => $line['Box Only Price'],
                            'custom13' => $line['Extras'],
                            'custom14' => $line['Other Notes'],
                            'description' => $line['Item Description'],
                        );

                        $item_number                 = 11;

                        if ($item_number != '') {
                            $item_data['item_number'] = $item_number;
                            $invalidated = $this->Item->item_number_exists($item_number);
                        }

                        //Sanity check of data
                        if (!$invalidated) {
                            $invalidated = $this->data_error_check($line, $item_data);
                        }
                    } else {
                        $invalidated = true;
                    }

                    //Save to database
                    if (!$invalidated && $this->Item->save($item_data)) {
                        $this->save_tax_data($line, $item_data);
                        $this->save_inventory_quantities($line, $item_data);
                    } else //insert or update item failure
                    {
                        $failed_row = $i + 1;
                        $failCodes[] = $failed_row;
                        log_message("ERROR", "CSV Item import failed on line " . $failed_row . ". This item was not imported.");
                    }
                }

                if (count($failCodes) > 0) {
                    $message = $this->lang->line('items_excel_import_partially_failed', count($failCodes), implode(', ', $failCodes));
                    $this->db->trans_rollback();
                    echo json_encode(array('success' => false, 'message' => $message));
                } else {
                    $this->db->trans_commit();
                    echo json_encode(array('success' => true, 'message' => $this->lang->line('items_excel_import_success')));
                }
            } else {
                echo json_encode(array('success' => false, 'message' => $this->lang->line('items_excel_import_nodata_wrongformat')));
            }
        }
    }

	/**
	 * Checks the entire line of data for errors
	 *
	 * @param	array	$line
	 * @param 	array	$item_data
	 *
	 * @return	bool	Returns FALSE if all data checks out and TRUE when there is an error in the data
	 */
	private function data_error_check($line, $item_data)
	{
		//Check for empty required fields
		$check_for_empty = array(
			$item_data['name'],
			$item_data['category'],
			$item_data['cost_price'],
			$item_data['unit_price']
		);
		if(in_array('',$check_for_empty,true))
		{
			log_message("ERROR","Empty required value");
			return TRUE;	//Return fail on empty required fields
		}
		//Build array of fields to check for numerics
		$check_for_numeric_values = array(
			$item_data['cost_price'],
			$item_data['unit_price'],
			$item_data['reorder_level'],
			$item_data['supplier_id'],
			$line['Tax 1 Percent'],
			$line['Tax 2 Percent']
		);
		//Add in Stock Location values to check for numeric
		$allowed_locations	= $this->Stock_location->get_allowed_locations();
		foreach($allowed_locations as $location_id => $location_name)
		{
			$check_for_numeric_values[] = $line['location_'. $location_name];
		}
		//Check for non-numeric values which require numeric
		foreach($check_for_numeric_values as $value)
		{
			if(!is_numeric($value) && $value != '')
			{
				log_message("ERROR","non-numeric: '$value' when numeric is required");
				return TRUE;
			}
		}
		//Check Attribute Data
		return FALSE;
    }

    /**
     * Guess whether file extension is not in the table field,
     * if it isn't, then it's an old-format (formerly pic_id) field,
     * so we guess the right filename and update the table
     * @param $item the item to update
     */
    private function _update_pic_filename($item)
    {
        $filename = pathinfo($item->pic_filename, PATHINFO_FILENAME);

        // if the field is empty there's nothing to check
        if (!empty($filename)) {
            $ext = pathinfo($item->pic_filename, PATHINFO_EXTENSION);
            if (empty($ext)) {
                $images = glob('./uploads/item_pics/' . $item->pic_filename . '.*');
                if (sizeof($images) > 0) {
                    $new_pic_filename = pathinfo($images[0], PATHINFO_BASENAME);
                    $item_data = array('pic_filename' => $new_pic_filename);
                    $this->Item->save($item_data, $item->item_id);
                }
            }
        }
    }
}
