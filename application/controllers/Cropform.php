<?php 


class Cropform extends Admin_Controller
{
	 function __construct()
    {
        parent::__construct();
        $this->load->model('LandManagementData_model');
        $this->load->model('Crop_model');
    }

    function index()
    {
    	 if ($this->input->method(true) == 'POST') {
    	 	// echo "work";exit;
            $this->load->library('form_validation');
              # New Insert
                $this->form_validation->set_rules('cropname', 'Crop Name', 'required');
                $this->form_validation->set_rules('croptenure', 'Crop Tenure', 'required');
             if ($this->form_validation->run()) {
             	// echo "Fixed";exit;
                    $params = array(
                        'crop_name' => $this->input->post('cropname'),
                        'crop_tenure' => $this->input->post('croptenure'),
                        'created_by' => $this->session->userdata('id'),
                        'status' => ACTIVE
                    );
                   
                    $this->db->insert('crop_form', $params);
                    $this->db->trans_complete();
                    $this->session->set_flashdata('success', 'Crop Form added successfuly');
                    redirect('Cropform');
                }    
        }

    	 $data['_view'] = 'crop_form/index';
    	
            $this->load->view('layouts/main', $data);
    }

    function get_cropForm()
    {
    	$columns = array(
            0 => 'crop_name',
            1 => 'crop_tenure',
            2 => 'status',
            3 => 'id'
        );

        // This is for sorting and pagination, it will mstly stay the same
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        // This is for sorting and pagination, it will mstly stay the same end


        $totalData = $this->Crop_model->get_all_cropform_count();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {
            $posts = $this->Crop_model->get_all_cropform($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];

            $posts =  $this->Crop_model->cropname_search($limit, $start, $search, $order, $dir);

            $totalFiltered = $this->Crop_model->cropform_search_count($search);
        }

        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['crop_name'] = $post->crop_name;
                $nestedData['crop_tenure'] = $post->crop_tenure." Month";
                $nestedData['status'] = ($post->status == ACTIVE) ? "<span class='badge badge-success'>ACTIVE</span>" : "<span class='badge badge-danger'>SUSPENDED</span>";
                $nestedData['actions'] = "<button class='btn btn-warning btn-sm btn-edit' code='" . $post->id . "'><i class='uil-edit-alt'></i> Edit</button>&nbsp;<button class='btn btn-danger btn-sm btn-delete' code='" . $post->id . "'><i class='uil-trash-alt'></i> Delete</button>";

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

    public function InsertCropInfo()
    {
    	 if ($this->input->method(true) == 'POST') {
    	 	// echo "work";exit;
            $this->load->library('form_validation');
              # New Insert
                $this->form_validation->set_rules('type_of_land', 'Land Type', 'required');
                $this->form_validation->set_rules('land_batch', 'Land Batch', 'required');
                $this->form_validation->set_rules('land_area', 'Land Area', 'required');
                $this->form_validation->set_rules('areacode', 'Area Code', 'required');
             if ($this->form_validation->run()) {
             	// echo "Fixed";exit;
                    $params = array(
                        'land_type_id' => $this->input->post('type_of_land'),
                        'batch_no_id' => $this->input->post('land_batch'),
                        'area_id	' => $this->input->post('land_area'),
                        'area_code' => $this->input->post('areacode'),
                        'sewing_date' => $this->input->post('sewing_date'),
                        'crop_form_id' => $this->input->post('crop_form_id'),
                        'crop_tenure' => $this->input->post('tenure'),
                        'crop_date' => $this->input->post('cropdate'),
                        'expected_completion_date' => $this->input->post('completion_date'),
                        'crop_status' => $this->input->post('crop_status'),
                        'created_by' => $this->session->userdata('id'),
                        'status' => ACTIVE
                    );
                   
                    $this->db->insert('crop_update_form', $params);
                    $this->session->set_flashdata('success', 'Update Crop Form added successfuly');
                    redirect('Cropform/InsertCropInfo');
                }    
        }
    	$data['landType'] = $this->LandManagementData_model->get_all_LandType_data('Land Type');
    	$data['CropForm'] = $this->Crop_model->getCropForm();
    	 $data['invoice'] =$this->Crop_model->get_invoiceno();
   		$data['_view'] = 'crop_form/crop_update';
            $this->load->view('layouts/main', $data); 	
    }
        public function UpdateCropInfo()
    {
    	$editID=$this->uri->segment(3);
    	 if(isset($editID)) {
    	 	// echo "work";exit;
            $this->load->library('form_validation');
              # New Insert
                $this->form_validation->set_rules('type_of_land', 'Land Type', 'required');
                $this->form_validation->set_rules('land_batch', 'Land Batch', 'required');
                $this->form_validation->set_rules('land_area', 'Land Area', 'required');
             if ($this->form_validation->run()) {
             	// echo "Fixed";exit;
                    $params = array(
                        'land_type_id' => $this->input->post('type_of_land'),
                        'batch_no_id' => $this->input->post('land_batch'),
                        'area_id	' => $this->input->post('land_area'),
                        'sewing_date' => $this->input->post('sewing_date'),
                        'crop_form_id' => $this->input->post('crop_form_id'),
                        'crop_tenure' => $this->input->post('tenure'),
                        'crop_date' => $this->input->post('cropdate'),
                        'crop_status' => $this->input->post('crop_status')
                    );
                   
                $this->Crop_model->update_cropform($editID, $params);
                redirect('Cropform/InsertCropInfo');
                }else{

   		$data['_view'] = 'crop_form/crop_update';
            $this->load->view('layouts/main', $data); 	
    }        	
                }    
        }
    	
       function get_cropUpdateForm()
    {
    	$columns = array(
            0 => 'land_type_id',
            0 => 'batch_no_id',
            1 => 'area_id',
            1 => 'area_code',
            2 => 'status',
            3 => 'id'
        );

        // This is for sorting and pagination, it will mstly stay the same
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        // This is for sorting and pagination, it will mstly stay the same end


        $totalData = $this->Crop_model->get_all_cropupdateform_count();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {
            $posts = $this->Crop_model->get_all_cropupdateform($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];

            $posts =  $this->Crop_model->cropuname_search($limit, $start, $search, $order, $dir);

            $totalFiltered = $this->Crop_model->cropupdateform_search_count($search);
        }

        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['land_type_id'] = $post->land_type;
                $nestedData['batch_no_id'] ='Batch No ( Inv #: '. $post->invoice .') => '. $post->batch_no;
                $nestedData['area_id'] = 'Area No '. $post->area_no;
                $nestedData['area_code'] = $post->area_code;
                $nestedData['status'] = ($post->status == ACTIVE) ? "<button class='btn btn-warning btn-sm btn-status' code='" . $post->id . "' data-status='".$post->status."'>Suspended</button>" : "<button class='btn btn-success btn-sm btn-status' code='" . $post->id . "'>Active</button>";
                $nestedData['actions'] = "<a href='".base_url('Cropform/edit_cropForm/'.$post->id)."' class='btn btn-warning btn-sm btn-edit' code='" . $post->id . "'><i class='uil-edit-alt'></i> Edit</a>&nbsp;<button class='btn btn-danger btn-sm btn-delete' code='" . $post->id . "'><i class='uil-trash-alt'></i> Delete</button>";

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

    public function getLandBatch()
    {
	$val=$this->input->post('val');    	
	$valID=$this->input->post('valID');    	
    $data = $this->Crop_model->get_all_LandType_batch($val);
    $output='';
    $select='';
    $output.='<option>Select Batch</option>';
    		foreach($data as $row)
    		{
    			if($row->id==$valID){
    				$select="selected=''";
    			}
    			else{
    				$select='';
    			}
			$output.="<option value='".$row->id."' data-invoice='".$row->invoice_no."' ".$select." >".$row->land_type. '('.$row->invoice_no.')'. '=> Batch No'. $row->batch_no."</option>";
    		}

    		echo $output;
    }
    public function getLandArea()
    {
    $areaID=$this->input->post('areaID');	
    $data = $this->Crop_model->get_all_LandType_area($this->input->post('invoice'),$this->input->post('land_type'));
    $output='';
    $select='';
    $output.='<option>Select Area</option>';
    		foreach($data as $row)
    		{
    			if($row->id==$areaID){
    				$select="selected=''";
    			}
    			else{
    				$select='';
    			}
			$output.="<option value='".$row->id."' ".$select.">".$row->land_type.'=> Area '. $row->area_no."</option>";
    		}

    		echo $output;
    }

    function updateStatus()
    {
    	$id=$this->input->post('id');
    	$status=$this->input->post('status');
    	if($status==1)
    	{
    	$params = array(
                'status' =>SUSPENDED 
            );	
    	}else{
    	$params = array(
                'status' =>ACTIVE 
            );	
    	}
    	 
    	echo $this->Crop_model->update_status($id,$params);	
    }
    public function delete_cropForm($id)
    {
    	$params = array(
                'status' =>DELETED 
            );		
    	
    	 
    	echo $this->Crop_model->delete_cropForm($id,$params);	
    }

    function edit_cropForm($id)
    {
    	  $data['landType'] = $this->LandManagementData_model->get_all_LandType_data('Land Type');
    	  $data['CropForm'] = $this->Crop_model->getCropForm();
    	   $data['cropFormData'] = $this->Crop_model->get_cropForm_data($id);
    	   $data['edit_id'] = $id;
    	        $data['_view'] = 'crop_form/edit_cropForm';
        $this->load->view('layouts/main', $data);
    }
}	
 ?>