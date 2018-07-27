<?php
class Passenger_UI
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
            Full name: 
            <input type="text" name="fullname'.$id.'"> 
            DOB:
            <input type="date" name="dob'.$id.'"><br>
            Gender:
            <input type="radio" name="gender'.$id.'" value="male" checked> Male
            <input type="radio" name="gender'.$id.'" value="female"> Female
            <input type="radio" name="gender'.$id.'" value="other"> Other <br>
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
        echo '<input type="submit" name="sub_info" value="Register Insure"></form>';
    }
    //check input information
    public function check_form()
    {   
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
        return true;
    }
    //
}
?>