<?php
require('./database.php');
    $OUTPUT=(object) array('status' => false, 'data' => '');

    if (!$_GET || !isset($_GET["heading"]) || !$_GET["heading"] ) {
        $OUTPUT=(object) array('status' => false, 'data' => 'Heading is Required');
    }
    else{
        $query="SELECT * FROM field where heading='{$_GET["heading"]}'";
        $run=mysqli_query($db,$query);
        $data=array();
        while($d=mysqli_fetch_assoc($run)){
            $data[]=$d['nameOfField'];
        }
        $OUTPUT=(object) array('status' => true, 'data' => $data);

    }
    
    echo json_encode($OUTPUT,true)
?>