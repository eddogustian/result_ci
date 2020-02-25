<?php 
defined('BASEPATH') OR exit('NO direct script access allow');

class C_Index extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_Index'); //auto load model pada fungsi construct
    }
    public function index() {
        $this->load->view('V_Index');
    }
    function getData() {
        $data = $this->M_Index->getData(); //menampung value return dari fungsi getData ke variabel $data
        echo json_encode($data); //mengencode data menjadi json format
    }
    function getDataByNoinduk() {
        $noinduk    = $this->input->post('noinduk'); //menangkap inputan no induk
        $data       = $this->M_Index->getDataByNoinduk($noinduk);
        echo json_encode($data);
    }
    function deleteData(){
        $noinduk = $this->input->post('noinduk');
        $data = $this->M_Index->deleteData($noinduk);
        echo json_encode($data);
    }
    function addData() {
        $noinduk = $this->input->post('noinduk');
        $nama    = $this->input->post('nama');
        $alamat  = $this->input->post('alamat');
        $hobi    = $this->input->post('hobi');

        $data    = ['noinduk' => $noinduk, 'nama' => $nama, 'alamat' => $alamat, 'hobi' => $hobi];
        $data    = $this->M_Index->insertData($data);
        print_r($data);die();
        echo json_encode($data);
    }
    function updateData() {
        $noinduk = $this->input->post('noinduk');
        $nama    = $this->input->post('nama');
        $alamat  = $this->input->post('alamat');
        $hobi    = $this->input->post('hobi');

        $data    = ['noinduk' => $noinduk, 'nama' => $nama, 'alamat' => $alamat, 'hobi' => $hobi];
        $data    = $this->M_Index->updateData($noinduk, $data);
        echo json_encode($data);
    }
}