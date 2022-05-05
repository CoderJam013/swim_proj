<?php

function check_login($con)
{
    if(isset($_SESSION['userid']))
    {
        $id = $_SESSION['userid'];
        $query = "select * from user where userid = '$id' limit 1";
        
        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }else{
    //redirect to login
        echo "<script>alert('Not Logged In!!');</script>";
        echo "<script>window.location = 'login.php';</script>";
    }
    die;
}

function check_logout()
{
    if(isset($_SESSION['userid']))
    {
        echo "<script>alert('Already Logged In!!');</script>";
        echo "<script>window.location = 'index.php';</script>";
    }
}

function get_pass($con)
{
    $id = $_SESSION['userid'];
    $query = "select * from montly_pass where userid = '$id' limit 1";
    $result = mysqli_query($con, $query);
    if($result && mysqli_num_rows($result) > 0)
    {
        $user_data = mysqli_fetch_assoc($result);
        return $user_data;
    }else{
        echo "<script>alert('Unable to retrieve pass details')</script>";
        echo "<script>window.location = 'index.php';</script>";
    }
}

function getlockers($con)
{
    $query = "select locker_no from locker where s_id is null";
    return mysqli_query($con, $query);
}

function pass_status($con)
{
    $id = $_SESSION['userid'];
    $query = "select expiry_date from montly_pass where userid = $id";
    $result = mysqli_fetch_assoc(mysqli_query($con, $query))['expiry_date'];
    $exp_date = date_create($result);
    if(date_create() > $exp_date);
        mysqli_query($con, "update montly_pass set pass_status = 'Inactive' where userid = $id");
}

function booking_details($con)
{
    $id = $_SESSION['userid'];
    $q1 = "select slots_id, s_id, date, batch, swimming_fins as fins, silicone_caps as caps, shorts, goggles from slots natural join user_slots natural join accessories where userid = $id";
    $result = mysqli_fetch_all(mysqli_query($con, $q1), MYSQLI_ASSOC);
    foreach($result as $key => $value)
    {
        $result[$key]['locker_no'] = NULL;
        if(!empty($result[$key])){
            $sid = $result[$key]['s_id'];
            $q2 = "select locker_no from locker where s_id = $sid";
            $locker = mysqli_query($con, $q2);
            if(mysqli_num_rows($locker) > 0){
                $var = mysqli_fetch_assoc($locker)['locker_no'];
                $result[$key]['locker_no'] = $var;
            }
        }
    }
    
    return $result;
}