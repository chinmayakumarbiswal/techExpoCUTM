<?php
require('./database.php');

    $query="SELECT * FROM school GROUP BY school";
    $run=mysqli_query($db,$query);
    $data=array();
    while($d=mysqli_fetch_assoc($run)){
        $data[]=$d['school'];
    }
    $OUTPUT=(object) array('status' => true, 'data' => $data);
    echo json_encode($OUTPUT,true)
?>