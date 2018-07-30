
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
    $passenger = new Passenger();
    $passenger->show();
    if (isset($_POST['sub_info']))
    {
        $passenger->info_to_array();
        $_SESSION['post_data'] = $_POST;
        $passenger->quote();
    } 
    if (isset($_POST['sub_reg']))
    {  
        $passenger->policy();
    }
    
?>