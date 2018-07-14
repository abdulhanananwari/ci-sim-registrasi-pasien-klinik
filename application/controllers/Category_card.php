<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_card extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tbl_category_card_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'category_card/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'category_card/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'category_card/index.html';
            $config['first_url'] = base_url() . 'category_card/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tbl_category_card_model->total_rows($q);
        $category_card = $this->Tbl_category_card_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'category_card_data' => $category_card,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('category_card/tbl_category_card_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_category_card_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'name' => $row->name,
		'exp_card' => $row->exp_card,
	    );
            $this->load->view('category_card/tbl_category_card_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('category_card'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('category_card/create_action'),
	    'id' => set_value('id'),
	    'name' => set_value('name'),
	    'exp_card' => set_value('exp_card'),
	);
        $this->load->view('category_card/tbl_category_card_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'exp_card' => $this->input->post('exp_card',TRUE),
	    );

            $this->Tbl_category_card_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('category_card'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_category_card_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('category_card/update_action'),
		'id' => set_value('id', $row->id),
		'name' => set_value('name', $row->name),
		'exp_card' => set_value('exp_card', $row->exp_card),
	    );
            $this->load->view('category_card/tbl_category_card_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('category_card'));
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
		'exp_card' => $this->input->post('exp_card',TRUE),
	    );

            $this->Tbl_category_card_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('category_card'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_category_card_model->get_by_id($id);

        if ($row) {
            $this->Tbl_category_card_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('category_card'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('category_card'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('exp_card', 'exp card', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Category_card.php */
/* Location: ./application/controllers/Category_card.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-07-15 00:08:56 */
/* http://harviacode.com */