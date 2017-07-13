<!-- 
Test background image(no longer useful if main = good)
background-image:url("https://thegreenhart.com/wp-content/uploads/2016/06/about-image-9.jpg");
-->


<?php include "functions.php"; ?>
<?php



if(isset($_POST['concentrates'])){
 select_from_category("Concentrate");
} else if(isset($_POST['flower_IS'])){
 select_from_category("flower_IS");
} else {
  select_from_category("flower_HPC");
}

//select_from_category("flower");
//populate_display();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<style>
   body{
    background-image:url('background2.jpg');
    background-repeat: no-repeat;
    background-size:cover;
    height:100vh;
    margin: 0px;
    }
    .testgrid{
        display: grid;
        grid-template-columns:20vw 3vw 3vw 3vw 3vw 3vw;
        grid-column-gap: 1vw;
    }
    .prerollgrid{
        display: grid;
        grid-template-columns: 20vw 3vw 3vw;
        grid-column-gap: 1vw;
    }
</style>
    <title>Document</title>
</head>
<body>



</body>
</html>
