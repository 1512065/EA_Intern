<?php
    header('Access-Control-Allow-Origin: *');  
    //load data
    $data_str = file_get_contents("./data/airport.json");
    $data = json_decode($data_str, true);

    // get airport name + code only
    $arr = $data['airports'];
    function getAirport($arr) {
        foreach ($arr as $index => $airport) {
            $res[$index]['three_letter_code'] = $airport['three_letter_code'];
            $res[$index]['airport_name'] = $airport['airport_name'];
        }
        return $res;
    }
    $airport_arr = getAirport($arr);
    
    //response request
    if(empty($_GET)) { //default
        $response = json_encode($airport_arr);
        echo $response;
    } else {
        //filter by term
        if(isset($_GET['term'])){
            $key = $_GET['term'];
            $filter = array();
            foreach ($airport_arr as $airport) {
                if( strpos($airport['airport_name'] , $key) !== false) {
                    array_push($filter, $airport);
                } else if (strpos($airport['three_letter_code'] , $key) !== false) {
                    array_push($filter, $airport);
                }
            }  
        } else { //no term
            $filter = $airport_arr;
        }
        //sorting
        if(isset($_GET['sort'])) {
            if($_GET['sort']=='desc') {
                $filter = array_reverse($filter);
            } 
            //else ='asc' by default
        }
        $response = json_encode($filter);
        echo $response;
    }
    
?>