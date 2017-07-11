<!-- v1.  implement class architecture for v2, make it work first -->
<!-- size guide ya filthy animals: 1: 'gram' 2: '1/8' 3: '1/4' 4: '1/2' 5: 'OZ' -->

<?php

//function connect_db(){
$connection = mysqli_connect('107.180.47.5', 'ar_brainy', 'Grumpo12', 'i2974612_wp1');
if($connection){
    return $connection;
} else {
    die ("Database connection failed");
}

    
function populate_display(){
   global $connection;// = connect_db();
    //$query = "SELECT * FROM wp_post WHERE ID = '798'"; 
   $query = "SELECT id FROM wp_posts WHERE post_type = 'product'";
    $result = mysqli_query($connection, $query);
    if(!$result){
            die('Query Failed' . mysqli_error());
    }
    while($row = mysqli_fetch_assoc($result)){
         echo $row['id'];
         echo "<br>";
     }
}

function select_from_category($category){
    if($category="Flower"){
        $taxonomy_id = 12;
    } else if($category = "Concentrate"){
        $taxonomy_id = 11;
    }
    global $connection;// = connect_db();
    $query = 
        "SELECT wp_posts.ID, wp_posts.post_title, wp_term_relationships.term_taxonomy_id 
        FROM wp_posts 
        INNER JOIN wp_term_relationships 
        ON wp_posts.ID = wp_term_relationships.object_id
        WHERE wp_posts.post_type = 'product'
        AND wp_posts.post_parent = 0 
        AND wp_term_relationships.term_taxonomy_id = '$taxonomy_id'"; 

    $result = mysqli_query($connection, $query);
    if(!$result){
        die('Query Failed' . mysqli_error());
    }
    echo "<div class='container' style='color:white'>
    <div class='row'><h1> $category </h1></div>";
    while($row = mysqli_fetch_assoc($result)){
        echo "<div class='row'>
                <div class='col-md-2'>" . $row['post_title'] . "</div>
                <div class='col-xs-1' style='margin-left:10px'>" . get_child_price(1,$row['ID']) . "</div>
                <div class='col-xs-1' style='margin-left:10px'>" . get_child_price(2,$row['ID']) . "</div>
                <div class='col-xs-1' style='margin-left:10px'>" . get_child_price(3,$row['ID']) . "</div>
                <div class='col-xs-1' style='margin-left:10px'>" . get_child_price(4,$row['ID']) . "</div>
                <div class='col-xs-1' style='margin-left:10px'>" . get_child_price(5,$row['ID']) . "</div></div>";
                
            //$row['post_title']  get_child_price(1, $row['ID']) . "<br>";
    }
    echo "</div>";
    
}


function get_child_price($size, $id){
    global $connection;
    $quantities = array("1"=>"1", "2"=>"1/8","3"=>"1/4","4"=>"1/2","5"=>"OZ");
    $hold = $quantities[$size];
    $query = 
        "SELECT meta_value, post_id
        FROM wp_postmeta
        INNER JOIN wp_posts
        ON wp_posts.ID = wp_postmeta.post_id
        WHERE wp_posts.post_parent = '$id'
        AND wp_postmeta.meta_key = 'attribute_grams'";
    $result = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($result)){
        if($row['meta_value'] == $hold){
            $rowid = $row['post_id'];
            $query = 
                "SELECT meta_value
                FROM wp_postmeta
                WHERE post_id = '$rowid'
                AND meta_key = '_price'";
            $output = mysqli_query($connection, $query);
            $out = mysqli_fetch_assoc($output);
            return $out['meta_value'];
        }
    }
}




?>
