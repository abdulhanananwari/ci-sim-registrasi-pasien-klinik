<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_dokter extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tbl_dokter_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'tbl_dokter/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tbl_dokter/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tbl_dokter/index.html';
            $config['first_url'] = base_url() . 'tbl_dokter/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tbl_dokter_model->total_rows($q);
        $tbl_dokter = $this->Tbl_dokter_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_dokter_data' => $tbl_dokter,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('tbl_dokter/tbl_dokter_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_dokter_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_dokter' => $row->id_dokter,
		'nama_dokter' => $row->nama_dokter,
		'alamat' => $row->alamat,
		'jenis_dokter' => $row->jenis_dokter,
		'no_hp' => $row->no_hp,
		'foto' => $row->foto,
	    );
            $this->load->view('tbl_dokter/tbl_dokter_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_dokter'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_dokter/create_action'),
	    'id_dokter' => set_value('id_dokter'),
	    'nama_dokter' => set_value('nama_dokter'),
	    'alamat' => set_value('alamat'),
	    'jenis_dokter' => set_value('jenis_dokter'),
	    'no_hp' => set_value('no_hp'),
	    'foto' => set_value('foto'),
	);
        $this->load->view('tbl_dokter/tbl_dokter_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_dokter' => $this->input->post('nama_dokter',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'jenis_dokter' => $this->input->post('jenis_dokter',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
		'foto' => $this->input->post('foto',TRUE),
	    );

            $this->Tbl_dokter_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tbl_dokter'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_dokter_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_dokter/update_action'),
		'id_dokter' => set_value('id_dokter', $row->id_dokter),
		'nama_dokter' => set_value('nama_dokter', $row->nama_dokter),
		'alamat' => set_value('alamat', $row->alamat),
		'jenis_dokter' => set_value('jenis_dokter', $row->jenis_dokter),
		'no_hp' => set_value('no_hp', $row->no_hp),
		'foto' => set_value('foto', $row->foto),
	    );
            $this->load->view('tbl_dokter/tbl_dokter_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_dokter'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_dokter', TRUE));
        } else {
            $data = array(
		'nama_dokter' => $this->input->post('nama_dokter',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'jenis_dokter' => $this->input->post('jenis_dokter',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
		'foto' => $this->input->post('foto',TRUE),
	    );

            $this->Tbl_dokter_model->update($this->input->post('id_dokter', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_dokter'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_dokter_model->get_by_id($id);

        if ($row) {
            $this->Tbl_dokter_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_dokter'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_dokter'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_dokter', 'nama dokter', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('jenis_dokter', 'jenis dokter', 'trim|required');
	$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
	$this->form_validation->set_rules('foto', 'foto', 'trim|required');

	$this->form_validation->set_rules('id_dokter', 'id_dokter', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_dokter.xls";
        $judul = "tbl_dokter";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Dokter");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Dokter");
	xlsWriteLabel($tablehead, $kolomhead++, "No Hp");
	xlsWriteLabel($tablehead, $kolomhead++, "Foto");

	foreach ($this->Tbl_dokter_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_dokter);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_dokter);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_hp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->foto);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Tbl_dokter.php */
/* Location: ./application/controllers/Tbl_dokter.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-07-15 00:15:30 */
/* http://harviacode.com */