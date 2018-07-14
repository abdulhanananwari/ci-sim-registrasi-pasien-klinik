<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pasien_model extends CI_Model
{

    public $table = 'tbl_pasien';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('category_pasien_id', $q);
	$this->db->or_like('name', $q);
	$this->db->or_like('number', $q);
	$this->db->or_like('address', $q);
	$this->db->or_like('nik', $q);
	$this->db->or_like('date', $q);
	$this->db->or_like('note', $q);
	$this->db->or_like('image', $q);
	$this->db->or_like('category_card_id', $q);
	$this->db->or_like('exp_card', $q);
	$this->db->or_like('active', $q);
	$this->db->or_like('created_at', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('category_pasien_id', $q);
	$this->db->or_like('name', $q);
	$this->db->or_like('number', $q);
	$this->db->or_like('address', $q);
	$this->db->or_like('nik', $q);
	$this->db->or_like('date', $q);
	$this->db->or_like('note', $q);
	$this->db->or_like('image', $q);
	$this->db->or_like('category_card_id', $q);
	$this->db->or_like('exp_card', $q);
	$this->db->or_like('active', $q);
	$this->db->or_like('created_at', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Pasien_model.php */
/* Location: ./application/models/Pasien_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-07-15 00:10:42 */
/* http://harviacode.com */