<?php 

class Finance_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

        // Select All Query
        // $this->db->get('country')->result_array();
    }
 function get_all_AccountType()
 {
 	// $this->db->where('currency.status!=',DELETED);
        $query = $this->db->get('account_type'); 
        return $query->result();
 }   

   function get_all_account_count()
    {
        $this->db->where('account_chart.status!=',DELETED);
        $query = $this->db->get('account_chart'); 
        return $query->num_rows();
    }
      function get_all_account($limit, $start, $col, $dir)
    {
        $this->db->where('account_chart.status!=',DELETED);
        $this->db->select('account_chart.*, account_type.account_name AS account_type');
        $this->db->join('account_type', 'account_type.id = account_chart.acc_type_id');
        $query = $this->db->limit($limit, $start)->order_by($col, $dir)->get('account_chart'); 

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
       function account_search_count($search)
    {
        // $this->db->where('users.status!=',DELETED);

        $query = $this
                ->db
                ->where('account_chart.status!=',DELETED)
                ->where("( 
                    acc_name LIKE '%$search%' OR
                    acc_no LIKE '%$search%'
                 )")
                ->get('account_chart');
    
        return $query->num_rows();
    } 

       function account_search($limit,$start,$search,$col,$dir)
    {
        $this->db->where('account_chart.status!=',DELETED);

        $query = $this
                ->db
                ->where("( 
                    acc_name LIKE '%$search%' OR
                    acc_no LIKE '%$search%' 
                 )")
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('account_chart');
        
       
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
    	// echo
    	return $this->db->where('acc_id',$id)
        ->update('account_chart',$params);

    }
    function delete_account($id,$params)
    {
    	// echo
    	return $this->db->where('acc_id',$id)
        ->update('account_chart',$params);

    }

      function update_account($id,$params)
    {
    	// echo
    	return $this->db->where('acc_id',$id)
        ->update('account_chart',$params);

    }
}

 ?>