<?php
class MovieInfo extends CI_Controller {
    function index(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('movieinfo/rtapi');
    }
     function topresult(){
        $query = $this->input->post('moviename');
        $this->load->model('movieinfo/rtapi');
        echo $this->rtapi->details($query, 0);
    }
    function titlelist(){
        $query = $this->input->post('moviename');
        $this->load->model('movieinfo/rtapi');
        echo $this->rtapi-> toptitles($query);
    }
}
?>