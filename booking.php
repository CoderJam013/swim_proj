<?php 
    session_set_cookie_params(0);
    session_start();
    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);

    function checkY($var)
    {
        if ($var == 'Y')
            return 1;
        else    
            return 0;
    }
    
    $bdetails = booking_details($con);

    $inter = getlockers($con);
    $mediate = mysqli_fetch_all($inter, MYSQLI_ASSOC);
    $result = array();
    for($i = 0; $i < mysqli_num_rows($inter); $i++)
    {
        $result[$i] = $mediate[$i]['locker_no'];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(strcmp($_POST['number'],'0') == 0)
        {
            $date_book = date_format(date_create($_POST['date']), 'Y-m-d');
            $batch = $_POST['batch'];
            $fins = checkY($_POST['swimming_fins'])  * 2;
            $cap = checkY($_POST['silicone_headcap']);
            $shorts = checkY($_POST['shorts']);
            $goggles = checkY($_POST['goggles']);
            $locker = $_POST['locker'];

            if(!empty($date_book) && (strcmp($batch, "morning") == 0 || strcmp($batch, "evening") == 0))
            {
                $q1 = "select slots_id from slots where date = '$date_book' and batch = '$batch'";
                $result = mysqli_query($con, $q1);
                if(mysqli_num_rows($result) > 0)
                {
                    echo "<script>alert('Already Booked!');</script>";
                }else
                {
                    $q2_total = "select * from accessories where s_id = 0";
                    $q2_fins = "select sum(swimming_fins) from accessories";
                    $q2_cap = "select sum(silicone_caps) as caps from accessories";
                    $q2_shorts = "select sum(shorts) as shorts from accessories";
                    $q2_goggles = "select sum(goggles) as goggles from accessories";

                    $total = mysqli_fetch_assoc(mysqli_query($con, $q2_total));
                    $fins_av = 2 * $total['swimming_fins'] - mysqli_fetch_assoc(mysqli_query($con, $q2_fins))['sum(swimming_fins)'];
                    $caps_av = 2 * $total['silicone_caps'] - mysqli_fetch_assoc(mysqli_query($con, $q2_fins))['caps'];
                    $shorts_av = 2 * $total['shorts'] - mysqli_fetch_assoc(mysqli_query($con, $q2_fins))['shorts'];
                    $goggles_av = 2 * $total['goggles'] - mysqli_fetch_assoc(mysqli_query($con, $q2_fins))['goggles'];
                    
                    if($fins > $fins_av)
                    {
                        $diff = $fins - $fins_av;
                        echo "<script>alert('$diff Fins unavailable!')</script>";
                    }
                    if($cap > $caps_av)
                    {
                        $diff = $caps - $caps_av;
                        echo "<script>alert('$diff Caps unavailable!')</script>";
                    }
                    if($shorts > $shorts_av)
                    {
                        $diff = $shorts - $shorts_av;
                        echo "<script>alert('$diff Shorts unavailable!')</script>";
                    }
                    if($goggles > $goggles_av)
                    {
                        $diff = $goggles - $goggles_av;
                        echo "<script>alert('$diff Goggles unavailable!')</script>";
                    }
                    if(($fins <= $fins_av) && ($cap <= $caps_av) && ($shorts <= $shorts_av) && ($goggles <= $goggles_av))
                    {
                        $q3_slots = "select max(slots_id) as id from slots";
                        $q3_uslots = "select max(s_id) as id from user_slots";

                        $slots_id = mysqli_fetch_assoc(mysqli_query($con, $q3_slots))['id'] + 1;
                        $s_id = mysqli_fetch_assoc(mysqli_query($con, $q3_uslots))['id'] + 1;
                        $userid = $_SESSION['userid'];

                        $qIns_slots = "insert into slots (slots_id, batch, date)  values($slots_id, '$batch', '$date_book')";
                        $qIns_uslots = "insert into user_slots (s_id, slots_id, userid)  values($s_id, $slots_id, $userid)";
                        $qIns_acc = "insert into accessories (s_id, swimming_fins, silicone_caps, shorts, goggles) values ($s_id, $fins, $cap, $shorts, $goggles)";
                        

                        mysqli_query($con, "set autocommit = 0");
                        mysqli_query($con, "start transaction");

                        $a1 = mysqli_query($con, $qIns_slots);
                        $a2 = mysqli_query($con, $qIns_uslots);
                        $a3 = mysqli_query($con, $qIns_acc);

                        $a4 = 1;
                        if(is_numeric($locker))
                            $a4 = mysqli_query($con, "update locker set s_id = '$s_id' where locker_no = $locker") ;

                        if($a1 && $a2 && $a3 && $a4){
                            mysqli_query($con, "commit");
                            mysqli_query($con, "set autocommit = 1"); 
                            echo '<script type ="text/JavaScript">alert("Booking Complete!");</script>';
                            echo "<script>window.location.href = 'booking.php';</script>";
                        }
                        else {
                            mysqli_query($con, "rollback");
                            mysqli_query($con, "set autocommit = 1"); 
                            echo '<script type ="text/JavaScript">alert("Booking Failed.");</script>';
                            echo "<script>window.location.href = 'booking.php';</script>";
                        }
                    }
                }
            }
            echo "<script>alert('Not Valid Info!');</script>";
            echo "<script>window.location = 'booking.php';</script>";
        }else
        {
            $sid = $_POST['number'];
            $locker = $_POST['locker'];

            mysqli_query($con, "set autocommit = 0");
            mysqli_query($con, "start transaction");	
            $a1 = 1;
            if(is_numeric($locker)){
                $q1 = "update locker set s_id = NULL where locker_no = $locker";
                $a1 = mysqli_query($con, $q1);
            }

            $q2 = "delete from slots where slots_id = $sid";
            $a2 = mysqli_query($con, $q2);
            
            if($a1 && $a2){
                mysqli_query($con, "commit");
                mysqli_query($con, "set autocommit = 1");        
                echo "<script>alert('Booking Cancelled!');</script>";
                echo "<script>window.location = 'booking.php';</script>";
            }
            else {
                mysqli_query($con, "rollback");
                mysqli_query($con, "set autocommit = 1");        
                echo "<script>alert('Booking Cancellation Failed!');</script>";
                echo "<script>window.location = 'booking.php';</script>";
            }
        }
        die;
    }
