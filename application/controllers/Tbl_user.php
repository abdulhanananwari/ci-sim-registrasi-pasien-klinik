<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_user extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tbl_user_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'tbl_user/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tbl_user/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tbl_user/index.html';
            $config['first_url'] = base_url() . 'tbl_user/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tbl_user_model->total_rows($q);
        $tbl_user = $this->Tbl_user_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_user_data' => $tbl_user,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('tbl_user/tbl_user_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_user_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'username' => $row->username,
		'password' => $row->password,
	    );
            $this->load->view('tbl_user/tbl_user_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_user'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_user/create_action'),
	    'id' => set_value('id'),
	    'username' => set_value('username'),
	    'password' => set_value('password'),
	);
        $this->load->view('tbl_user/tbl_user_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'username' => $this->input->post('username',TRUE),
		'password' => $this->input->post('password',TRUE),
	    );

            $this->Tbl_user_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tbl_user'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_user_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_user/update_action'),
		'id' => set_value('id', $row->id),
		'username' => set_value('username', $row->username),
		'password' => set_value('password', $row->password),
	    );
            $this->load->view('tbl_user/tbl_user_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_user'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'username' => $this->input->post('username',TRUE),
		'password' => $this->input->post('password',TRUE),
	    );

            $this->Tbl_user_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_user'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_user_model->get_by_id($id);

        if ($row) {
            $this->Tbl_user_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_user'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_user.xls";
        $judul = "tbl_user";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Username");
	xlsWriteLabel($tablehead, $kolomhead++, "Password");

	foreach ($this->Tbl_user_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->username);
	    xlsWriteLabel($tablebody, $kolombody++, $data->password);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Tbl_user.php */
/* Location: ./application/controllers/Tbl_user.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-07-15 00:15:30 */
/* http://harviacode.com */