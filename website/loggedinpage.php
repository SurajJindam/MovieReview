<?php
session_start();
if(!isset($_SESSION['id'])){
    header("Location:index.php");
}

    $error = "";
    $success = "";
    $movies = array(
        "Joker" => 1,
        "Avengers" => 2,
        "War" => 3,
        "Saaho" => 4,
        "Bahubali" => 5,
        "Master" => 6,
        "Parasite" => 7,
        "Black Panther" => 8,
        "Krack" => 9,
        "Fight Club" => 10
    );
    $link = mysqli_connect("localhost","root","","reviews");
        
    if(!isset($_SESSION['id'])){
        header("Location:index.php");
    }
    if(mysqli_connect_error())
    {
    echo "Database not connected";
    }
    $id = $_SESSION['id'];

    $query = "SELECT * FROM `users` WHERE id = '".$id."' ";
    if($result = mysqli_query($link,$query)){
        $row = mysqli_fetch_array($result);
        if(isset($row)){
            echo "<script> 
                    document.addEventListener('DOMContentLoaded', function(e){
                        e.preventDefault();
                        document.querySelector(`.welcome`).textContent = `Welcome ".$row[2]." .....`;
                });</script>";
        }
    }

    for($i=1;$i<=10;$i++){
        $query = "SELECT * FROM `ratings` WHERE movie_id = '".$i."' AND user_id = '".$id."' LIMIT 1";
        if($result = mysqli_query($link,$query)){
            $row = mysqli_fetch_array($result);
            if(isset($row)){
                echo "<script> 
                    document.addEventListener('DOMContentLoaded', function(e){
                        e.preventDefault();
                        document.querySelector(`.rate-button-${i}`).classList.add('hidden');
                        document.querySelector(`.user-rating-${i}`).classList.add('hidden');
                        document.querySelector(`.after_rating_${i}`).classList.remove('hidden');
                        document.querySelector(`.after_rating_${i}`).value = '".$row['rating']."';
                });</script>";
            }
        }
        
    }


    for($j=1;$j<=10;$j++){
        $query = "SELECT CAST(AVG(rating) AS DECIMAL (10,1)) FROM ratings WHERE movie_id = '".$j."' ";
        if($result = mysqli_query($link,$query)){
            $row = mysqli_fetch_array($result);
            if($row[0] != ""){
                echo "<script> 
                    document.addEventListener('DOMContentLoaded', function(e){
                        e.preventDefault();
                        document.querySelector(`.rating-${j}`).textContent = '⭐".$row[0]."';
                });</script>";



            }
        }
    }
    
    if(array_key_exists('submit',$_POST)){
        $movieId = $movies[$_POST['submit']];
        $rate = $_POST["user_rating_{$movieId}"];
        
        
        if($rate == ""){
            $error.= "Please select Rating<br>";
        }
        if($error == ""){
            $query = "INSERT INTO `ratings`(user_id,movie_id,moviename,rating) VALUES($id,'".$movieId."','".$_POST['submit']."','".$rate."') ";
            if(!mysqli_query($link,$query)){
                $error.="Couldnot enter data<br>";
            }
            else{
                echo "<script> 
                    document.addEventListener('DOMContentLoaded', function(e){
                    e.preventDefault();
                    document.querySelector(`.rate-button-${movieId}`).classList.add('hidden');
                    document.querySelector(`.user-rating-${movieId}`).classList.add('hidden');
                    document.querySelector(`.after_rating_${movieId}`).classList.remove('hidden');
                    document.querySelector(`.after_rating_${movieId}`).value = '".$rate."';
                });</script>";

                for($j=1;$j<=10;$j++){
                    $query = "SELECT CAST(AVG(rating) AS DECIMAL (10,1)) FROM ratings WHERE movie_id = '".$j."' ";
                    if($result = mysqli_query($link,$query)){
                        $row = mysqli_fetch_array($result);
                        if($row[0] != ""){
                            echo "<script> 
                                document.addEventListener('DOMContentLoaded', function(e){
                                    e.preventDefault();
                                    document.querySelector(`.rating-${j}`).textContent = '⭐".$row[0]."';
                            });</script>";
            
            
            
                        }
                    }
                }
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
    <title>User Page</title>
    <link href="style/style1.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <script defer src = "script/script1.js"></script>
</head>

<body>
    <section class="header">
        <img class="icon-image" src="images/icon.png">
        <h1>AtoZ Movie Reviews</h1>
        <a class="menu-options" href="">Movies</a>
        <a class="menu-options" href="comingsoon.php">Tv-Series</a>
        <a class="menu-options" href="myreviews.php">My Reviews</a>
        <a class="menu-options" href = "logout.php"><span class ="logout-highlight">Logout</span></a>
    </section>
    <section class="welcome-text">
        <p class = "welcome"></p>
        <p>Top Recommended Movies for you!</p>
    </section>
    <section class ="error" >
            <p><?php echo $error; ?>
        </section>
        <section class ="success" >
            <p><?php echo $success; ?>
    </section>
    <div class="mid-container">
        
    </div>
</body>

</html>