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
    <form action="display_select.php" method="post">
       <h1>Select Display Option </h1>
        <input type="checkbox" name="flower"> Flower <br>
        <input type="checkbox" name="concentrates"> Concentrates <br> 
        <input type="submit" name-"submit" value="Submit" class="btn btn-primary">
    </form>
 </div>        
</div>
    
            
</body>
</html>
