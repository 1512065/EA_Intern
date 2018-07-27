<html>
<form method="post">
  Number of passenger:
  <input type="number" name="p_number">
  <input type="submit" name="sub_num">
</form>
</html>

<?php
    session_start();
    require_once ('./class.php');
    $pa_form = new Passenger_UI();
    if (isset($_POST['sub_num']) && $_POST['p_number'] > 0)
    {
        $pa_form ->p_number = $_POST['p_number'];
        //show form
        $pa_form ->show_full_form();       
    }
    if (isset($_POST['sub_info']))
    {
            //check info
            if ($pa_form ->check_form() == FALSE)
            {
                echo 'Invalid input...<br>';
                //$pa_form ->show_full_form();
            }
            else
            {
                
            }
    }
?>