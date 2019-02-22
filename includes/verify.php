<?php
include("config.php");

if(isset($_GET['email']) AND isset($_GET['hash'])){
    $email = $_GET['email'];
    $hash = $_GET['hash'];

    $search = mysqli_query($con,"SELECT email, hash FROM users WHERE email='$email' AND hash='$hash' AND activeStatus='0'") or die(mysqli_error($con));
    $match  = mysqli_num_rows($search);
    
    if($match > 0){
        mysqli_query($con,"UPDATE users SET activeStatus='1' WHERE email='".$email."' AND hash='".$hash."' AND activeStatus='0'") or die(mysqli_error($con));
        echo '<div class="statusmsg">Your account has been activated, you can now <a href="http://localhost/andMusic/register.php">login</a></div>';
    }
    else{
        echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
    }
    
}
else{
    // Invalid approach
    echo '<div class="statusmsg">Invalid approach, please use the link that has been send to your email.</div>';
}

?>