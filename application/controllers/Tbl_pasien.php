<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_pasien extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tbl_pasien_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'tbl_pasien/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tbl_pasien/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tbl_pasien/index.html';
            $config['first_url'] = base_url() . 'tbl_pasien/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tbl_pasien_model->total_rows($q);
        $tbl_pasien = $this->Tbl_pasien_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_pasien_data' => $tbl_pasien,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('tbl_pasien/tbl_pasien_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_pasien_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'category_pasien_id' => $row->category_pasien_id,
		'name' => $row->name,
		'number' => $row->number,
		'address' => $row->address,
		'nik' => $row->nik,
		'date' => $row->date,
		'note' => $row->note,
		'image' => $row->image,
		'category_card_id' => $row->category_card_id,
		'exp_card' => $row->exp_card,
		'active' => $row->active,
		'created_at' => $row->created_at,
	    );
            $this->load->view('tbl_pasien/tbl_pasien_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_pasien'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_pasien/create_action'),
	    'id' => set_value('id'),
	    'category_pasien_id' => set_value('category_pasien_id'),
	    'name' => set_value('name'),
	    'number' => set_value('number'),
	    'address' => set_value('address'),
	    'nik' => set_value('nik'),
	    'date' => set_value('date'),
	    'note' => set_value('note'),
	    'image' => set_value('image'),
	    'category_card_id' => set_value('category_card_id'),
	    'exp_card' => set_value('exp_card'),
	    'active' => set_value('active'),
	    'created_at' => set_value('created_at'),
	);
        $this->load->view('tbl_pasien/tbl_pasien_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'category_pasien_id' => $this->input->post('category_pasien_id',TRUE),
		'name' => $this->input->post('name',TRUE),
		'number' => $this->input->post('number',TRUE),
		'address' => $this->input->post('address',TRUE),
		'nik' => $this->input->post('nik',TRUE),
		'date' => $this->input->post('date',TRUE),
		'note' => $this->input->post('note',TRUE),
		'image' => $this->input->post('image',TRUE),
		'category_card_id' => $this->input->post('category_card_id',TRUE),
		'exp_card' => $this->input->post('exp_card',TRUE),
		'active' => $this->input->post('active',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
	    );

            $this->Tbl_pasien_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tbl_pasien'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_pasien_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_pasien/update_action'),
		'id' => set_value('id', $row->id),
		'category_pasien_id' => set_value('category_pasien_id', $row->category_pasien_id),
		'name' => set_value('name', $row->name),
		'number' => set_value('number', $row->number),
		'address' => set_value('address', $row->address),
		'nik' => set_value('nik', $row->nik),
		'date' => set_value('date', $row->date),
		'note' => set_value('note', $row->note),
		'image' => set_value('image', $row->image),
		'category_card_id' => set_value('category_card_id', $row->category_card_id),
		'exp_card' => set_value('exp_card', $row->exp_card),
		'active' => set_value('active', $row->active),
		'created_at' => set_value('created_at', $row->created_at),
	    );
            $this->load->view('tbl_pasien/tbl_pasien_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_pasien'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'category_pasien_id' => $this->input->post('category_pasien_id',TRUE),
		'name' => $this->input->post('name',TRUE),
		'number' => $this->input->post('number',TRUE),
		'address' => $this->input->post('address',TRUE),
		'nik' => $this->input->post('nik',TRUE),
		'date' => $this->input->post('date',TRUE),
		'note' => $this->input->post('note',TRUE),
		'image' => $this->input->post('image',TRUE),
		'category_card_id' => $this->input->post('category_card_id',TRUE),
		'exp_card' => $this->input->post('exp_card',TRUE),
		'active' => $this->input->post('active',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
	    );

            $this->Tbl_pasien_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_pasien'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_pasien_model->get_by_id($id);

        if ($row) {
            $this->Tbl_pasien_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_pasien'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_pasien'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('category_pasien_id', 'category pasien id', 'trim|required');
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('number', 'number', 'trim|required');
	$this->form_validation->set_rules('address', 'address', 'trim|required');
	$this->form_validation->set_rules('nik', 'nik', 'trim|required');
	$this->form_validation->set_rules('date', 'date', 'trim|required');
	$this->form_validation->set_rules('note', 'note', 'trim|required');
	$this->form_validation->set_rules('image', 'image', 'trim|required');
	$this->form_validation->set_rules('category_card_id', 'category card id', 'trim|required');
	$this->form_validation->set_rules('exp_card', 'exp card', 'trim|required');
	$this->form_validation->set_rules('active', 'active', 'trim|required');
	$this->form_validation->set_rules('created_at', 'created at', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_pasien.xls";
        $judul = "tbl_pasien";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Category Pasien Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Number");
	xlsWriteLabel($tablehead, $kolomhead++, "Address");
	xlsWriteLabel($tablehead, $kolomhead++, "Nik");
	xlsWriteLabel($tablehead, $kolomhead++, "Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Note");
	xlsWriteLabel($tablehead, $kolomhead++, "Image");
	xlsWriteLabel($tablehead, $kolomhead++, "Category Card Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Exp Card");
	xlsWriteLabel($tablehead, $kolomhead++, "Active");
	xlsWriteLabel($tablehead, $kolomhead++, "Created At");

	foreach ($this->Tbl_pasien_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->category_pasien_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->number);
	    xlsWriteLabel($tablebody, $kolombody++, $data->address);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nik);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date);
	    xlsWriteLabel($tablebody, $kolombody++, $data->note);
	    xlsWriteLabel($tablebody, $kolombody++, $data->image);
	    xlsWriteLabel($tablebody, $kolombody++, $data->category_card_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->exp_card);
	    xlsWriteLabel($tablebody, $kolombody++, $data->active);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_at);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Tbl_pasien.php */
/* Location: ./application/controllers/Tbl_pasien.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-07-15 00:15:30 */
/* http://harviacode.com */