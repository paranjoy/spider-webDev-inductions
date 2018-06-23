<?php 
   
     
    $password = $username = $email = $error = "";

    // connect to database

	$db = mysqli_connect("localhost:3306", "paranjoy_task3i", "?,a!rM?*jg~W", "paranjoy_task3");
	
       if (isset($_POST['submit'])) {

        
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
           
           
           $sql = "SELECT username FROM name WHERE username='$username'";
           $result = mysqli_query($db, $sql);
        

        
		if ($password == $password2 && mysqli_num_rows($result)==0) {
//            $password = md5($password);//hash password before storing for security purposes
           $sql = "INSERT INTO `name` (`id`, `username`, `email`, `password`) VALUES (NULL, '$username', '$email', '$password')";
			mysqli_query($db, $sql);
			
			header("location: index.php"); 
		}
           else if(mysqli_num_rows($result)>0){
               $error = "Username already exist";   
           }
           else{
			$error = "The two passwords do not match";
		}
	}
?>






<html>
<head>
<title>SIGNUP</title>
<meta charset="utf-8">  
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="style.css" rel="stylesheet">
</head>
<body>
    <span style="font-size: 1.1em;">
<center>
    Your Notes/Reminders with you wherever you go
    <br>
    Easy to use, protect all your stuffs!
<hr style="width: 200px;">
</center> 
    </span>

    <div id="signup">
<center>
      
     <p>  </p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  
  <label style="color:yellow; font-size=1.3em;">Username</label><span class="error">* <?php echo $nameErr;?></span>
    <br>
  <input type="text" name="username" value="<?php echo $username; ?>" size="40px;" required>
  
  <br><br><br>
  <label style="color:yellow; font-size=1.3em;">Email</label><span class="error">* <?php echo $emailErr;?></span>
    <br>
  <input type="email" name="email" value="<?php echo $email; ?>" size="40px;" required>
  
  <br><br><br>
  <label style="color:yellow; font-size=1.3em;">Password</label><span class="error">*</span>
    <br>
  <input type="password" name="password" size="40px;" required>
  
  <br><br><br>
  <label style="color:yellow; font-size=1.3em;">Confirm password</label><span class="error">* </span>
    <br>
  <input type="password" name="password2" size="40px;" required>
  
  <br>
  <span class="error"><?php  echo $error;  ?></span>  
  <br><br>
  <input type="submit" name="submit" value="Submit" style="background-color: rgba(0,0,255,0.3); color: yellow; font-size:1.1em; border: 0;">  
</form> 
    <span class="error">* <b>required field</b></span>
    <br>
    <p>
        Already a member? <a href="index.php" style="color:yellow;"><b>Sign in</b></a>
  	</p>
        
</center>
            
    </div>
    
</body>





</html>

