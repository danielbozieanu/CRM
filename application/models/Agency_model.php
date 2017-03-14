<?php

class Agency_model extends CI_Model
{
    private $primary_key = 'id';
    private $table_name = 'agencies';

    function __construct()
    {
        parent::__construct();
    }

    /*
     * Get agency by id
     */
    function get_agency($id)
    {
        return $this->db->get_where('agencies', array('id' => $id))->row_array();
    }

    /*
     * Get all agencies
     */
    function get_all_agencies($limit = 5, $offset = 0, $order_column = '', $order_type = 'asc')
    {
        if (empty($order_column) || empty($order_type)) {
            $this->db->order_by($this->primary_key, 'asc');
        } else {
            $this->db->select('*');
            $this->db->from($this->table_name);
            $this->db->order_by($order_column, $order_type);
            $this->db->limit($limit, $offset);
            return $this->db->get();
        }
    }

    /*
     * Get all forms
     */
    function get_all_agencies_np()
    {
        return $this->db->get('agencies')->result_array();
    }

    /*
     * function to add new agency
     */
    function add_agency($params)
    {
        $this->db->insert('agencies', $params);
        return $this->db->insert_id();
    }

    /*
     * function to update agency
     */
    function update_agency($id, $params)
    {
        $this->db->where('id', $id);
        $response = $this->db->update('agencies', $params);
        if ($response) {
            return "agency updated successfully";
        } else {
            return "Error occuring while updating agency";
        }
    }

    /*
     * function to delete agency
     */
    function delete_agency($id)
    {
        $response = $this->db->delete('agencies', array('id' => $id));
        if ($response) {
            return "agency deleted successfully";
        } else {
            return "Error occuring while deleting agency";
        }
    }
}