<?php 

class Crop_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

      function get_all_cropform_count()
    {
        $this->filter_by_active_farm();
        $this->db->where('crop_form.status!=',DELETED);
        $query = $this->db->get('crop_form'); 
        return $query->num_rows();
    }
      function get_all_cropform($limit, $start, $col, $dir)
    {
        $this->filter_by_active_farm();
        $this->db->where('crop_form.status!=',DELETED);
        $query = $this->db->limit($limit, $start)->order_by($col, $dir)->get('crop_form'); 

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
       function cropform_search_count($search)
    {
        // $this->db->where('users.status!=',DELETED);
        $this->filter_by_active_farm();
        $query = $this
                ->db
                ->where('crop_name.status!=',DELETED)
                ->where("( 
                    crop_name LIKE '%$search%' OR
                    crop_tenure LIKE '%$search%'
                 )")
                ->get('crop_name');
    
        return $query->num_rows();
    } 

       function cropname_search($limit,$start,$search,$col,$dir)
    {
        $this->filter_by_active_farm();
        $this->db->where('crop_name.status!=',DELETED);

        $query = $this
                ->db
                ->where("( 
                    crop_name LIKE '%$search%' OR
                    crop_tenure LIKE '%$search%' 
                 )")
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('crop_name');
        
       
        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    }

    function get_all_LandType_batch($type)
    {
        $this->filter_by_active_farm();
        $query = $this
                ->db
                ->where('land_batch.status!=',DELETED)
                ->where('land_batch.land_type=',$type)
                 ->group_by('invoice_no') 

                ->get('land_batch');
    
        return $query->result();	
    }

    function get_all_LandType_area($invoice,$type)
    {
        $this->filter_by_active_farm();
        $query = $this
                ->db
                ->where('land_batch.status!=',DELETED)
                ->where('land_batch.invoice_no=',$invoice)
                ->where('land_batch.land_type=',$type)
                ->get('land_batch');
    
        return $query->result();	
    }
      function get_invoiceno()
    {   
        // echo $type;exit;\
        $this->filter_by_active_farm();
         $query=$this->db->select('count(id) AS invoice_no')
         			->get('crop_update_form');
         $row=$query->row_array();
         // var_dump($row);exit;
         // echo $row['invoice_no'];;
         return $row['invoice_no']+1;
    }

    function getCropForm()
    {
        $this->filter_by_active_farm();
    	$query = $this->db->where('crop_form.status!=',DELETED)
        ->get('crop_form');
        return $query->result();
    }
    function get_all_cropupdateform_count()
    {
        $this->filter_by_active_farm();
		 $this->db->where('crop_update_form.status!=',DELETED);
        $query = $this->db->get('crop_update_form'); 
        return $query->num_rows();    	
    }
          function get_all_cropupdateform($limit, $start, $col, $dir)
    {
        $this->filter_by_active_farm('crop_update_form');
        $this->db->where('crop_update_form.status!=',DELETED);
        $this->db->select('crop_update_form.*, land_management.land_management_data AS land_type, landbatch.batch_no AS batch_no, landarea.area_no AS area_no,landbatch.invoice_no AS invoice');
        $this->db->join('land_management_data land_management', 'land_management.id = crop_update_form.land_type_id');
        $this->db->join('land_batch landbatch', 'landbatch.id = crop_update_form.batch_no_id');
        $this->db->join('land_batch landarea', 'landarea.id = crop_update_form.area_id');
        $query = $this->db->limit($limit, $start)->order_by($col, $dir)->get('crop_update_form'); 

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
       function cropupdateform_search_count($search)
    {
        // $this->db->where('users.status!=',DELETED);
        $this->filter_by_active_farm();
        $query = $this
                ->db
                ->where('crop_update_form.status!=',DELETED)
                ->where("( 
                    area_code LIKE '%$search%' OR
                    crop_tenure LIKE '%$search%'
                 )")
                ->get('crop_update_form');
    
        return $query->num_rows();
    }
          function cropupdatename_search($limit,$start,$search,$col,$dir)
    {
        $this->filter_by_active_farm();
        $this->db->where('crop_update_form.status!=',DELETED);

        $query = $this
                ->db
                ->where("( 
                    area_code LIKE '%$search%' OR
                    crop_tenure LIKE '%$search%' 
                 )")
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('crop_update_form');
        
       
        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    } 
    function update_status($id,$params)
    {
        $this->filter_by_active_farm();
    		 return $this->db->where('id',$id)
        ->update('crop_update_form',$params);

    }
      function delete_cropForm($id,$params)
    {
        $this->filter_by_active_farm();
    		 return $this->db->where('id',$id)
        ->update('crop_update_form',$params);

    }

    	function get_cropForm_data($id)
    	{
            $this->filter_by_active_farm();
    		 // $this->filter_by_active_farm();
        $this->db->where('crop_update_form.status!=', DELETED);
        $this->db->where('crop_update_form.id=', $id);
        $this->db->select('crop_update_form.*, land_batch.invoice_no AS invoice');
        $this->db->join('land_batch', 'land_batch.id = crop_update_form.batch_no_id');
        $query = $this->db->get('crop_update_form');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    	}

    	function update_cropform($id,$params)
    	{
        $this->filter_by_active_farm();
    	return $this->db->where('id',$id)
        ->update('crop_update_form',$params);
	
    	}
  }  

 ?>