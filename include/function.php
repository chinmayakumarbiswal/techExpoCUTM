<?php
    function getAllDetaild($db,$email){
        $query="SELECT * FROM registerdata WHERE email='$email' ORDER BY id DESC";
        $run=mysqli_query($db,$query);
        $data=array();
        while($d=mysqli_fetch_assoc($run)){
            $data[]=$d;
        }
        return $data;
    }

    function getUserDetails($db,$email){
        $query="SELECT * FROM studentdata WHERE email='$email'";
        $run=mysqli_query($db,$query);
        $data=mysqli_fetch_assoc($run);
        return $data;
    }

    function getAllDetailsByAdmin($db){
        $query="SELECT * FROM registerdata ORDER BY id DESC";
        $run=mysqli_query($db,$query);
        $data=array();
        while($d=mysqli_fetch_assoc($run)){
            $data[]=$d;
        }
        return $data;
    }

    function getAllDetailsByAdminCampus($db,$campus){
        $query="SELECT * FROM registerdata WHERE campus='$campus' ORDER BY id DESC";
        $run=mysqli_query($db,$query);
        $data=array();
        while($d=mysqli_fetch_assoc($run)){
            $data[]=$d;
        }
        return $data;
    }

    function getAllDetailsByAdminTech($db,$getExpertIn){
        $query="SELECT * FROM registerdata WHERE expertIn='$getExpertIn' ORDER BY id DESC";
        $run=mysqli_query($db,$query);
        $data=array();
        while($d=mysqli_fetch_assoc($run)){
            $data[]=$d;
        }
        return $data;
    }

    function getAllDetailsByAdminWithFilter($db,$expertIn,$tech,$campus,$school,$dept){
        $query="SELECT * FROM registerdata WHERE expertIn='$expertIn' AND tech='$tech' AND campus='$campus' AND school='$school' AND dept='$dept' ORDER BY id DESC";
        $run=mysqli_query($db,$query);
        $data=array();
        while($d=mysqli_fetch_assoc($run)){
            $data[]=$d;
        }
        return $data;
    }

    function getAllRegisterStudentByAdmin($db){
        $query="SELECT * FROM registerdata GROUP BY email;";
        $data=mysqli_query($db, $query);
        $total=mysqli_num_rows($data);
        return $total;
    }

    function getAllStudentByAdmin($db){
        $query="SELECT * FROM studentdata GROUP BY email;";
        $data=mysqli_query($db, $query);
        $total=mysqli_num_rows($data);
        return $total;
    }

    function getAllRegisterStudentByAdminCampusWise($db,$campus){
        $query="SELECT * FROM registerdata WHERE campus='$campus' GROUP BY email;";
        $data=mysqli_query($db, $query);
        $total=mysqli_num_rows($data);
        return $total;
    }

    function getAllAdminDetailsByAdmin($db){
        $query="SELECT * FROM admindata ORDER BY id DESC";
        $run=mysqli_query($db,$query);
        $data=array();
        while($d=mysqli_fetch_assoc($run)){
            $data[]=$d;
        }
        return $data;
    }

    function getAllTechByAdmin($db){
        $query="SELECT * FROM field ORDER BY id DESC";
        $run=mysqli_query($db,$query);
        $data=array();
        while($d=mysqli_fetch_assoc($run)){
            $data[]=$d;
        }
        return $data;
    }

    function getAllSchoolByAdmin($db){
        $query="SELECT * FROM school GROUP BY school";
        $run=mysqli_query($db,$query);
        $data=array();
        while($d=mysqli_fetch_assoc($run)){
            $data[]=$d;
        }
        return $data;
    }

    function getAllSchoolByAdminForList($db){
        $query="SELECT * FROM school ORDER BY id DESC";
        $run=mysqli_query($db,$query);
        $data=array();
        while($d=mysqli_fetch_assoc($run)){
            $data[]=$d;
        }
        return $data;
    }

    function getAllStudentByAdminForList($db){
        $query="SELECT * FROM studentdata ORDER BY id DESC";
        $run=mysqli_query($db,$query);
        $data=array();
        while($d=mysqli_fetch_assoc($run)){
            $data[]=$d;
        }
        return $data;
    }

    function getAllRegisterStudentByAdminExpertIn($db,$expertIn){
        $query="SELECT * FROM registerdata WHERE expertIn='$expertIn'";
        $data=mysqli_query($db, $query);
        $total=mysqli_num_rows($data);
        return $total;
    }

    function getAlldataForGrapthBarByAdmin($db,$expertIn){
        $query="SELECT COUNT(tech) as totalTech, tech FROM registerdata WHERE expertIn='$expertIn' GROUP BY tech";
        $run=mysqli_query($db,$query);
        $data=array();
        while($d=mysqli_fetch_assoc($run)){
            $data[]=$d;
        }
        return $data;
    }
    
?>