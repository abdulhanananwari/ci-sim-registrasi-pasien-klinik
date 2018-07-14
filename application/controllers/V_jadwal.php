<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class V_jadwal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('V_jadwal_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'v_jadwal/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'v_jadwal/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'v_jadwal/index.html';
            $config['first_url'] = base_url() . 'v_jadwal/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->V_jadwal_model->total_rows($q);
        $v_jadwal = $this->V_jadwal_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'v_jadwal_data' => $v_jadwal,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('v_jadwal/v_jadwal_list', $data);
    }

    public function read($id) 
    {
        $row = $this->V_jadwal_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_transaksi_jadwal' => $row->id_transaksi_jadwal,
		'nama_dokter' => $row->nama_dokter,
		'jenis_dokter' => $row->jenis_dokter,
		'keterangan' => $row->keterangan,
		'foto' => $row->foto,
		'hari' => $row->hari,
	    );
            $this->load->view('v_jadwal/v_jadwal_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('v_jadwal'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('v_jadwal/create_action'),
	    'id_transaksi_jadwal' => set_value('id_transaksi_jadwal'),
	    'nama_dokter' => set_value('nama_dokter'),
	    'jenis_dokter' => set_value('jenis_dokter'),
	    'keterangan' => set_value('keterangan'),
	    'foto' => set_value('foto'),
	    'hari' => set_value('hari'),
	);
        $this->load->view('v_jadwal/v_jadwal_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_transaksi_jadwal' => $this->input->post('id_transaksi_jadwal',TRUE),
		'nama_dokter' => $this->input->post('nama_dokter',TRUE),
		'jenis_dokter' => $this->input->post('jenis_dokter',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'foto' => $this->input->post('foto',TRUE),
		'hari' => $this->input->post('hari',TRUE),
	    );

            $this->V_jadwal_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('v_jadwal'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->V_jadwal_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('v_jadwal/update_action'),
		'id_transaksi_jadwal' => set_value('id_transaksi_jadwal', $row->id_transaksi_jadwal),
		'nama_dokter' => set_value('nama_dokter', $row->nama_dokter),
		'jenis_dokter' => set_value('jenis_dokter', $row->jenis_dokter),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'foto' => set_value('foto', $row->foto),
		'hari' => set_value('hari', $row->hari),
	    );
            $this->load->view('v_jadwal/v_jadwal_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('v_jadwal'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('', TRUE));
        } else {
            $data = array(
		'id_transaksi_jadwal' => $this->input->post('id_transaksi_jadwal',TRUE),
		'nama_dokter' => $this->input->post('nama_dokter',TRUE),
		'jenis_dokter' => $this->input->post('jenis_dokter',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'foto' => $this->input->post('foto',TRUE),
		'hari' => $this->input->post('hari',TRUE),
	    );

            $this->V_jadwal_model->update($this->input->post('', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('v_jadwal'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->V_jadwal_model->get_by_id($id);

        if ($row) {
            $this->V_jadwal_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('v_jadwal'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('v_jadwal'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_transaksi_jadwal', 'id transaksi jadwal', 'trim|required');
	$this->form_validation->set_rules('nama_dokter', 'nama dokter', 'trim|required');
	$this->form_validation->set_rules('jenis_dokter', 'jenis dokter', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
	$this->form_validation->set_rules('foto', 'foto', 'trim|required');
	$this->form_validation->set_rules('hari', 'hari', 'trim|required');

	$this->form_validation->set_rules('', '', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "v_jadwal.xls";
        $judul = "v_jadwal";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Transaksi Jadwal");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Dokter");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Dokter");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Foto");
	xlsWriteLabel($tablehead, $kolomhead++, "Hari");

	foreach ($this->V_jadwal_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_transaksi_jadwal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_dokter);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_dokter);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->foto);
	    xlsWriteLabel($tablebody, $kolombody++, $data->hari);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file V_jadwal.php */
/* Location: ./application/controllers/V_jadwal.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-07-15 00:15:30 */
/* http://harviacode.com */