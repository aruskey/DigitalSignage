<?php include "functions.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<style>
   body{
    background-image:url("https://thegreenhart.com/wp-content/uploads/2016/06/about-image-9.jpg");
    background-repeat: no-repeat;
    background-size:cover;
    height:100vh;
    }
    .maincontainer{
        position:absolute;
        top:0;
        bottom:0;
        left:0;
        right:0;
        margin:auto;
        height:200px;
        width: 500px;
    }
</style>
    <title>Document</title>
</head>
<body>

<div class="container-fluid maincontainer">
 <div class="card card-block">
    <form action="concentrate_display.php" method="post">
       <h1>Select Display Option </h1>
        <input style='padding-right:5px' type="submit" name="submit" value="Concentrates" class="btn btn-primary">
    </form>
    <form action="flower1_display.php" method="post">
        <input style='padding-right:5px' type="submit" name="submit" value="Flower1" class="btn btn-primary">
    </form>
    <form action="flower2_display.php" method="post">
        <input type="submit" name="submit" value="Flower2" class="btn btn-primary">
    </form>
 </div>        
</div>
    
            
</body>
</html>
