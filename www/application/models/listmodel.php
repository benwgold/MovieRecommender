<?php
    class ListModel extends CI_Model{
        function check($moviename){
            $query="select moviename, listname from movieLists where moviename LIKE '%$moviename%'";
            $result=$this->db->query($query);
            return $result->result();
        }
    }
?>