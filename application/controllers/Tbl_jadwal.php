<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_jadwal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tbl_jadwal_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'tbl_jadwal/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tbl_jadwal/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tbl_jadwal/index.html';
            $config['first_url'] = base_url() . 'tbl_jadwal/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tbl_jadwal_model->total_rows($q);
        $tbl_jadwal = $this->Tbl_jadwal_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_jadwal_data' => $tbl_jadwal,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('tbl_jadwal/tbl_jadwal_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_jadwal_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_jadwal' => $row->id_jadwal,
		'tanggal' => $row->tanggal,
		'hari' => $row->hari,
		'detal' => $row->detal,
	    );
            $this->load->view('tbl_jadwal/tbl_jadwal_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_jadwal'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_jadwal/create_action'),
	    'id_jadwal' => set_value('id_jadwal'),
	    'tanggal' => set_value('tanggal'),
	    'hari' => set_value('hari'),
	    'detal' => set_value('detal'),
	);
        $this->load->view('tbl_jadwal/tbl_jadwal_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'tanggal' => $this->input->post('tanggal',TRUE),
		'hari' => $this->input->post('hari',TRUE),
		'detal' => $this->input->post('detal',TRUE),
	    );

            $this->Tbl_jadwal_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tbl_jadwal'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_jadwal_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_jadwal/update_action'),
		'id_jadwal' => set_value('id_jadwal', $row->id_jadwal),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'hari' => set_value('hari', $row->hari),
		'detal' => set_value('detal', $row->detal),
	    );
            $this->load->view('tbl_jadwal/tbl_jadwal_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_jadwal'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_jadwal', TRUE));
        } else {
            $data = array(
		'tanggal' => $this->input->post('tanggal',TRUE),
		'hari' => $this->input->post('hari',TRUE),
		'detal' => $this->input->post('detal',TRUE),
	    );

            $this->Tbl_jadwal_model->update($this->input->post('id_jadwal', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_jadwal'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_jadwal_model->get_by_id($id);

        if ($row) {
            $this->Tbl_jadwal_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_jadwal'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_jadwal'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('hari', 'hari', 'trim|required');
	$this->form_validation->set_rules('detal', 'detal', 'trim|required');

	$this->form_validation->set_rules('id_jadwal', 'id_jadwal', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_jadwal.xls";
        $judul = "tbl_jadwal";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
	xlsWriteLabel($tablehead, $kolomhead++, "Hari");
	xlsWriteLabel($tablehead, $kolomhead++, "Detal");

	foreach ($this->Tbl_jadwal_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->hari);
	    xlsWriteLabel($tablebody, $kolombody++, $data->detal);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Tbl_jadwal.php */
/* Location: ./application/controllers/Tbl_jadwal.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-07-15 00:15:30 */
/* http://harviacode.com */