<?php
class ListCheck extends CI_Controller {
    function index(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('listmodel');
        $this->load->view('listview');
    }
 function checkrt(){
        $this->load->model('listmodel');
        $query = $this->input->post('moviename');
        $thisQuery = urlencode($query);
        $json_url = "http://api.rottentomatoes.com/api/public/v1.0/movies.json?q=".$thisQuery."&apikey=aytjrsdaeashnuqg2u6cncnp";
        $json = file_get_contents($json_url);
        $data = json_decode($json, TRUE);
        if (count($data['movies']) == 0){
            $jsonResponse = array(
                'success' => false,
                'error' => 'No Movies Found'
            );
            echo json_encode($jsonResponse);
        }
        else{
            $i = 0;
            $output = array();
            while ($i<5){   //CAN ALSO PUT <count($data['movies']
                $output[$i] = htmlentities($data['movies'][$i]['title']);
                $i = $i+1;
            }
            $jsonResponse = array(
                'success' => true,
                'output' => $output
            );
            echo json_encode($jsonResponse);
        }
    }

    function checkdb(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('moviename', 'Movie Name', 'trim|required');
        if($this->form_validation->run()==FALSE){
            redirect('home', 'refresh');
        }
        $this->load->model('listmodel');
        $moviename = $this->input->post('moviename');
        $result = $this->listmodel->check($moviename);
        if (count($result>0)){
            $data = array(
                'moviename' => $moviename,
                'result' => $result
                );
            $this->load->view('listviewsuccess',$data);
        }
        else{
            echo 'Sorry yo, no movies like that';
        }
    }
}
?>


