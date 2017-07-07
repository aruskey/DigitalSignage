<?php
function connect_db(){
$connection = mysqli_connect('107.180.47.5', 'ar_brainy', 'Grumpo12', 'i2974612_wp1');
if($connection){
    return $connection;
} else {
    die ("Database connection failed");
}
}
    
function populate_display($disptype){
    
}

function select_from_category($category){
    $connection = connect_db();
    $query = "SELECT ID, post_parent FROM wp_post WHERE post_type = 'product'"; 
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result)){
        if($row['post_parent']==0){
            
        }
    }

}

?>