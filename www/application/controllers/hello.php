<?php
class Hello extends CI_Controller {
    function index() {
        $this->load->spark('example-spark/1.0.0');      # We always specify the full path from the spark folder
        $this->example_spark->printHello();
    }
}
?>