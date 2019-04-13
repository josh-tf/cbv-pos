<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once 'Persons.php';

class Customers extends Persons
{
    private $_list_id;

    public function __construct()
    {
        parent::__construct('customers');
        $CI = &get_instance();
    }

    public function index()
    {
        $data['table_headers'] = $this->xss_clean(get_customer_manage_table_headers());

        $this->load->view('people/manage', $data);
    }

    public function lookup()
    {
        $conc_id = str_replace(array('-',' '),'',$this->input->post('conc_id_check'));
        $this->data['cus_info'] = $this->Customer->lookup_cus_info($conc_id); // get our customer info
        $this->data['cus_sales'] = $this->Customer->lookup_cus_sales($conc_id); // get our sales list
        $this->load->view('customers/lookup', $this->data); // load the view file , we are passing $data array to view file
    }

    /*
    Gets one row for a customer manage table. This is called using AJAX to update one row.
     */
    public function get_row($row_id)
    {
        $person = $this->Customer->get_info($row_id);

        // retrieve the total amount the customer spent so far together with min, max and average values
        $stats = $this->Customer->get_stats($person->person_id);
        if (empty($stats)) {
            //create object with empty properties.
            $stats = new stdClass;
            $stats->total = 0;
            $stats->min = 0;
            $stats->max = 0;
            $stats->average = 0;
            $stats->total_discount = 0;
            $stats->quantity = 0;
        }

        $data_row = $this->xss_clean(get_customer_data_row($person, $stats));

        echo json_encode($data_row);
    }

    // redirect handler for the Concession ID lookup
    public function redir()
    {
        $this->load->view('customers/redir'); // load the view file , we are passing $data array to view file
    }

    /*
    Returns customer table data rows. This will be called with AJAX.
     */
    public function search()
    {
        $search = $this->input->get('search');
        $limit = $this->input->get('limit');
        $offset = $this->input->get('offset');
        $sort = $this->input->get('sort');
        $order = $this->input->get('order');

        $customers = $this->Customer->search($search, $limit, $offset, $sort, $order);
        $total_rows = $this->Customer->get_found_rows($search);

        $data_rows = array();
        foreach ($customers->result() as $person) {
            // retrieve the total amount the customer spent so far together with min, max and average values
            $stats = $this->Customer->get_stats($person->person_id);
            if (empty($stats)) {
                //create object with empty properties.
                $stats = new stdClass;
                $stats->total = 0;
                $stats->min = 0;
                $stats->max = 0;
                $stats->average = 0;
                $stats->total_discount = 0;
                $stats->quantity = 0;
            }

            $data_rows[] = $this->xss_clean(get_customer_data_row($person, $stats));
        }

        echo json_encode(array('total' => $total_rows, 'rows' => $data_rows));
    }

    /*
    Gives search suggestions based on what is being searched for
     */
    public function suggest()
    {
        $suggestions = $this->xss_clean($this->Customer->get_search_suggestions($this->input->get('term'), true));

        echo json_encode($suggestions);
    }

    public function suggest_search()
    {
        $suggestions = $this->xss_clean($this->Customer->get_search_suggestions($this->input->post('term'), false));

        echo json_encode($suggestions);
    }

    /*
    Loads the customer edit form
     */
    public function view($customer_id = -1)
    {
        $customer_sales_tax_support = $this->config->item('customer_sales_tax_support');

        $info = $this->Customer->get_info($customer_id);
        foreach (get_object_vars($info) as $property => $value) {
            $info->$property = $this->xss_clean($value);
        }
        $data['person_info'] = $info;
        $data['sales_tax_code_label'] = $info->sales_tax_code . ' ' . $this->Tax->get_info($info->sales_tax_code)->tax_code_name;
        $packages = array('' => $this->lang->line('items_none'));
        foreach ($this->Customer_rewards->get_all()->result_array() as $row) {
            $packages[$this->xss_clean($row['package_id'])] = $this->xss_clean($row['package_name']);
        }
        $data['packages'] = $packages;
        $data['selected_package'] = $info->package_id;

        if ($customer_sales_tax_support == '1') {
            $data['customer_sales_tax_enabled'] = true;
        } else {
            $data['customer_sales_tax_enabled'] = false;
        }

        // retrieve the total amount the customer spent so far together with min, max and average values
        $stats = $this->Customer->get_stats($customer_id);
        if (!empty($stats)) {
            foreach (get_object_vars($stats) as $property => $value) {
                $info->$property = $this->xss_clean($value);
            }
            $data['stats'] = $stats;
        }
        $this->load->view('customers/form', $data);
    }

    /*
    Inserts/updates a customer
     */
    public function save($customer_id = -1)
    {
        $first_name = $this->xss_clean($this->input->post('first_name'));
        $last_name = $this->xss_clean($this->input->post('last_name'));
        $email = $this->xss_clean(strtolower($this->input->post('email')));

        // format first and last name properly
        $first_name = $this->nameize($first_name);
        $last_name = $this->nameize($last_name);

        $person_data = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'gender' => $this->input->post('gender'),
            'email' => $email,
            'phone_number' => $this->input->post('phone_number'),
            'address_1' => $this->input->post('address_1'),
            'suburb' => $this->input->post('suburb'),
            'state' => $this->input->post('state'),
            'postcode' => $this->input->post('postcode'),
            'country' => $this->input->post('country'),
            'comments' => $this->input->post('comments'),
        );

