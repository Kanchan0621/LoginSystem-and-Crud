
<?php

session_start();
if(!isset($_SESSION['username'])){          // session start is used to start the code only if we get value as username
    header('location:login.php');          //redirect to login page
}

 include('php_code.php'); 
         

    /* update logic*/
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM detail WHERE id=$id");

		if (isset($record) ) {
			$n = mysqli_fetch_array($record);
			$name = $n['name'];
			$address = $n['address'];
            $email = $n['email'];
            $phone = $n['phone'];
            $salary = $n['salary'];
			$filename = $n['image'];
		}
	}
?>





<!doctype html>
<html lang="en">
  <head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
	 <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --> 
   <title>Welcome Page</title>
  </head>
  <body >
    <h1 class="text-warning mt-5 ">Welcome
        <?php echo $_SESSION['username'];?>
    </h1>
    
    <form method="post" action="php_code.php" enctype="multipart/form-data"> 
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <input type="hidden" name="name" value="<?php echo $name; ?>">
          <input type="hidden" name="address" value="<?php echo $address; ?>">
          <input type="hidden" name="phone" value="<?php echo $phone; ?>">
          <input type="hidden" name="salary" value="<?php echo $salary; ?>">
          <input type="hidden" name="email" value="<?php echo $email; ?>">
          <div class="input-group">
            <label>Name</label>
            <input type="text" name="name" value="">
          </div>
          <div class="input-group">
            <label>Phone</label>
            <input type="tel" name="phone" value="">
          </div>
          <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="">
           </div>
           <div class="input-group">
             <label>Salary</label>
             <input type="number" name="salary" value="">
            </div>
            <div class="input-group">
              <label>Address</label>
              <input type="text" name="address" value="">
            </div>
            <div class="input-group">
              <label>Image</label>
              <input type="file" name="file" value="file">
              
            </div>
            <div class="input-group">
              <!-- <button class="btn" type="submit" name="save" >Save</button> -->
              <div class="container "  style='display:inline !Important; '><a href="logout.php" class="btn btn-primary">Logout</a></div>
   
              <?php if ($update == true): ?>
	           <button class="btn" type="submit" name="update" style="background: #556B2F;" >Update</button>
            <?php else: ?>
	          <button class="btn" type="submit" name="save" >Save</button>
          <?php endif ?>
           <?php if ($delete == true): ?>
	      <button class="btn" type="submit" name="del" style="background: #556B2F;" >Delete</button>
                                                                          
       <?php endif ?>
		   </div>
		
 
       <?php $results = mysqli_query($db, "SELECT * FROM detail"); ?>  

          <table>
            <thead>
              <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Salary</th>
                <th>Email</th>
                <th>Image</th>
                <th colspan="2">Action</th>
              </tr>
            </thead>
            <?php while ($row = mysqli_fetch_array($results)) { ?>
		
		<tr>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['address']; ?></td>
            <td><?php echo $row['phone']; ?></td>
			<td><?php echo $row['salary']; ?></td>
            <td><?php echo $row['email']; ?></td>
			<td><img src="<?php echo $row['image']; ?>"height="100px" width="100px" ></td>
			<td>
				<a href="welcome.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="welcome.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
		
	<?php } ?>
</table>
	</form>
            
          </body>
          </html>