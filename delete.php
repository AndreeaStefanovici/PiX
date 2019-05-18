<?php 
 include('server.php');
  if(isset($_SESSION['username']))
  {if($_GET){
    if(isset($_GET['Delete'])){
        delete();
    }
}

    function delete()
    {
    	$delete =("DELETE FROM images WHERE id = '$id'");
        $result = mysqli_query($db, $delete) or die(mysqli_error());
        
	echo "Photo deleted";
   
   
 
    }
  }
?>