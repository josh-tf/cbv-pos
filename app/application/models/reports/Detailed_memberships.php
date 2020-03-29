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
                array('date_paid' => $this->lang->line('sales_date')),
                array('vol_full_name' => $this->lang->line('common_full_name')),
                array('email_adr' => $this->lang->line('common_email')),
                array('amount_paid' => $this->lang->line('sales_total'))
            ));

        return $columns;
    }

    public function getData(array $inputs)
    {

        $this->db->select('
                        sales.sale_time as date_paid,
                        concat(people.first_name," ",people.last_name) as vol_full_name,
                        people.email as email_adr,
                        sales_items.item_unit_price as amount_paid
                        ');
        $this->db->from('sales_items AS sales_items');
        $this->db->join('sales AS sales', 'sales.sale_id = sales_items.sale_id', 'inner');
        $this->db->join('people AS people', 'people.person_id = sales.customer_id', 'inner');
        $this->db->join('customers AS customers', 'customers.person_id = people.person_id', 'inner');

        // Only include Membership item, add
        $this->db->where('sales_items.item_id = 9');

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