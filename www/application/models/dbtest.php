<?php
class DbTest extends CI_Model {
    function unique($username){
        //$query ="Select 'listname' from movieLists where 'moviename' = 'The Dark Knight (2008)'";
        $fetch = $this->db->get('movieLists', 1000);
        return $fetch->result();

    }
}
 ?>