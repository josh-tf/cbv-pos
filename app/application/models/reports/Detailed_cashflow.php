<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once "Report.php";

class Detailed_cashflow extends Report
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
                array('cash_totals' => $this->lang->line('sales_cash_totals'), 'sorter' => 'number_sorter'),
                array('card_totals' => $this->lang->line('sales_card_totals'))
            ));

        return $columns;
    }

    public function getData(array $inputs)
    {
        $this->db->select('
                            sum(
                                CASE WHEN     payments.payment_type = "Cash"
                                OR             payments.payment_type = "Cheque"
                                THEN            payments.payment_amount ELSE 0 END) as cash_totals,

                            sum(
                                CASE WHEN      payments.payment_type = "Debit/Credit Card"
                                THEN            payments.payment_amount ELSE 0 END) as card_totals,

                            date(sales.sale_time) as sale_time
                        ');

        $this->db->from('sales_payments AS payments');
        $this->db->join('sales AS sales', 'sales.sale_id = payments.sale_id', 'inner');

        // only show completed sales (exclude suspended and canceled)
        $this->db->where('sales.sale_type = 0');

        // group by the sale date
        $this->db->group_by('date(sales.sale_time)');

        // sale date (ignore time) between parameters
        $this->db->where('date(`sale_time`) BETWEEN ' . $this->db->escape(rawurldecode($inputs['start_date'])) . ' AND ' . $this->db->escape(rawurldecode($inputs['end_date'])));

        $data = array();
        $data['summary'] = $this->db->get()->result_array();

        return $data;
    }

    public function getSummaryData(array $inputs)
    {
        $this->db->select('
                            sum(
                                CASE WHEN     payments.payment_type = "Cash"
                                OR             payments.payment_type = "Cheque"
                                THEN            payments.payment_amount ELSE 0 END) as cash_totals,

                            sum(
                                CASE WHEN      payments.payment_type = "Debit/Credit Card"
                                THEN            payments.payment_amount ELSE 0 END) as card_totals,

                                sum(payments.payment_amount) as all_totals,

                        ');

        $this->db->from('sales_payments AS payments');
        $this->db->join('sales AS sales', 'sales.sale_id = payments.sale_id', 'inner');

        // only show completed sales (exclude suspended and canceled)
        $this->db->where('sales.sale_type = 0');

        // sale date (ignore time) between parameters
        $this->db->where('date(`sale_time`) BETWEEN ' . $this->db->escape(rawurldecode($inputs['start_date'])) . ' AND ' . $this->db->escape(rawurldecode($inputs['end_date'])));

        return $this->db->get()->row_array();
    }
}
