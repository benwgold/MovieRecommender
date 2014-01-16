<?php
    class Home extends CI_Controller {
        function __construct(){
            parent::__construct();
            $this->load->library('ion_auth');
            $this->load->library('session');
            $this->load->library('form_validation');
            $this->load->helper('url');
            $this->load->database();

            $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        }
        function index(){
            if ($this->ion_auth->logged_in()){
                //redirect them to the default home page
                $this->load->view('loggedinview');
            }
            else{
                 $this->load->view('guestview');
            }
        }
        function loginform(){
            $this->load->view('loginform');
        }

        function register(){
            $username = $this->input->post('email');
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            $additional_data = array(
                               );
            $this->ion_auth->register($username, $password, $email, $additional_data);
            redirect('home', 'refresh');
        }
        function login(){
            $username = $this->input->post('identity');
            $password = $this->input->post('password');
            $remember = $this->input->post('remember');
            $this->ion_auth->login($username, $password, $remember);
            redirect('home', 'refresh');
        }
         function logout(){
            $this->ion_auth->logout();
            redirect('home', 'refresh');
        }
    }
?>