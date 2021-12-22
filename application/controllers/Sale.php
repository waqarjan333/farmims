<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */

class Sale extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Sale_model');
    }

    function so()
    {
        $data['_view'] = 'sale/so';
        $this->load->view('layouts/main', $data);
    }

    function invoice(){
        $data['_view'] = 'sale/invoice';
        $this->load->view('layouts/main', $data);    
    }

    function newso()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('customer_id', 'Customer Info', 'required');
        $this->form_validation->set_rules('date', 'Purchase Order Date', 'required');

        if ($this->form_validation->run()) {

            $params = array(
                'order_type' => $this->input->post('order_type'),
                'customer_id' => $this->input->post('customer_id'),
                'date' => date('Y-m-d', strtotime($this->input->post('date'))),
                'order_no' => $this->input->post('order_no'),
                'created_by' => $this->session->userdata('id'),
                'farm_id' => $this->session->userdata('active_farm'),
                'tax_per' => 0, 
                'gross_tot' => $this->input->post('net_total'),
                'net_tot' => $this->input->post('net_total')
            );
            $this->db->insert('sale_orders', $params);
            $so_id = $this->db->insert_id();

            //Create Invoice Journal Entry 1
                   $params1 = array(
                        'acc_number' => '501001',
                        'item_id' =>0,
                        'journal_details' =>'Sale Order Entry',
                        'journal_amount' =>$this->input->post('net_total'),
                        'type' =>'Sale Order'
                    );
         $this->db->insert('account_journal', $params1);
         $lastJournalID= $this->db->insert_id();
          $updateParam = array(
                        'ref_id' => $lastJournalID
                    );


          $this->db->where('journal_id', $lastJournalID);
         $this->db->update('account_journal', $updateParam);

           $params2 = array(
                        'ref_id' => $lastJournalID,
                        'acc_number' => '105001',
                        'item_id' =>0,
                        'journal_details' =>'Sale Order Entry',
                        'journal_amount' =>-1*$this->input->post('net_total'),
                        'type' =>'Sale Order'
                    );
            $this->db->insert('account_journal', $params2); 


            //Create Invoice Journal Entry 2
             $this->db->insert('sale_orders', $params);
            $so_id = $this->db->insert_id();
                   $params1 = array(
                        'acc_number' => '106001',
                        'item_id' =>0,
                        'journal_details' =>'Create Invoice Entry',
                        'journal_amount' =>$this->input->post('net_total'),
                        'type' =>'Sale Invoice'
                    );
         $this->db->insert('account_journal', $params1);
         $lastJournalID= $this->db->insert_id();
          $updateParam = array(
                        'ref_id' => $lastJournalID
                    );


          $this->db->where('journal_id', $lastJournalID);
         $this->db->update('account_journal', $updateParam);

           $params2 = array(
                        'ref_id' => $lastJournalID,
                        'acc_number' => '105001',
                        'item_id' =>0,
                        'journal_details' =>'Create Invoice Entry',
                        'journal_amount' =>-1*$this->input->post('net_total'),
                        'type' =>'Sale Invoice'
                    );
            $this->db->insert('account_journal', $params2); 

            foreach ($_POST['products'] as $key => $value) {
                $podetails[] = array(
                    'so_id' => $so_id,
                    'product_id' => $value,
                    'uom' => $_POST['uom'][$value],
                    'qty' => $_POST['qty'][$value],
                    'rate' => $_POST['rate'][$value],
                    'amount' => $_POST['rate'][$value] * $_POST['qty'][$value],
                    'farm_id' => $this->session->userdata('active_farm')
                );
            }

            $this->db->insert_batch('so_details', $podetails);

            $this->session->set_flashdata('success', 'Sale Order Generated Successfully!');
            redirect('sale/so');
        } else {
            $this->load->model('Parties_model');
            $this->load->model('Product_model');
            $data['customers'] = $this->Parties_model->get_all_customers();
            $data['units'] = $this->Parties_model->get_all_units();
            $data['order_no'] = $this->Parties_model->get_socode();
            $data['products'] = $this->Product_model->get_pros_for_dd();
            $data['_view'] = 'sale/newso';
            $this->load->view('layouts/main', $data);
        }
    }

    function get_so_list()
    {
        $columns = array(
            0 => 'order_no',
            1 => 'date',
            2 => 'customer_id',
            3 => 'tax_per',
            4 => 'net_tot',
        );

        // This is for sorting and pagination, it will mstly stay the same
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        // This is for sorting and pagination, it will mstly stay the same end


        $totalData = $this->Sale_model->get_all_so_count();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {
            $posts = $this->Sale_model->get_all_so($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];

            $posts =  $this->Sale_model->so_search($limit, $start, $search, $order, $dir);

            $totalFiltered = $this->Sale_model->so_search_count($search);
        }

        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['so_no'] = $post->order_no;
                $nestedData['date'] = $post->date;
                $nestedData['customer'] = $post->party_name . " (" . $post->party_code . ")";
                $nestedData['tax_per'] = $post->tax_per;
                $nestedData['net_total'] = $post->net_tot;

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }
    function get_si_list()
    {
        $columns = array(
            0 => 'sale_invoices.invoice_no',
            1 => 'sale_orders.order_no',
            2 => 'sale_invoices.date',
            3 => 'sale_orders.customer_id',
            4 => 'sale_invoices.tax_per',
            5 => 'sale_invoices.net_tot',
        );

        // This is for sorting and pagination, it will mstly stay the same
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        // This is for sorting and pagination, it will mstly stay the same end


        $totalData = $this->Sale_model->get_all_si_count();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {
            $posts = $this->Sale_model->get_all_si($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];

            $posts =  $this->Sale_model->pi_search($limit, $start, $search, $order, $dir);

            $totalFiltered = $this->Sale_model->pi_search_count($search);
        }

        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['invoice_no'] = $post->invoice_no;
                $nestedData['po_no'] = $post->order_no;
                $nestedData['date'] = $post->date;
                $nestedData['supplier'] = $post->party_name . "(" . $post->party_code . ")";
                $nestedData['tax_per'] = $post->tax_per;
                $nestedData['net_total'] = $post->net_tot;

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }
    function newinvoice()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('so_id', 'Sale Order', 'required');
        $this->form_validation->set_rules('date', 'Invoice Date', 'required');

        if ($this->form_validation->run()) {

            $params = array(
                'so_id' => $this->input->post('so_id'),
                'date' => date('Y-m-d', strtotime($this->input->post('date'))),
                'invoice_no' => $this->input->post('invoice_no'),
                'created_by' => $this->session->userdata('id'),
                'farm_id' => $this->session->userdata('active_farm'),
                'tax_per' => 0,
                'gross_tot' => $this->input->post('net_total'),
                'net_tot' => $this->input->post('net_total')
            );
            $this->db->insert('sale_invoices', $params);
            $si_id = $this->db->insert_id();

                 $params1 = array(
                        'acc_number' => '106001',
                        'item_id' =>0,
                        'journal_details' =>'Sale Entry',
                        'journal_amount' =>$this->input->post('net_total'),
                        'type' =>'Sale'
                    );
         $this->db->insert('account_journal', $params1);
         $lastJournalID= $this->db->insert_id();
          $updateParam = array(
                        'ref_id' => $lastJournalID
                    );


          $this->db->where('journal_id', $lastJournalID);
         $this->db->update('account_journal', $updateParam);

           $params2 = array(
                        'ref_id' => $lastJournalID,
                        'acc_number' => '401',
                        'item_id' =>0,
                        'journal_details' =>'Sale Entry',
                        'journal_amount' =>-1*$this->input->post('net_total'),
                        'type' =>'Sale'
                    );
            $this->db->insert('account_journal', $params2); 

            foreach ($_POST['products'] as $key => $value) {
                $pidetails[] = array(
                    'si_id' => $si_id,
                    'product_id' => $value,
                    'uom' => $_POST['uom'][$value],
                    'qty' => $_POST['qty'][$value],
                    'rate' => $_POST['rate'][$value],
                    'amount' => $_POST['rate'][$value] * $_POST['qty'][$value],
                    'farm_id' => $this->session->userdata('active_farm')
                );

                $stockDetails[] = array(
                    'invoice_id' => $si_id,
                    'invoice_type'=> SALE_STOCKS,
                    'item_id'=> $value,
                    'quantity'=> -1*$_POST['qty'][$value],
                    'created_by' => $this->session->userdata('id'),
                    'farm_id' => $this->session->userdata('active_farm')
                );
            }

            $this->db->insert_batch('si_details', $pidetails);
            $this->db->insert_batch('stocks', $stockDetails);
            $this->session->set_flashdata('success', 'Purchase Invoice Created Successfully!');
            redirect('sale/invoice');
        } else {
            $this->load->model('Parties_model');
            $this->load->model('Product_model');
            $data['units'] = $this->Parties_model->get_all_units();
            $data['sos'] = $this->Sale_model->get_all_sos_dd();
            $data['order_no'] = $this->Parties_model->get_code_si();
            $data['products'] = $this->Product_model->get_pros_for_dd();
            $data['_view'] = 'sale/newinvoice';
            $this->load->view('layouts/main', $data);
        }
    }
 
    function get_so_details($so_id){
        $data = $this->Sale_model->get_so_details($so_id);
        echo json_encode($data);
    }

    function rv(){
        $data['_view'] = 'sale/rv';
        $this->load->view('layouts/main', $data);
    }

    function newrv()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('customer_id', 'Customer', 'required');
        $this->form_validation->set_rules('date', 'RV Date', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required');
        $this->form_validation->set_rules('invoice_id', 'Invoice', 'required');
        $this->form_validation->set_rules('payment_mode', 'Payment Mode', 'required');

        if ($this->form_validation->run()) {

            $params = array(
                'customer_id' => $this->input->post('customer_id'),
                'date' => date('Y-m-d', strtotime($this->input->post('date'))),
                'amount' => $this->input->post('amount'),
                'payment_mode' => $this->input->post('payment_mode'),
                'si_id' => $this->input->post('invoice_id'),
                'created_by' => $this->session->userdata('id'),
                'farm_id' => $this->session->userdata('active_farm')
            );
            $this->db->insert('recipt_voucher', $params);
            $si_id = $this->db->insert_id();


                 $params1 = array(
                        'acc_number' => '104',
                        'item_id' =>$si_id,
                        'journal_details' =>'Voucher Entry',
                        'journal_amount' =>$this->input->post('amount'),
                        'type' =>'Voucher'
                    );
         $this->db->insert('account_journal', $params1);
         $lastJournalID= $this->db->insert_id();
          $updateParam = array(
                        'ref_id' => $lastJournalID
                    );


          $this->db->where('journal_id', $lastJournalID);
         $this->db->update('account_journal', $updateParam);

           $params2 = array(
                        'ref_id' => $lastJournalID,
                        'acc_number' => '106001',
                        'item_id' =>$si_id,
                        'journal_details' =>'Voucher Entry',
                        'journal_amount' =>-1*$this->input->post('amount'),
                        'type' =>'Voucher'
                    );
            $this->db->insert('account_journal', $params2);    
              
            $this->session->set_flashdata('success', 'Purchase Invoice Created Successfully!');
            redirect('sale/rv');
        } else {
            $this->load->model('Parties_model'); 
            $data['customers'] = $this->Parties_model->get_all_customers();
            $data['sis'] = $this->Sale_model->get_all_invoices_dd(); 
            $data['_view'] = 'sale/newrv';
            $this->load->view('layouts/main', $data);
        }
    }

    function get_rv_list()
    {
        $columns = array(
            0 => 'recipt_voucher.date',
            1 => 'recipt_voucher.customer_id',
            2 => 'recipt_voucher.amount',
            3 => 'recipt_voucher.si_id',
            4 => 'recipt_voucher.payment_mode', 
        );

        // This is for sorting and pagination, it will mstly stay the same
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        // This is for sorting and pagination, it will mstly stay the same end


        $totalData = $this->Sale_model->get_all_rv_count();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {
            $posts = $this->Sale_model->get_all_rv($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];

            $posts =  $this->Sale_model->get_rv_search($limit, $start, $search, $order, $dir);

            $totalFiltered = $this->Sale_model->get_rv_search_count($search);
        }
 
        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                if($post->payment_mode == PM_CASH){
                    $pm = "<span class='badge badge-primary'>Cash</span>";
                } else if($post->payment_mode == PM_BANKTRANSFER){
                    $pm = "<span class='badge badge-info'>Bank Transfer</span>";
                }
                $nestedData['date'] = $post->date;
                $nestedData['invoice'] = $post->invoice_no." (Pkr ".number_format($post->net_tot,2,'.',',') . "/-)";
                $nestedData['amount'] = number_format($post->amount,2,'.',',');
                $nestedData['customer'] = $post->party_name . " (" . $post->party_code . ")";
                $nestedData['payment_mode'] = $pm; 

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }
}
