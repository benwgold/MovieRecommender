<?php
class RTApi extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    function details($moviename, $resultnum){
        $data = $this->titlesearch($moviename);
        if (count($data['movies']) == 0){
            $jsonResponse = array(
                'success' => false,
                'error' => 'No Movies Found'
            );
        }
        else {
            $jsonResponse = array(
                'success' => true,
                'id' => mysql_real_escape_string($data['movies'][$resultnum]['id']),
                'title' => mysql_real_escape_string($data['movies'][$resultnum]['title']),
                'year' => mysql_real_escape_string($data['movies'][$resultnum]['year']),
                'poster' => mysql_real_escape_string($data['movies'][$resultnum]['posters']['profile'])
            );
            if (isset($data['movies'][$resultnum]['critics_consensus'])){
                $jsonResponse['critics_consensus'] = mysql_real_escape_string($data['movies'][$resultnum]['critics_consensus']);
            }
        }
        return json_encode($jsonResponse);
    }

    function toptitles($moviename){
        $data = $this->titlesearch($moviename);
        if (count($data['movies']) == 0){
            $jsonResponse = array(
                'success' => false,
                'error' => 'No Movies Found'
            );
            return json_encode($jsonResponse);
        }
        else{
            $i = 0;
            $output = array();
            while ($i<5 AND $i<count($data['movies'])){   //CAN ALSO PUT <count($data['movies']
                $output[$i] = htmlentities($data['movies'][$i]['title']." (".$data['movies'][$i]['year'].")");
                $i = $i+1;
            }
            $jsonResponse = array(
                'success' => true,
                'output' => $output
            );
            return json_encode($jsonResponse);
        }
    }
    function titlesearch($moviename){
        $query = urlencode($moviename);
        $json_url = "http://api.rottentomatoes.com/api/public/v1.0/movies.json?q=".$query."&apikey=aytjrsdaeashnuqg2u6cncnp";
        $json = file_get_contents($json_url);
        $data = json_decode($json, TRUE);
        return $data;
    }
}
?>