<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jenis_berobat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Jenis_berobat_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'jenis_berobat/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'jenis_berobat/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'jenis_berobat/index.html';
            $config['first_url'] = base_url() . 'jenis_berobat/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Jenis_berobat_model->total_rows($q);
        $jenis_berobat = $this->Jenis_berobat_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'jenis_berobat_data' => $jenis_berobat,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('jenis_berobat/jenis_berobat_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Jenis_berobat_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'jenis_pasien' => $row->jenis_pasien,
	    );
            $this->load->view('jenis_berobat/jenis_berobat_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_berobat'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jenis_berobat/create_action'),
	    'id' => set_value('id'),
	    'jenis_pasien' => set_value('jenis_pasien'),
	);
        $this->load->view('jenis_berobat/jenis_berobat_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'jenis_pasien' => $this->input->post('jenis_pasien',TRUE),
	    );

            $this->Jenis_berobat_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jenis_berobat'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Jenis_berobat_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jenis_berobat/update_action'),
		'id' => set_value('id', $row->id),
		'jenis_pasien' => set_value('jenis_pasien', $row->jenis_pasien),
	    );
            $this->load->view('jenis_berobat/jenis_berobat_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_berobat'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'jenis_pasien' => $this->input->post('jenis_pasien',TRUE),
	    );

            $this->Jenis_berobat_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jenis_berobat'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Jenis_berobat_model->get_by_id($id);

        if ($row) {
            $this->Jenis_berobat_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jenis_berobat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_berobat'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('jenis_pasien', 'jenis pasien', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "jenis_berobat.xls";
        $judul = "jenis_berobat";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Pasien");

	foreach ($this->Jenis_berobat_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_pasien);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Jenis_berobat.php */
/* Location: ./application/controllers/Jenis_berobat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-07-15 00:15:30 */
/* http://harviacode.com */