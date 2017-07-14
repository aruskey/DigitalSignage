<!-- v1.  implement class architecture for v2, make it work first -->
<!-- size guide ya filthy animals: 1: 'gram' 2: '1/8' 3: '1/4' 4: '1/2' 5: 'OZ' -->

<?php
ini_set('MAX_EXECUTION_TIME', -1);
//function connect_db(){
$connection = mysqli_connect('107.180.47.5', 'ar_brainy', 'Grumpo12', 'i2974612_wp1'); //for remote use 107.180.47.5
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
    if($category=="flower_IS"){
        display_flowers();
    } else if($category == "Concentrate"){
        $taxonomy_id = 26;
        display_concentrate();
    } else if($category=="flower_HPC"){        
        display_hybrid();
    }
    
}



function display_concentrate(){
echo "<div class='shattergrid' style='color:white;font-weight:bold'>
<div> 0.5g = $20.00  1g = $40.00 </div>
<div> 0.5g = $20.00  1g = $40.00 </div>";
    display_shatter(31);
    display_budder(72);
    display_hash(29);
echo "</div>";    
}

function display_shatter($taxonomy_id){
 global $connection;
 $query = 
     "
     SELECT DISTINCT wp_posts.ID, wp_posts.post_title, tr1.term_taxonomy_id
     FROM wp_posts
     INNER JOIN wp_term_relationships tr1
     ON wp_posts.ID = tr1.object_id
     INNER JOIN wp_postmeta
     ON wp_posts.ID = wp_postmeta.post_id
     WHERE tr1.term_taxonomy_id = '$taxonomy_id'
     AND wp_postmeta.meta_value = 'instock'
    ";
    $result = mysqli_query($connection, $query);
    echo "<div class='gridtop'>";
    while($row = mysqli_fetch_assoc($result)){
        if($row[''])
        echo "<div class='shatterelement'>" . $row['post_title'] . "</div>"; 
    } 
    echo "</div>";
}

function display_budder($taxonomy_id){
 global $connection;
 $query = 
     "
     SELECT wp_posts.ID, wp_posts.post_title, wp_term_relationships.term_taxonomy_id
     FROM wp_posts
     INNER JOIN wp_term_relationships
     ON wp_posts.ID = wp_term_relationships.object_id
     INNER JOIN wp_postmeta
     ON wp_posts.ID = wp_postmeta.post_id
     WHERE wp_term_relationships.term_taxonomy_id = '$taxonomy_id'
     AND wp_postmeta.meta_value = 'instock'
    ";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result)){
        echo "<div class='budderelement'>" . $row['post_title'] . "</div>"; 
    } 
}
function display_hash($taxonomy_id){
global $connection;
 $query = 
     "
     SELECT wp_posts.ID, wp_posts.post_title, wp_term_relationships.term_taxonomy_id
     FROM wp_posts
     INNER JOIN wp_term_relationships
     ON wp_posts.ID = wp_term_relationships.object_id
     INNER JOIN wp_postmeta
     ON wp_posts.ID = wp_postmeta.post_id
     WHERE wp_term_relationships.term_taxonomy_id = '$taxonomy_id'
     AND wp_postmeta.meta_value = 'instock'
    ";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result)){
        echo "<div class='hashelement'>" . $row['post_title'] . "</div>"; 
    } 
}


//---------------------------------------------


