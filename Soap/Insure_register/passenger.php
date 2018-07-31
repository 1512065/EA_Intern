<?php
require_once('./soap.php');
class Passenger
{
    //number of passenger
    public $p_number;
    //passenger info
    public $p_info = array();
    //representative passenger id in $p_info
    public $p_prim = 0;
    //display single form
    public function show_sigle_form($id)
    {
        $num = $id + 1;
        echo 
            '<h3>Passenger '.$num.'</h3>
            Surname: 
            <input type="text" name="surname'.$id.'">
            Given name: 
            <input type="text" name="givenname'.$id.'"> 
            DOB:
            <input type="date" name="dob'.$id.'"><br>
            Gender:
            <input type="radio" name="gender'.$id.'" value="M" checked> Male
            <input type="radio" name="gender'.$id.'" value="F"> Female
            <input type="radio" name="gender'.$id.'" value="U"> Other <br>
            Representative
            <input type="radio" name="rep" value='.$id;
        if ($id == 0) //default representative
        {
            echo ' checked';
        } 
        echo'><br><br>';
    }
    //display full form
    public function show_full_form()
    {
        echo '<h2>Complete form </h2>'; 
        echo '
            <form method="post">
            Insure from <input type="date" name="start_day">
            to <input type="date" name="end_day">
            <br>
            Representative info <br>
            Phone number:
            <input type="text" name="phone">
            Email:
            <input type="text" name="email"><br>
            <br>';
        //display each passenger form
        for ($i = 0; $i < $this->p_number ; $i++)
        {
            $this ->show_sigle_form($i);
        }
        echo '<input type="hidden" name="number" value="'.$this->p_number.'"><input type="submit" name="sub_info" value="Register Insure"></form>';
    }
    //check input information
    public function check_form()
    {   
        /*
        $name_arr = array();
        foreach ($_POST as $key => $value)
        {
            //get all name
            if (preg_match('/name\d/', $key))
            {
                array_push($name_arr, $value);
            }
        }
        //check name
        $name_patt = '/^[a-z\s]*$/';
        foreach ($name_arr as $name)
        {
            if (!preg_match($name_patt, $name))
                return false;
        }
        //check phone 
        //check email
        */
        return true;
    }
    //get value into arrat
    public function info_to_array()
    {   
        if (isset($_SESSION['post_data']))
        {
            $this->p_info = $_SESSION['post_data']; 
        }
       
    }
    public function show()
    {
        if (isset($_POST['sub_num']) && $_POST['p_number'] > 0)
        {       
            $this ->p_number = $_POST['p_number'];
            //show form
            $this ->show_full_form();
        }
    }
    public function quote()
    {
        //check info
        if ($this ->check_form() == FALSE)
        {
            echo 'Invalid input...<br>';
            //$this ->show_full_form();
        }
        else //input correct
        {
            $this ->info_to_array();
            $QuoteRequest = new Soap_Request();
            //get quote
            $QuoteRequest->get_Quote($this->p_info);
            //get policy button
            echo '<br><form method="post"><input type="submit" name="sub_reg" value="Confirm">';             
        } 
    }
    public function policy()
    {
        $PolicyRequest = new Soap_Request();
        $this ->info_to_array();
        // build pass_info arr
        $data = $this->p_info;
        $p_num = $data['number'];
        $pass_info = array();
        for ($i = 0; $i < $p_num; $i++)
        {
            $title = 'Ms';
            if ($data["gender$i"] == 'M')
            {
                $title = 'Mr';
            }
            $per_info = array('PersonName'=>array('Surname' => $data["surname$i"], 'GivenName' => $data["givenname$i"], 'TitlePrefix' => $title), 
                                'BirthDt' => $data["dob$i"],'Gender' => $data["gender$i"]);
            if ($data['rep'] == $i)
            {
                $per_info['TitleRelationshipDesc'] = 'Policy Holder';
            }
            array_push($pass_info, $per_info);
        }
        $PolicyRequest->get_Policy($this->p_info, $pass_info);
    }
}
?>