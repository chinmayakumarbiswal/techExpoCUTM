<?php
require('../include/database.php');
require('../include/function.php');
if(isset($_POST['importExcel'])){
	$file=$_FILES['excelData']['tmp_name'];
	// echo "<PRE>";
    // echo $file;
	$ext=pathinfo($_FILES['excelData']['name'],PATHINFO_EXTENSION);
	if($ext=='xlsx'){
		require('./PHPExcel/PHPExcel.php');
		require('./PHPExcel/PHPExcel/IOFactory.php');
		
		
		$obj=PHPExcel_IOFactory::load($file);
		foreach($obj->getWorksheetIterator() as $sheet){
			$getHighestRow=$sheet->getHighestRow();
			for($i=2;$i<=$getHighestRow;$i++){
				$school=$sheet->getCellByColumnAndRow(0,$i)->getValue();
				$dept=$sheet->getCellByColumnAndRow(1,$i)->getValue();
				if($school!=''){
					$query="INSERT INTO school(school,dept) VALUES('$school','$dept')";
                    $run=mysqli_query($db,$query) or die(mysqli_error($db));
                   
                    
				}
                $totalIs=$totalIs+$run;
			}
		}
        echo "<script>alert('Total data inserted is ".$totalIs."');</script>";
	}else{
		echo "<script>alert('Invalid format');</script>";
	}
}
?>


<form method="post" action="" enctype="multipart/form-data">
    
            <input type="file" class="form-control" name="excelData" required="required"></div>
        
            <button class="btn btn-success" type="submit" name="importExcel">Import Excel</button>
        
    </form>