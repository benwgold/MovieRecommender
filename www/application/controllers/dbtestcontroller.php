<?php
class DbTestController extends CI_Controller {
    function index() {
        $this->load->model('dbtest');
        $data['records']=$this->dbtest->fetchLists();
        $this->load->view('dbtestviews',$data);
    }
}
?>