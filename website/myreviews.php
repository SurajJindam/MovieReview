<?php
session_start();
if(!isset($_SESSION['id'])){
    header("Location:index.php");
}
$link = mysqli_connect("localhost","root","","reviews");
	
    if(mysqli_connect_error())
    {
    echo "Database not connected";
    }

$id = $_SESSION['id'];
$array = [];
$query = "SELECT COUNT(user_id) FROM ratings WHERE user_id = $id" ;
$result = mysqli_query($link,$query);
$rows = mysqli_fetch_array($result);
for ($x = 1; $x <= 10; $x++) {

    $query = "SELECT `moviename`,`rating` FROM ratings WHERE user_id = $id AND movie_id = $x";
    if($result = mysqli_query($link,$query)){
        $row = mysqli_fetch_assoc($result);
        array_push($array,$row);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style/style2.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <title>Transactions</title>
</head>

<body>
    <main>
    <section class="header">
        <img class="icon-image" src="images/icon.png">
        <h1>AtoZ Movie Reviews</h1>
        <a class="menu-options homepage" href="loggedinpage.php">HomePage 🔙</a>
    </section>
        <div class="heading">
            <h2>My Rated Movies</h2>
        </div>
        <div class="table">
            <table>
                <tr>
                    <th>Movie Name</th>
                    <th>Rating</th>
                </tr>
            </table>
        </div>
        


    </main>
    <script>
        var js_array = <?php echo json_encode($array); ?>;
        for(let i=0;i<js_array.length;i++){
            if(js_array[i]['moviename'] == null){
                continue;
            }
            let s =`<tr>
            <td> ${js_array[i]['moviename']}</td>
            <td> ${js_array[i]['rating']}</td>
            </tr>`;
            document.querySelector('table').insertAdjacentHTML('beforeend',s);
        }
        
    </script>
</body>

</html>