?>

<html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <title>Slot Booking</title>
    <style>  
        div.hero {
            opacity: 0.8;
        }
        #myHeader {
                background-color: rgb(60, 150, 181);
                color: rgb(246, 244, 244);
                padding: 25px;
                text-align: center;
                font-size: 25px;
                border-radius: 40px 20px;
                margin-left:50px;
                margin-right:50px;
        }
        .bdetails
        {
            width: 100%;
        }
    </style>
  
  </head>
    </head>
    <body  style="background-image: url('images/hero_1.jpg') ; background-repeat: no-repeat; background-size: cover; background-attachment: fixed">
            <div class="site-mobile-menu">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
        </div>
        
        <header class="site-navbar" role="banner">

        <div class="container">
            <div class="row align-items-center">
            
            <div class="col-11 col-xl-2">
                <h1 class="mb-0 site-logo"><a href="index.php" class="text-white mb-0">Aqua Pools</a></h1>
            </div>
            <div class="col-12 col-md-10 d-none d-xl-block">
                <nav class="site-navigation position-relative text-right" role="navigation">

                <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                    <li><a href="index.php"><span>Home</span></a></li>
                    <li><a href="profile.php"><span>Profile Page</span></a></li>
                    <li  class="active"><a href="booking.php"><span>Book your slot</span></a></li>
                    <li><a href="pass.php"><span>Monthly Pass</span></a></li>
                    <li><a href="contact.php"><span>Contact</span></a></li>
                    <li><a href="logout.php"><span>Log out</span></a></li>
                </ul>
                </nav>
            </div>


            <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

            </div>

            </div>
        </div>
        
        </header>
        
        

        <div  > 
        <br>  <br>  <br><br>
        <div class="grid grid-pad"  style="background-color: lightblue; opacity: 0.9;border-radius: 70px 20px; margin-left:250px;margin-right:250px; text-align:center;">
                    <div class="col-1-1">
                         <div class="content content-header" >
                        <p style="font-weight: bold; font-size: 60px; color: grey;">Book Your Slot </h2>
                         </div>
                    </div>
                </div>
    <section class="ftco-section" >
        <div class="container" >
            <div class="hero"  >
                <div class="col-md-2 col-lg-12" >
                    <div class="wrap d-md-flex" >
                        
                        <div class="login-wrap p-4 p-lg-5" style="border-radius: 20px 20px;">
                            <form method="post" class="signin-form">
                        <div class="form-group mb-3">
                            <label class="label" for="date">Date</label>
                            <input type="date" class="form-control" placeholder="date" name = "date" required>
                        </div>
                    <div class="form-group mb-3">
                        <div class="form-group mb-3"><label class="label" for="batch">Batch&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                                        <input name = "batch" id = "morning" type = "radio" value = "morning" checked>
                                        <label for="morning">Morning Batch &nbsp&nbsp</label>  
                                        <input name = "batch" id = "evening" type = "radio" value = "evening" selected>
                                        <label for="evening">Evening Batch &nbsp&nbsp</label> </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-group mb-3"><label class="label" for="silicone_headcap">Silicone Headcaps&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                                        <input name = "silicone_headcap" id = "yes" type = "radio" value = "Y" checked>
                                        <label for="yes">Yes &nbsp&nbsp</label>  
                                        <input name = "silicone_headcap" id = "no" type = "radio" value = "N" selected>
                                        <label for="no">No &nbsp&nbsp</label> </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-group mb-3"><label class="label" for="shorts">Swimming Shorts (men)&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                                        <input name = "shorts" id = "yes" type = "radio" value = "Y" checked>
                                        <label for="yes">Yes &nbsp&nbsp</label>  
                                        <input name = "shorts" id = "no" type = "radio" value = "N" selected>
                                        <label for="no">No &nbsp&nbsp</label> </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-group mb-3"><label class="label" for="swimming_fins">Swimming Fins&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                                        <input name = "swimming_fins" id = "yes" type = "radio" value = "Y" checked>
                                        <label for="yes">Yes &nbsp&nbsp</label>  
                                        <input name = "swimming_fins" id = "no" type = "radio" value = "N" selected>
                                        <label for="no">No &nbsp&nbsp</label> </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-group mb-3"><label class="label" for="goggles">Swimming Goggles&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                                        <input name = "goggles" id = "yes" type = "radio" value = "Y" checked>
                                        <label for="yes">Yes &nbsp&nbsp</label>  
                                        <input name = "goggles" id = "no" type = "radio" value = "N" selected>
                                        <label for="no">No &nbsp&nbsp</label> </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-group mb-3"><label class="label" for="locker">Lockers Available&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                                        <select name="locker">
                                            <option value="-">-</option>
                                            <?php
                                                for($i = 0; $i < mysqli_num_rows($inter); $i++)
                                                {
                                                    $var = $result[$i];
                                                    echo "<option value='$var'>$var</option>";
                                                }
                                            ?>
                                        </select>
                                        
                    </div>
                    <input name="number" type='hidden' value = '0'>
                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-primary submit px-3">Submit</button>
                    </div>
                    
                    <div class="form-group d-md-flex">
                        
                    </div>
                  </form>
                </div>
              </div>
                </div>
            </div>
        </div>
        
    </section>
    <div class="grid grid-pad"  style="background-color: lightblue; opacity: 0.9;border-radius: 70px 20px; margin-left:250px;margin-right:250px; text-align:center;">
                    <div class="col-1-1">
                         <div class="content content-header" >
                        <p style="font-weight: bold; font-size: 60px; color: grey;">Booking Details</h2>
                         </div>
                    </div>
                </div>
    <!--<div class="container" style= "width: 90% !important;">
            <div class="hero"  >
                <div class="col-md-2 col-lg-12" >
                    <div class="wrap d-md-flex" >-->
                        <div class="login-wrap p-4 p-lg-5" style="border-radius: 20px 20px; width: 90%!important; left:5%!important;">
                            <table class = 'bdetails'>
                                <tr>
                                    <th>Booking id</th>
                                    <th>Batch</th>
                                    <th>Date</th>
                                    <th>Fins</th>
                                    <th>Caps</th>
                                    <th>Shorts</th>
                                    <th>Goggles</th>
                                    <th>Locker No.</th>
                                </tr>
                                <?php
                                    foreach($bdetails as $booking)
                                    {
                                        if(!empty($booking['slots_id'])){
                                            $sid = $booking['slots_id']; $bat = $booking['batch']; $date = $booking['date'];
                                            $fins_b = $booking['fins']; $caps_b = $booking['caps']; $shorts_b = $booking['shorts'];
                                            $gogg_b = $booking['goggles']; 
                                            $locker = $booking['locker_no'];
                                            if(empty($locker))
                                                $locker = '-';
                                                
                                            echo "
                                            <tr>
                                                <td>$sid</td>
                                                <td>$bat</td>
                                                <td>$date</td>
                                                <td>$fins_b</td>
                                                <td>$caps_b</td>
                                                <td>$shorts_b</td>
                                                <td>$gogg_b</td>
                                                <td>$locker</td>
                                                <td><form method = 'post'><input name = 'locker' type = 'hidden' value = '$locker'><input name = 'number' type = 'hidden' value = '$sid'><div class='form-group'>
                                                <button type='submit' class='form-control btn btn-primary submit px-3'>Cancel Booking</button>
                                            </div></form></td>
                                            </tr>
                                            ";
                                        }
                                    }
                                ?>
                            <table>
                        </div>
                  <!--</div>
                </div>  
            </div>
        </div>-->

        
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/main.js"></script>

    </body>
</html>