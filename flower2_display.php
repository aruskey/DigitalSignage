<?php include "functions.php"; ?>
<?php
if(!isset($_SESSION)){
   session_start();
}

if(isset($_POST['submit'])){
    $_SESSION = $_POST;
}

if(isset($_SESSION)){
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
    background-image:url('bg2.jpg');
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
    .shattergrid{
        display: grid;
        grid-template-columns: 25vw 25vw;
        grid-column-gap: 5vw;
    }
    .shatterelement{
        grid-column-start: 1;
        grid-column-end: 2;
    }
    .budderelement{
        grid-column-start: 2;
        grid-column-end: 3;
    }
    .otherconc{
        grid-column-start:3;
        grid-column-end: 4;
    }
    .hashelement{
        grid-column: 3 / 4;

    }
    .gridtop{
        grid-row:2 / 15;
    }
    
</style>
       <meta http-equiv="refresh" content = "900" /> 
    <title>Document</title>
</head>
<body>



</body>
</html>
