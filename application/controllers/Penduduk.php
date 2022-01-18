<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penduduk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Penduduk_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/penduduk/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/penduduk/index/';
            $config['first_url'] = base_url() . 'index.php/penduduk/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Penduduk_model->total_rows($q);
        $penduduk = $this->Penduduk_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'penduduk_data' => $penduduk,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','penduduk/tbl_penduduk_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Penduduk_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama' => $row->nama,
		'alamat' => $row->alamat,
        'nik' => $row->nik,
        'file_KK' => set_value('file_KK', $row->file_KK)
	    );
            $this->template->load('template','penduduk/tbl_penduduk_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penduduk'));
        }
    }

    public function create() 
    {
        
        $data = array(
            'button' => 'Create',
            'action' => site_url('penduduk/create_action'),
	    'id' => set_value('id'),
	    'nama' => set_value('nama'),
	    'alamat' => set_value('alamat'),
        'nik' => set_value('nik'),
        'file_KK' => set_value('file_KK')
        ,
	);
        $this->template->load('template','penduduk/tbl_penduduk_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            // $file = "";
            $config['upload_path'] = './upload/';
            $config['allowed_types'] = 'gif|jpg|png|pdf';
            $config['max_size'] = 5000;
            $this->upload->initialize($config);
                    if(!$this->upload->do_upload('file_KK')){
                        $file = "";
                    }else{
                        $file = $this->upload->file_name;
                    }
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
        'nik' => $this->input->post('nik',TRUE),
        'file_KK' => $file
	    );

            $this->Penduduk_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('penduduk'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Penduduk_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('penduduk/update_action'),
		'id' => set_value('id', $row->id),
		'nama' => set_value('nama', $row->nama),
		'alamat' => set_value('alamat', $row->alamat),
        'nik' => set_value('nik', $row->nik),
        'file_KK' => set_value('file_KK', $row->file_KK)
	    );
            $this->template->load('template','penduduk/tbl_penduduk_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penduduk'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'nik' => $this->input->post('nik',TRUE),
	    );

            $this->Penduduk_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('penduduk'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Penduduk_model->get_by_id($id);

        if ($row) {
            $this->Penduduk_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('penduduk'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penduduk'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('nik', 'nik', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Penduduk.php */
/* Location: ./application/controllers/Penduduk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-10-29 06:43:59 */
/* http://harviacode.com */