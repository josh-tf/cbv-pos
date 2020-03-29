<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once "Report.php";

class Detailed_memberships extends Report
{
    public function create(array $inputs)
    {
        //Create our temp tables to work with the data in our report
        $this->Receiving->create_temp_table($inputs);
    }

    public function getDataColumns()
    {
        $columns = array(
            'summary' => array(
                array('sale_time' => $this->lang->line('sales_date')),
                array('item_name' => $this->lang->line('common_id'), 'sorter' => 'number_sorter'),
                array('item_category' => $this->lang->line('items_category')),
                array('item_description' => $this->lang->line('items_description')),
                array('item_total' => $this->lang->line('sales_total'), 'sorter' => 'number_sorter'),
                array('customer_name' => $this->lang->line('customers_customer')),
                array('customer_phone' => $this->lang->line('common_phone_number'), 'sorter' => 'number_sorter'),
                array('customer_email' => $this->lang->line('common_email')),
                array('customer_address' => $this->lang->line('common_address_1'))
            ));

        return $columns;
    }

    public function getData(array $inputs)
    {
        $this->db->select('
                            DATE(sales.sale_time) as sale_time,
                            items.name as item_name,
                            items.category as item_category,
                            items.Description as item_description,
                            sales_items.item_unit_price as item_total,
                            customers.first_name as customer_name_first,
                            customers.last_name as customer_name_last,
                            customers.phone_number as customer_phone,
                            customers.email as customer_email,
                            customers.address_1 as customer_address
                        ');
        $this->db->from('sales_items AS sales_items');
        $this->db->join('sales AS sales', 'sales.sale_id = sales_items.sale_id', 'inner');
        $this->db->join('items AS items', 'items.item_id = sales_items.item_id', 'inner');
        $this->db->join('people AS customers', 'customers.person_id = sales.customer_id', 'inner');

        // laptop and desktop only
        $this->db->where('items.category in("Laptop", "Desktop")');

        // only include completed sales - exclude canceled or suspended (Trello: cUKS2cR2)
        $this->db->where('sales.sale_status = 0');

        // sale date (ignore time) between parameters
        $this->db->where('date(`sale_time`) BETWEEN ' . $this->db->escape(rawurldecode($inputs['start_date'])) . ' AND ' . $this->db->escape(rawurldecode($inputs['end_date'])));

        $data = array();
        $data['summary'] = $this->db->get()->result_array();

        return $data;
    }

    public function getSummaryData(array $inputs)
    {
        return null;
    }
}