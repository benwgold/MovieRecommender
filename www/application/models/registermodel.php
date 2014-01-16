<?php
    class RegisterModel extends CI_Model{
        function insert($username, $password)
        $thisUsername = mysql_real_escape_string($_POST['username']);
        $query = "INSERT INTO users() * FROM users WHERE username = '".$username."'";


        $result = mysql_query($duplicateQuery);


        if(mysql_num_rows($result) > 0){

            $response = Array(

                "status" => "FAIL",

                "error" => "This Username Has Been Taken"

            );

            echo json_encode($response);

            die();

        }


        if($thisToken != $_SESSION['token']){

            $response = Array(

                "status" => "FAIL",

                "error" => "Bad Token"

            );

            echo json_encode($response);

            die();

        }


        if (preg_match('/[^a-z0-9 ]/i', $thisUsername) && preg_match('/[^a-z0-9 ]/i', $thisPassword)){

            $response = Array(

                "status" => "FAIL",

                "error" => "Used Special Characters"

            );
            echo json_encode($response);

            die();

        }


        $insertQuery = "INSERT INTO users (username, password) VALUES ('".$thisUsername."', PASSWORD('".$thisPassword."'))";


        $insertSuccess = mysql_query($insertQuery);


        if($insertSuccess){

            $response = Array(

                "status" => "OK"

            );

            $_SESSION['user'] = mysql_insert_id();

            echo json_encode($response);
        }

        else{

            $response = Array(

                "status" => "FAIL",

                "error" => "INSERT_FAILED"

            );

            echo json_encode($response);

            die();

        }
    }
}

?>
