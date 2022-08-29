<?php
/* initalise success and user for checking condition and putting a initial value */
$success=0;
$user=0;
if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'connection.php';    //connect with connection page
    $username=$_POST['username'];    //initalise username for post the data
     $password=$_POST['password'];    //initalise password for post the data
     $email=$_POST['email'];          //initalise email for post the data
   /* Selct query*/
    $sql="SELECT  * FROM `user` WHERE username='$username'";
    $result=mysqli_query($conn,$sql);
    if ($result) {
   $num=mysqli_num_rows($result);
    if($num>0){
        // echo "User already exist";
        $user=1;
    } else {
        /* Insert query*/
        $sql="INSERT INTO `user`( `username`, `password` ,`email`) VALUES ('$username','$password' ,'$email')";
        $result=mysqli_query($conn,$sql);
        if ($result) {
            // echo "SignUp successfully ";
            $success=1;
    }
    else{
        die(mysqli_error($conn));
    }
}
}
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>SignUp</title>
  </head>
  <body >
     <!-- Php Code-->
    <?php
    if($user){            
        echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> User ALready Exist.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    elseif($success){
        echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Registered Successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    
    
    
    ?>
    <h1 class="text-center mt-2">SignUp Page</h1>
    <div class="container mt-5">

    <form action="signup.php" method="post">
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" placeholder="Enter your username" name="username">
    </div>
    <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Email</label>   <!--email label-->
    <input type="email" class="form-control" placeholder="Enter your email" name="email" id="email">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" placeholder="Enter your password" name="password">
  </div>
 
<button type="submit" class="btn btn-primary">SignUp</button>
<div class="container "  style='display:inline !Important;'><a href="login.php" class="btn btn-primary">Login</a>
</form>
<!--Jquery CDN-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!--Javascript script-->
<script type="text/javascript">
    $(document).ready(function(){
        $("#signup").on('click',function(){   //on click event//
            var username=$("#username") .val(); //username event using jquery//
            var email=$("#email") .val();   //email event using jquery//
            var password=$("#password") .val();   //password event using jquery//
            /* condition for check input */
            if(username == "" || email == "" || password == ""){
                alert('please check your inputs');

            }
            else{
                /* ajax call */
                $.ajax(
                    {
                    url:'signup.php',  //url where we send data//
                    method:'POST',   //method used for post data//
                    data:{
                    id: 1,
                    username:username,
                    email:email,             //keys of data
                    password:password,
                },
                 success:function(response){
                    console.log(success);
                }
                });
            }
        
        });
    });
    </script>

    </div>

  </body>
</html>