<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_pasien extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tbl_category_pasien_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'category_pasien/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'category_pasien/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'category_pasien/index.html';
            $config['first_url'] = base_url() . 'category_pasien/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tbl_category_pasien_model->total_rows($q);
        $category_pasien = $this->Tbl_category_pasien_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'category_pasien_data' => $category_pasien,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('category_pasien/tbl_category_pasien_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_category_pasien_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'name' => $row->name,
		'category_card_id' => $row->category_card_id,
	    );
            $this->load->view('category_pasien/tbl_category_pasien_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('category_pasien'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('category_pasien/create_action'),
	    'id' => set_value('id'),
	    'name' => set_value('name'),
	    'category_card_id' => set_value('category_card_id'),
	);
        $this->load->view('category_pasien/tbl_category_pasien_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'category_card_id' => $this->input->post('category_card_id',TRUE),
	    );

            $this->Tbl_category_pasien_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('category_pasien'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_category_pasien_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('category_pasien/update_action'),
		'id' => set_value('id', $row->id),
		'name' => set_value('name', $row->name),
		'category_card_id' => set_value('category_card_id', $row->category_card_id),
	    );
            $this->load->view('category_pasien/tbl_category_pasien_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('category_pasien'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'category_card_id' => $this->input->post('category_card_id',TRUE),
	    );

            $this->Tbl_category_pasien_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('category_pasien'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_category_pasien_model->get_by_id($id);

        if ($row) {
            $this->Tbl_category_pasien_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('category_pasien'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('category_pasien'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('category_card_id', 'category card id', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Category_pasien.php */
/* Location: ./application/controllers/Category_pasien.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-07-15 00:09:22 */
/* http://harviacode.com */