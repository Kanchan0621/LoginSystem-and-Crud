<?php
/* initalise login and invlaid for checking condition and putting a initial value */
$login=0;
$invalid=0;
 

if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'connection.php';
    $username=$_POST['username'];     //initalise username for post the data
    $password=$_POST['password'];    //initalise password for post the data
    $email=$_POST['email'];          //initalise email for post the data
    
    /* Select Query to fetch the data*/
    $sql="SELECT * FROM `user` WHERE username='$username' and password='$password' and email='$email'";
    $result=mysqli_query($conn,$sql);
    if ($result) {
   $num=mysqli_num_rows($result);
    if($num>0){
        // echo "Login Successfully";
        $login = 1;
        /* If alreay login*/
        session_start();      
        $_SESSION['username']=$username;
        header('location:welcome.php');   // used to redirect on welcome page
    } else {
    //   echo "Invalid Data";
    $invalid=1;
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

    <title>Login</title>  
  </head>
  <body style="background:#CCCCFF">        <!--body of page-->
  
  <!-- PHP Code for login data validation-->
  <?php
    if($login){
        echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Login Successfully
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    elseif($invalid){
        echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Invalid!</strong> Invalid Data.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    
    ?>

   <h1 class="text-center mt-2">Login Page</h1>   <!--heading for page-->
    <div class="container mt-5">

    <form action="login.php" method="post">
  <div class="mb-3">
    <label for="name" class="form-label">Username</label>  <!--username label-->
    <input type="text" class="form-control" placeholder="Enter your username" name="username" id="username">
   </div>
   <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Email</label>   <!--email label-->
    <input type="email" class="form-control" placeholder="Enter your email" name="email" id="email">
  </div>
  <div class="mb-3"> 
    <label for="exampleInputPassword1" class="form-label">Password</label>   <!--password label-->
    <input type="password" class="form-control" placeholder="Enter your password" name="password" id="password">
  </div>
 
<button type="submit" class="btn btn-primary" id="login" value="login">Login</button>  <!--submit button-->
</form>
<!--Jquery CDN-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!--Javascript script-->
<script type="text/javascript">
    $(document).ready(function(){
        $("#login").on('click',function(){   //on click event//
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
                    url:'login.php',  //url where we send data//
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