//display Hybrid
function display_hybrid(){
    //holy crap this is ugly, deadlines vs a good job
    //Create Hybrid Entries
    global $connection;
     $query = 
        "SELECT wp_posts.ID, wp_posts.post_title 
        FROM wp_posts 
        INNER JOIN wp_term_relationships 
        ON wp_posts.ID = wp_term_relationships.object_id
        INNER JOIN wp_postmeta
        ON wp_posts.ID = wp_postmeta.post_id
        WHERE wp_posts.post_type = 'product'
        AND wp_postmeta.meta_value = 'instock'
        AND wp_posts.post_parent = 0 
        AND wp_posts.ID NOT IN (2737, 2734, 2730)
        AND wp_term_relationships.term_taxonomy_id = '13'
        ORDER BY wp_posts.post_title ASC"; 

    $result = mysqli_query($connection, $query);
    if(!$result){
        die('Query Failed' . mysqli_error());
    }
    echo "
     <div style='color:white;padding:10px;font-weight:bold'>
      <div style='float:left;width:45vw'>
            <div style='text-decoration:underline'><h2>Hybrid</h2></div> 
        <div class='testgrid'>";

    print_pricing_header();
        while($row = mysqli_fetch_assoc($result)){
         echo "<div>" . $row['post_title'] . "</div>";
         get_child_price($row['ID']); 
        }
      echo "</div>";
      

//create CBD     
 $query = 
        "SELECT wp_posts.ID, wp_posts.post_title 
        FROM wp_posts 
        INNER JOIN wp_term_relationships 
        ON wp_posts.ID = wp_term_relationships.object_id
        INNER JOIN wp_postmeta
        ON wp_posts.ID = wp_postmeta.post_id
        WHERE wp_posts.post_type = 'product'
        AND wp_postmeta.meta_value = 'instock'
        AND wp_posts.post_parent = 0 
        AND wp_posts.ID NOT IN ('3248','3230','3229','2830')
        AND wp_term_relationships.term_taxonomy_id = '81'
        ORDER BY wp_posts.post_title ASC"; 

    $result = mysqli_query($connection, $query);
    if(!$result){
        die('Query Failed' . mysqli_error());
    }
    echo "
        <div style='text-decoration:underline;padding-top:50px'><h2>CBD Strains</h2></div>
        <div class='testgrid'>";
        //print_pricing_header();
        while($row = mysqli_fetch_assoc($result)){
         echo "<div>" . $row['post_title'] . "</div>";
         get_child_price($row['ID']); 
        }
      echo "</div></div></div>";
      
//create pre-rolls      
    $query =
        "SELECT wp_posts.post_title
        FROM wp_posts
        INNER JOIN wp_postmeta
        ON wp_posts.ID = wp_postmeta.post_id
        WHERE wp_postmeta.meta_value = 'instock'
        AND wp_posts.ID IN (2737, 2734, 2730)
        ORDER BY wp_posts.post_title ASC";
    $result = mysqli_query($connection, $query);
    
    echo "<div style='color:white;font-weight:bold'>
          <div class='prerollgrid'>
            <div style='text-decoration:underline'><h1>Pre-Roll</h1></div>
            <div style='position:relative'><span style='text-decoration:underline;right:0;position:absolute;bottom:0'>Single</span></div>
            <div style='position:relative'><span style='text-decoration:underline;right:0;position:absolute;bottom:0'>5 PK</span></div>";
    //display the pre rolls from stock
    while($row = mysqli_fetch_assoc($result)){
        echo "<div style='text-align:left'>" . $row['post_title'] . "</div>";
        echo "<div style='text-align:right'> 5 </div>";
        echo "<div style='text-align:right'> 20 </div>";
    }
    //display the custom pre-rolls(silver, gold, plat etc)
    echo "
    <div style='padding-top:100px;text-align:left'> Pre-Roll, Bronze </div>
    <div style='padding-top:100px;text-align:right'> 5.00 </div>
    <div style='text-align:right'>  </div>
    <div style='text-align:left'> Pre-Roll, Silver </div>
    <div style='text-align:right'> 5.50 </div>
    <div style='text-align:right'>  </div>
    <div style='text-align:left'> Pre-Roll, Gold </div>
    <div style='text-align:right'> 5.99 </div>
    <div style='text-align:right'>  </div>
    <div style='text-align:left'> Pre-Roll, Platinum </div>
    <div style='text-align:right'> 6.99 </div>
    <div style='text-align:right'>  </div>";
  echo "</div></div>";


}


