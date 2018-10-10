<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("Persons.php");

class Customers extends Persons
{
	private $_list_id;

	public function __construct()
	{
		parent::__construct('customers');
		$CI =& get_instance();
	}

	public function index()
	{
		$data['table_headers'] = $this->xss_clean(get_customer_manage_table_headers());

		$this->load->view('people/manage', $data);
	}

	/*
	Gets one row for a customer manage table. This is called using AJAX to update one row.
	*/
	public function get_row($row_id)
	{
		$person = $this->Customer->get_info($row_id);

		// retrieve the total amount the customer spent so far together with min, max and average values
		$stats = $this->Customer->get_stats($person->person_id);
		if(empty($stats))
		{
			//create object with empty properties.
			$stats = new stdClass;
			$stats->total = 0;
			$stats->min = 0;
			$stats->max = 0;
			$stats->average = 0;
			$stats->avg_discount = 0;
			$stats->quantity = 0;
		}

		$data_row = $this->xss_clean(get_customer_data_row($person, $stats));

		echo json_encode($data_row);
	}

	/*
	Returns customer table data rows. This will be called with AJAX.
	*/
	public function search()
	{
		$search = $this->input->get('search');
		$limit  = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$sort   = $this->input->get('sort');
		$order  = $this->input->get('order');

		$customers = $this->Customer->search($search, $limit, $offset, $sort, $order);
		$total_rows = $this->Customer->get_found_rows($search);

		$data_rows = array();
		foreach($customers->result() as $person)
		{
			// retrieve the total amount the customer spent so far together with min, max and average values
			$stats = $this->Customer->get_stats($person->person_id);
			if(empty($stats))
			{
				//create object with empty properties.
				$stats = new stdClass;
				$stats->total = 0;
				$stats->min = 0;
				$stats->max = 0;
				$stats->average = 0;
				$stats->avg_discount = 0;
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
		$suggestions = $this->xss_clean($this->Customer->get_search_suggestions($this->input->get('term'), TRUE));

		echo json_encode($suggestions);
	}

	public function suggest_search()
	{
		$suggestions = $this->xss_clean($this->Customer->get_search_suggestions($this->input->post('term'), FALSE));

		echo json_encode($suggestions);
	}

	/*
	Loads the customer edit form
	*/
	public function view($customer_id = -1)
	{
		$customer_sales_tax_support = $this->config->item('customer_sales_tax_support');

		$info = $this->Customer->get_info($customer_id);
		foreach(get_object_vars($info) as $property => $value)
		{
			$info->$property = $this->xss_clean($value);
		}
		$data['person_info'] = $info;
		$data['sales_tax_code_label'] = $info->sales_tax_code . ' ' . $this->Tax->get_info($info->sales_tax_code)->tax_code_name;
		$packages = array('' => $this->lang->line('items_none'));
		foreach($this->Customer_rewards->get_all()->result_array() as $row)
		{
			$packages[$this->xss_clean($row['package_id'])] = $this->xss_clean($row['package_name']);
		}
		$data['packages'] = $packages;
		$data['selected_package'] = $info->package_id;

		if($customer_sales_tax_support == '1')
		{
			$data['customer_sales_tax_enabled'] = TRUE;
		}
		else
		{
			$data['customer_sales_tax_enabled'] = FALSE;
		}

		// retrieve the total amount the customer spent so far together with min, max and average values
		$stats = $this->Customer->get_stats($customer_id);
		if(!empty($stats))
		{
			foreach(get_object_vars($stats) as $property => $value)
			{
				$info->$property = $this->xss_clean($value);
			}
			$data['stats'] = $stats;
		}
		$this->load->view("customers/form", $data);
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
			'city' => $this->input->post('city'),
			'state' => $this->input->post('state'),
			'zip' => $this->input->post('zip'),
			'country' => $this->input->post('country'),
			'comments' => $this->input->post('comments')
		);

		$customer_data = array(
			'account_number' => $this->input->post('account_number') == '' ? NULL : $this->input->post('account_number'),
			'company_name' => $this->input->post('company_name') == '' ? NULL : $this->input->post('company_name'),
			'discount_percent' => $this->input->post('discount_percent') == '' ? 0.00 : $this->input->post('discount_percent'),
			'package_id' => $this->input->post('package_id') == '' ? NULL : $this->input->post('package_id'),
			'taxable' => 1  // Taxable removed from add customer form - forcing all customers to be tax
			//'taxable' => $this->input->post('taxable') != NULL                           //applicable

		);

		$tax_code = $this->input->post('sales_tax_code');
		if(!isset($tax_code))
		{
			$customer_data['sales_tax_code'] = '';
		}
		else
		{
			$customer_data['sales_tax_code'] = $tax_code;
		}

		if($this->Customer->save_customer($person_data, $customer_data, $customer_id))
		{
			// New customer
			if($customer_id == -1)
			{
				echo json_encode(array('success' => TRUE,
								'message' => $this->lang->line('customers_successful_adding') . ' ' . $first_name . ' ' . $last_name,
								'id' => $this->xss_clean($customer_data['person_id'])));
			}
			else // Existing customer
			{
				echo json_encode(array('success' => TRUE,
								'message' => $this->lang->line('customers_successful_updating') . ' ' . $first_name . ' ' . $last_name,
								'id' => $customer_id));
			}
		}
		else // Failure
		{
			echo json_encode(array('success' => FALSE,
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

	public function ajax_check_concession()
	{
		$exists = $this->Customer->check_concession_exists($this->input->post('company_name'));

		echo !$exists ? 'true' : 'false';
	}

	/*
	AJAX call to verify if an account number already exists
	*/
	public function ajax_check_account_number()
	{
		$exists = $this->Customer->check_account_number_exists($this->input->post('account_number'), $this->input->post('person_id'));

		echo !$exists ? 'true' : 'false';
	}

	/*
	This deletes customers from the customers table
	*/
	public function delete()
	{
		$customers_to_delete = $this->input->post('ids');
		$customers_info = $this->Customer->get_multiple_info($customers_to_delete);

		if($this->Customer->delete_list($customers_to_delete))
		{

			echo json_encode(array('success' => TRUE,
				'message' => $this->lang->line('customers_successful_deleted') . ' ' . count($customers_to_delete) . ' ' . $this->lang->line('customers_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success' => FALSE, 'message' => $this->lang->line('customers_cannot_be_deleted')));
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
		$this->load->view('customers/form_excel_import', NULL);
	}

	public function do_excel_import()
	{
		if($_FILES['file_path']['error'] != UPLOAD_ERR_OK)
		{
			echo json_encode(array('success' => FALSE, 'message' => $this->lang->line('customers_excel_import_failed')));
		}
		else
		{
			if(($handle = fopen($_FILES['file_path']['tmp_name'], 'r')) !== FALSE)
			{
				// Skip the first row as it's the table description
				fgetcsv($handle);
				$i = 1;

				$failCodes = array();

				while(($data = fgetcsv($handle)) !== FALSE)
				{
					// XSS file data sanity check
					$data = $this->xss_clean($data);

					if(sizeof($data) >= 15)
					{
						$email = strtolower($data[3]);
						$person_data = array(
							'first_name'	=> $data[0],
							'last_name'		=> $data[1],
							'gender'		=> $data[2],
							'email'			=> $email,
							'phone_number'	=> $data[4],
							'address_1'		=> $data[5],
							'address_2'		=> $data[6],
							'city'			=> $data[7],
							'state'			=> $data[8],
							'zip'			=> $data[9],
							'country'		=> $data[10],
							'comments'		=> $data[11]
						);

						$customer_data = array(
							'company_name'		=> $data[12],
							'discount_percent'	=> $data[14],
							'taxable'			=> $data[15] == '' ? 0 : 1
						);
						$account_number = $data[13];

						// don't duplicate people with same email
						$invalidated = $this->Customer->check_email_exists($email);

						// don't duplicate people with same email
						$invalidated = $this->Customer->check_concession_exists($company_name);

						if($account_number != '')
						{
							$customer_data['account_number'] = $account_number;
							$invalidated &= $this->Customer->check_account_number_exists($account_number);
						}
					}
					else
					{
						$invalidated = TRUE;
					}

					if($invalidated)
					{
						$failCodes[] = $i;
					}
					else
					{
						$failCodes[] = $i;
					}

					++$i;
				}

				if(count($failCodes) > 0)
				{
					$message = $this->lang->line('customers_excel_import_partially_failed') . ' (' . count($failCodes) . '): ' . implode(', ', $failCodes);

					echo json_encode(array('success' => FALSE, 'message' => $message));
				}
				else
				{
					echo json_encode(array('success' => TRUE, 'message' => $this->lang->line('customers_excel_import_success')));
				}
			}
			else
			{
				echo json_encode(array('success' => FALSE, 'message' => $this->lang->line('customers_excel_import_nodata_wrongformat')));
			}
		}
	}
}
?>
