<?php
session_start();
$error = "";
$success = "";
$cust_id = 0;

if(isset($_SESSION['id'])) {
    unset($_SESSION['id']);
    }


$link = mysqli_connect("localhost","root","","reviews");
	
    if(mysqli_connect_error())
    {
    echo "Database not connected";
    }
if(array_key_exists("signup-submit",$_POST)){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($error == "")
    {
        $query = "SELECT `id` FROM `users` WHERE email='".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1";
        $result = mysqli_query($link,$query);
        
        if(mysqli_num_rows($result)>0)
        {
            $error="Email id is already registered Try Loggin in<br>";            
        }
        else
        {
            $query1 = "INSERT INTO `users` (firstname,lastname,email,password) VALUES('".mysqli_real_escape_string($link,$_POST['firstname'])."','".mysqli_real_escape_string($link,$_POST['lastname'])."','".mysqli_real_escape_string($link,$_POST['email'])."','".mysqli_real_escape_string($link,$_POST['password'])."')";

            if(!mysqli_query($link,$query1))
            {
                $error="Could not create Account.Try Again later<br>";
            }
            else{

                $query2 = "SELECT * FROM `users` WHERE firstname = '".mysqli_real_escape_string($link,$_POST['firstname'])."' AND lastname = '".mysqli_real_escape_string($link,$_POST['lastname'])."'  ";
                if($result = mysqli_query($link,$query2)){
                $row = mysqli_fetch_array($result);
                $cust_id = $row['id'];
                $_SESSION['id']= $cust_id;
            }


                
            }
            
        }
        if(isset($_SESSION['id'])) {
            echo "<script> 
                    document.addEventListener('DOMContentLoaded', function(e){
                    e.preventDefault();
                    document.querySelector(input).placeholder = '';
                });</script>";
            header("Location:loggedinpage.php");
            }
    }

}

else if(array_key_exists("login-submit",$_POST)){
    $email = $_POST['email'];
    $password = $_POST['password'];
    if($error == "")
    {
        $query = "SELECT * FROM `users` WHERE email='".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1";
        $result = mysqli_query($link,$query);
        $row = mysqli_fetch_array($result);
        if(isset($row)){
            $id = $row['id'];
            $pass = $row['password'];
            if($password == $pass){
                $_SESSION['id']= $id;
            }
            else{
                $error.="Wrong Password Entered.<br>";
            }
        }
        else{
            $error.="Account not created! Please Sign Up First<br>"; 
        }
        if(isset($_SESSION['id'])) {
            echo "<script> 
                    document.addEventListener('DOMContentLoaded', function(e){
                    e.preventDefault();
                    document.querySelector(input).placeholder = '';
                });</script>";
            header("Location:loggedinpage.php");
            }

    }



}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AtoZ Movie Reviews</title>
    <link href="style/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <script defer src=script/script.js></script>
</head>

<body>
    <section class="header">
        <img class="icon-image" src="images/icon.png">
        <h1>AtoZ Movie Reviews</h1>
        <a class="menu-options" href="">Home</a>
        <a class="menu-options" href="toprated.php">Top Rated Movies</a>
        <a class="menu-options" href="comingsoon.php">Top Rated Tv-Series</a>
        <a class="menu-options" href="">About Us</a>
    </section>
    <section class ="error" >
            <p><?php echo $error; ?>
        </section>
        <section class ="success" >
            <p><?php echo $success; ?>
    </section>
    <section class="middle-container">
        <section class="middle">
            <h2 class="intro">Give <span class="green">Reviews⭐⭐</span> for <br>
                <span class="green">Movies 🎬</span> watched by you.
            </h2>
            <div class="hr"></div>
            <p id="description">Give Reviews and also watch more movies by refering to the reviews.</p>
            <section class="signup-container">
                <p id="signup-para">Sign Up to Review a Movie</p>
                <button class="sign-up-button" type="button">Sign Up</button>
                <p id="login-para">Already a User ? <a class="login-button" href="">Login</a></p>
            </section>
        </section>
        <img class="side-image" src="images/side.jpg">

    </section>

    <div class="signup-modal modal hidden">
        <button class="btn--close-modal">&times;</button>
        <h2 class="modal__header">
            Open your account
        </h2>
        <form method="post" class="modal__form">
            <label>First Name</label>
            <input type="text" name="firstname" required=true />
            <label>Last Name</label>
            <input type="text" name="lastname" required=true/>
            <label>Email</label>
            <input type="email" name="email" required=true/>
            <label>Password</label>
            <input type="password" name="password" required=true/>
            <button class="btn" name="signup-submit">Sign Up &rarr;</button>
        </form>
    </div>

    <div class="login-modal modal hidden">
        <button class="btn--close-modal btn--close-modal-login">&times;</button>
        <h2 class="modal__header">
            Login to your account !
        </h2>
        <form method="post" class="modal__form">
            <label>Email</label>
            <input type="email" name="email" required=true/>
            <label>Password</label>
            <input type="password" name="password" required=true />
            <button class="btn" name="login-submit">Login &rarr;</button>
        </form>
    </div>

    <div class="overlay hidden"></div>

</body>

</html>