//---------- all for flower below this point
function display_flowers(){                         //display Sativa+India ... see display_flowers2() for pre-roll, hybrid, and cbd
     global $connection;// = connect_db();
    
    //--------------indica's + title
    $query = 
        "SELECT wp_posts.ID, wp_posts.post_title 
        FROM wp_posts 
        INNER JOIN wp_term_relationships 
        ON wp_posts.ID = wp_term_relationships.object_id
        INNER JOIN wp_postmeta
        ON wp_posts.ID = wp_postmeta.post_id
        WHERE wp_posts.post_type = 'product'
        AND wp_postmeta.meta_value = 'instock'
        AND wp_posts.post_parent = 0 
        AND wp_posts.ID NOT IN (2737, 2734, 2730)
        AND wp_term_relationships.term_taxonomy_id = '12'
        ORDER BY wp_posts.post_title ASC"; 

    $result = mysqli_query($connection, $query);
    if(!$result){
        die('Query Failed' . mysqli_error());
    }
    echo "
     <div style='color:white;font-weight:bold;padding:10px'>
      <div style='float:left;width:45vw'>
            <div style='margin-left:0px;text-decoration:underline'><h2>Indica</h2></div>
            <div class='testgrid'>";
            print_pricing_header();
        while($row = mysqli_fetch_assoc($result)){
         echo "<div>" . $row['post_title'] . "</div>";
         get_child_price($row['ID']); 
        }
      echo "</div></div>";
    //-------------------------Sativas
    $query = 
        "SELECT wp_posts.ID, wp_posts.post_title 
        FROM wp_posts 
        INNER JOIN wp_term_relationships 
        ON wp_posts.ID = wp_term_relationships.object_id
        INNER JOIN wp_postmeta
        ON wp_posts.ID = wp_postmeta.post_id
        WHERE wp_posts.post_type = 'product'
        AND wp_postmeta.meta_value = 'instock'
        AND wp_posts.post_parent = 0 
        AND wp_posts.ID NOT IN (2737, 2734, 2730)
        AND wp_term_relationships.term_taxonomy_id = '14'
        ORDER BY wp_posts.post_title ASC"; 

    $result = mysqli_query($connection, $query);
    if(!$result){
        die('Query Failed' . mysqli_error());
    }
    echo "<div style='float:right;width:45vw'>
            <div style='text-decoration:underline'><h2>Sativa</h2></div>
            <div class='testgrid'>"; 
                print_pricing_header();
                while($row = mysqli_fetch_assoc($result)){
                echo "<div>" . $row['post_title'] . "</div>";
                get_child_price($row['ID']); 
                }
    echo "</div></div></div>";
    
}


function get_child_price($id){
    global $connection;
    $quantities = array("1"=>"0", "1/8"=>"1","1/4"=>"2","1/2"=>"3","OZ"=>"4","1-2"=>"0", "18-2"=>"1","14-2"=>"2","12-2"=>"3","oz-2"=>"4",
    "gram"=>"0","18"=>"1","14"=>"2","12"=>"3", "1-gram"=>"0", "oz"=>"4");
    $sizes = array("1", "1/8", "1/4", "1/2", "OZ");    
    $sort = array(0,0,0,0,0);
    $query = 
        "SELECT meta_value, post_id
        FROM wp_postmeta
        INNER JOIN wp_posts
        ON wp_posts.ID = wp_postmeta.post_id
        WHERE wp_posts.post_parent = '$id'
        AND (wp_postmeta.meta_key = 'attribute_grams' OR wp_postmeta.meta_key='attribute_pa_grams')
        AND wp_postmeta.meta_value NOT IN ('half-gram', '2-2', '0-5', '0-5-gram')";
    $result = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($result)){
            $sort[$quantities[$row['meta_value']]] = get_price($row['post_id']);
        }
        foreach($sort as $val){
            echo "<div style='text-align:right'>". $val ."</div>";
    }
}

function get_price($id){
    global $connection;
    $query = 
        "SELECT meta_value
        FROM wp_postmeta
        WHERE meta_key='_price'
        AND post_id='$id'";
    $result=mysqli_query($connection, $query);
    $row=mysqli_fetch_assoc($result);
    return $row['meta_value'];
}
//function to display strain gram 1/8 1/4 1/2 oz above price info
function print_pricing_header(){
        $sizes = array("Gram", "1/8", "1/4", "1/2", "OZ");    
    echo "
        <div style='text-decoration:underline'>Strain</div>";
    foreach($sizes as $val){
        echo "<div style='text-decoration:underline;text-align:right'>". $val ."</div>";
    }
}
?>
