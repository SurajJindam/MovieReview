<?php

$link = mysqli_connect("localhost","root","","reviews");
	
    if(mysqli_connect_error())
    {
    echo "Database not connected";
    }
$array = [];
$query = "SELECT MAX(movie_id) FROM ratings" ;
$result = mysqli_query($link,$query);
$rows = mysqli_fetch_array($result);
for ($x = 1; $x <= $rows[0]; $x++) {

    $query = "SELECT `moviename`,CAST(AVG(rating) AS DECIMAL (10,1)) FROM ratings WHERE movie_id = $x";
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
    <title>Top Rated Movies</title>
</head>

<body>
    <main>
    <section class="header">
        <img class="icon-image" src="images/icon.png">
        <h1>AtoZ Movie Reviews</h1>
        <a class="menu-options" href="index.php">Home</a>
        <a class="menu-options" href="">Top Rated Movies</a>
        <a class="menu-options" href="comingsoon.php">Top Rated Tv-Series</a>
    </section>
        <div class="heading">
            <h2>Top Rated Movies</h2>
        </div>
        <div class="table">
            <table>
                <tr>
                    <th>Movie Name</th>
                    <th>Average Rating</th>
                </tr>
            </table>
        </div>
        


    </main>
    <script>
        var js_array = <?php echo json_encode($array); ?>;
        for(let j=0;j<js_array.length;j++){
            for(let k=0;k<js_array.length;k++){
                if(js_array[j]['CAST(AVG(rating) AS DECIMAL (10,1))'] > js_array[k]['CAST(AVG(rating) AS DECIMAL (10,1))']){
                    let temp = js_array[j];
                    js_array[j] = js_array[k];
                    js_array[k] = temp;
                }
            }
        }
        for(let i=0;i<js_array.length;i++){
            if(js_array[i]['moviename'] == null){
                continue;
            }
            let s =`<tr>
            <td> ${js_array[i]['moviename']}</td>
            <td> ${js_array[i]['CAST(AVG(rating) AS DECIMAL (10,1))']}</td>
            </tr>`;
            document.querySelector('table').insertAdjacentHTML('beforeend',s);
        }
        
    </script>
</body>

</html>