        $customer_data = array(
            'conc_id' => $this->input->post('conc_id') == '' ? null : str_replace(array('-',' '),'',$this->input->post('conc_id')), // when saving a conc ID, remove dash and space
            'company_name' => $this->input->post('company_name') == '' ? null : $this->input->post('company_name'),
            'package_id' => $this->input->post('package_id') == '' ? null : $this->input->post('package_id'),
            'taxable' => 1, // Taxable removed from add customer form - forcing all customers to be tax
            //'taxable' => $this->input->post('taxable') != NULL                           //applicable

        );

        $tax_code = $this->input->post('sales_tax_code');
        if (!isset($tax_code)) {
            $customer_data['sales_tax_code'] = '';
        } else {
            $customer_data['sales_tax_code'] = $tax_code;
        }

        if ($this->Customer->save_customer($person_data, $customer_data, $customer_id)) {
            // New customer
            if ($customer_id == -1) {
                echo json_encode(array('success' => true,
                    'message' => $this->lang->line('customers_successful_adding') . ' ' . $first_name . ' ' . $last_name,
                    'id' => $this->xss_clean($customer_data['person_id'])));
            } else // Existing customer
            {
                echo json_encode(array('success' => true,
                    'message' => $this->lang->line('customers_successful_updating') . ' ' . $first_name . ' ' . $last_name,
                    'id' => $customer_id));
            }
        } else // Failure
        {
            echo json_encode(array('success' => false,
                'message' => $this->lang->line('customers_error_adding_updating') . ' ' . $first_name . ' ' . $last_name . ' (' . $customer_data['company_name'] . ')',
                'id' => -1));
        }
    }

    /*
    AJAX call to verify if an email address already exists
     */
    public function ajax_check_email()
    {
        $exists = $this->Customer->check_email_exists(strtolower($this->input->post('email')), $this->input->post('person_id'));

        echo !$exists ? 'true' : 'false';
    }

    /*
    AJAX call to verify if an concession ID already exists
     */
    public function ajax_check_conc_id()
    {
        $exists = $this->Customer->check_conc_id_exists($this->input->post('conc_id'), $this->input->post('person_id'));

        echo !$exists ? 'true' : 'false';
    }

    /*
    This deletes customers from the customers table
     */
    public function delete()
    {
        $customers_to_delete = $this->input->post('ids');
        $customers_info = $this->Customer->get_multiple_info($customers_to_delete);

        if ($this->Customer->delete_list($customers_to_delete)) {

            echo json_encode(array('success' => true,
                'message' => $this->lang->line('customers_successful_deleted') . ' ' . count($customers_to_delete) . ' ' . $this->lang->line('customers_one_or_multiple')));
        } else {
            echo json_encode(array('success' => false, 'message' => $this->lang->line('customers_cannot_be_deleted')));
        }
    }

    /*
    Customers import from excel spreadsheet
     */
    public function excel()
    {
        $name = 'import_customers.csv';
        $data = file_get_contents('../' . $name);
        force_download($name, $data);
    }

    public function excel_import()
    {
        $this->load->view('customers/form_excel_import', null);
    }

    public function do_excel_import()
    {
        if ($_FILES['file_path']['error'] != UPLOAD_ERR_OK) {
            echo json_encode(array('success' => false, 'message' => $this->lang->line('customers_excel_import_failed')));
        } else {
            if (($handle = fopen($_FILES['file_path']['tmp_name'], 'r')) !== false) {
                // Skip the first row as it's the table description
                fgetcsv($handle);
                $i = 1;

                $failCodes = array();

                while (($data = fgetcsv($handle)) !== false) {
                    // XSS file data sanity check
                    $data = $this->xss_clean($data);

                    if (sizeof($data) >= 14) {
                        $email = strtolower($data[3]);
                        $person_data = array(
                            'first_name' => $data[0],
                            'last_name' => $data[1],
                            'gender' => $data[2],
                            'email' => $email,
                            'phone_number' => $data[4],
                            'address_1' => $data[5],
                            'address_2' => $data[6],
                            'suburb' => $data[7],
                            'state' => $data[8],
                            'postcode' => $data[9],
                            'country' => $data[10],
                            'comments' => $data[11],
                        );

                        $customer_data = array(
                            'company_name' => $data[12],
                            'taxable' => $data[14] == '' ? 0 : 1,
                        );
                        $conc_id = $data[13];

                        // don't duplicate people with same email
                        $invalidated = $this->Customer->check_email_exists($email);
                        if ($conc_id != '') {
                            $customer_data['conc_id'] = $conc_id;
                            $invalidated &= $this->Customer->check_conc_id_exists($conc_id);
                        }
                    } else {
                        $invalidated = true;
                    }

                    if ($invalidated) {
                        $failCodes[] = $i;
                    } else {
                        $failCodes[] = $i;
                    }

                    ++$i;
                }

                if (count($failCodes) > 0) {
                    $message = $this->lang->line('customers_excel_import_partially_failed') . ' (' . count($failCodes) . '): ' . implode(', ', $failCodes);

                    echo json_encode(array('success' => false, 'message' => $message));
                } else {
                    echo json_encode(array('success' => true, 'message' => $this->lang->line('customers_excel_import_success')));
                }
            } else {
                echo json_encode(array('success' => false, 'message' => $this->lang->line('customers_excel_import_nodata_wrongformat')));
            }
        }
    }
}
