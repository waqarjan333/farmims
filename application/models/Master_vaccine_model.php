<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */

class Master_vaccine_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_all_master_vaccine_count()
    {
        $this->filter_by_active_farm("mvd");
        $query =
            $this->db->where('mvd.status!=', DELETED)
            ->select(
                'mvd.*, 
            p.product_code AS product_code, 
            p.product_name AS product_name, 
            d.name AS disease_name'
            )
            ->join('disease as d', 'mvd.disease_name = d.id')
            ->join('product as p', 'mvd.product_id = p.id')
            ->get('master_vaccine_detail as mvd');
        // print_r($this->db->last_query());    exit;
        return $query->num_rows();
    }
    /*
     * Get all brand
     */
    function get_all_master_vaccine($limit, $start, $col, $dir)
    {
        $this->filter_by_active_farm("mvd");
        $this->db->where('mvd.status!=', DELETED)
            ->select(
                'mvd.*, 
            p.product_code AS product_code, 
            p.product_name AS product_name,
            d.name AS disease_name'
            )
            ->join('disease as d', 'mvd.disease_name = d.id')
            ->join('product as p', 'mvd.product_id = p.id');
        $query = $this->db->limit($limit, $start)->order_by($col, $dir)->get('master_vaccine_detail as mvd');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    function get_category_products()
    {
        $this->filter_by_active_farm('product');
        $this->db->select('product.id, product.product_code, product.product_name')
        ->join('product_category', 'product.product_category_id = product_category.id');
        
        $this->db->where('product_category.name', 'Vaccination');
        
        return  $this->db->get('product')->result_array();
        
    }

    function get_product_details($id)
    {
        $this->db->select('product_code, product_name');
        $this->filter_by_active_farm();
        return $this->db->get_where('product', array('id' => $id))->row_array();
    }
    function get_productcategory_for_dd()
    {
        $this->db->select('product_category.id, product_category.name as product_category_name');
        //$this->filter_by_active_farm('product_category');
        $this->db->where('status', ACTIVE);
        $this->db->where('name', 'Vaccination');
        return $this->db->get('product_category')->result_array();
    }

    function master_vaccine_search($limit, $start, $search, $col, $dir)
    {
        $this->filter_by_active_farm('mvd');
        $query = $this
            ->db
            ->where('mvd.status!=', DELETED)
            ->select(
                'mvd.*, 
                        p.product_code AS product_code, 
                        p.product_name AS product_name, 
                        d.name AS disease_name'
            )
            ->join('disease as d', 'mvd.disease_name = d.id')
            ->join('product as p', 'mvd.product_id = p.id')
            ->like('p.product_name', $search)
            ->or_like('pc.name', $search)

            ->limit($limit, $start)
            ->order_by($col, $dir)
            ->get('master_vaccine_detail as mvd');


        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function get_code()
    {
        $query = $this
            ->db
            ->select('*')
            ->join('product_category as pc', 'p.product_category_id = pc.id')
            ->where('pc.name', 'Vaccination')
            ->where('p.status', ACTIVE)
            ->get('product as p');

        $numrows =  $query->num_rows();
        return 'MV' . sprintf('%06d', $numrows); //it will provide latest or last record id.
    }

    function master_vaccine_search_count($search)
    {
        $this->filter_by_active_farm('mvd');
        $query = $this
            ->db
            ->where('mvd.status!=', DELETED)
            ->select('mvd.*, 
                        p.product_code AS product_code, 
                        p.product_name AS product_name, 
                        d.name AS disease_name')
            ->join('disease as d', 'mvd.disease_name = d.id')
            ->join('product as p', 'mvd.product_id = p.id')
            ->like('p.product_name', $search)
            ->or_like('pc.name', $search)
            ->get('master_vaccine_detail as mvd');

        return $query->num_rows();
    }



    function add_vaccine_master($params)
    {
        $this->db->insert('master_vaccine_detail', $params);
    }


    function get_item($id)
    {
        return $this->db->where('master_vaccine_detail.id', $id)
            ->select("master_vaccine_detail.*,CONCAT(product.product_code,'&nbsp;',product.product_name) AS product_name")
            ->join('product', 'product.id=master_vaccine_detail.product_id')
            ->get('master_vaccine_detail')
            ->row();
    }

    function update_vaccine_master($id, $params)
    {
        $this->db->where('id', $id)
            ->update('master_vaccine_detail', $params);
    }


    function delete_vaccine_master($id)
    {
        $this->db->where('id', $id)
            ->update('master_vaccine_detail', ['status' => DELETED]);
    }
}
