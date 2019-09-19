<?php
    $con = mysqli_connect("localhost","root","","voting");
    $obj=json_decode($_POST['obj'],true);
     $id = $obj['btn_id'];
    print_r($id);
    
    if(isset($_POST["obj"])){
        $update = "UPDATE votes SET vote_count = vote_count + 1 WHERE id = '$id'";
        $up_query= mysqli_query($con,$update);
        // if($up_query){
        //     echo "<h4>+1</h4>";
        // }else{
        //     echo mysqli_error($up_query);
        // }
    }else{
        echo "not"; 
    }
?>
