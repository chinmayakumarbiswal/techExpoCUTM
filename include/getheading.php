<?php
require('./database.php');

    $query="SELECT * FROM field GROUP BY heading";
    $run=mysqli_query($db,$query);
    $data=array();
    while($d=mysqli_fetch_assoc($run)){
        $data[]=$d['heading'];
    }
    $OUTPUT=(object) array('status' => true, 'data' => $data);
    echo json_encode($OUTPUT,true)
?>