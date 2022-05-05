<?php
    session_set_cookie_params(0);
    session_start();
    session_unset();
    echo "<script>alert('Logged Out')</script>";
    echo "<script>window.location = 'login.php'</script>";
