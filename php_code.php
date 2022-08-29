

<?php 
	/*database connection*/
	$db = mysqli_connect('localhost', 'root', '', 'ajax');

	/* initialize variables */
	$name = "";     //initalise $name for name
	$address = "";  //initalise $address for address
    $phone ="";    //initalise $phone for phone
    $email="";     //initalise $email for email
    $salary="";    //initalise $salary for salary
	$id = 0;         //initalise $id for id with initial value zero 
	$update = false;    //for update 
    $delete = false;     //delete

	if (isset($_POST['save'])) {
        $files=$_FILES['file'];
       $filename=$files['name'];
       $filetmp=$files['tmp_name'];
       $fileext=explode('.',$filename);
       $filecheck=strtolower(end($fileext));
       $fileextstored=array('png','jpg','jpeg','webp');
       if(in_array($filecheck,$fileextstored)){
        $destinationfile='image/'.$filename;
        move_uploaded_file($filetmp, $destinationfile);
		$name = $_POST['name'];
		$address = $_POST['address'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $salary = $_POST['salary'];
        
		mysqli_query($db, "INSERT INTO `detail`( `name`, `address`, `email`, `phone`, `salary`,`image`) VALUES ('$name','$address','$email','$phone','$salary','$destinationfile')"); 
	
		header('location: welcome.php');
	}
    
}
         /* Post value for update the data*/

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POSt['email'];
        $phone = $_POST['phone'];
        $salary = $_POST['salary'];
        $filename= $_POST['image'];

      /* Update Quer*/
        mysqli_query($db, "UPDATE `detail` SET `id`='$id',`name`='$name',`address`='$address',`email`='$email',`phone`='$phone',`salary`='$salary',`image`='$filename'  WHERE id=$id"); 
        header('location: welcome.php');
    }

    /* Getting Data for delete*/
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        
        
        /* Delete query*/
        mysqli_query($db, "DELETE FROM detail WHERE id=$id");
       
        header('location: welcome.php');
    }
   

    ?>