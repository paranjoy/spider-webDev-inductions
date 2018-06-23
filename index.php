<?php 	
     session_start();

    if($_SESSION['username']){
        
        header("location: firstpage.php");
    }
  
    $password = $username = $err ="";
    $db = mysqli_connect("localhost:3306", "paranjoy_task3i", "?,a!rM?*jg~W", "paranjoy_task3");
    

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
           
        $_SESSION['message'] = "You are now logged in";
        $_SESSION['username'] = $username;
        
        $username = mysqli_real_escape_string($db, $username);
        $password = mysqli_real_escape_string($db, $password);
        
        $sql = "SELECT * FROM name WHERE username='$username' AND password='$password'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_num_rows($result);
        
    if($row<=0)
        {
            $err = "Incorrect username/password combination";
        }
        else{
           header("location: firstpage.php");
        }
    
    
    }




?>

<html>
<head>
<title>LOGIN</title>
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
<form method="post" action="">  
        <br><br>
        
  		<label style="color:yellow; font-size:1.3em;">Username</label><span class="error"><b>*</b></span>
        <br>
  		<input type="text" name="username" size="40px;" value="" style="background-color:white;" required>
        <br><br><br>
  		<label style="color:yellow; font-size:1.3em;">Password</label><span class="error"><b>*</b></span>
        <br> 
  		<input type="password" name="password" size="40px;" style="background-color:white;" required>
        <br>
        <span class="error"><?php  echo $err;  ?></span>
        <br><br>
    
        <input type="submit" name="submit" value="Login" style="background-color: rgba(0,0,255,0.3); color: yellow; font-size:1.1em; border: 0;">
    
<!--  		<button type="submit" class="btn" name="login_user" style="background-color: rgba(0,0,255,0.3); color: yellow; font-size:1.1em; border: 0;"> Login </button>-->
        <br> <br>
        <span class="error">* <b>required field </b></span>
        <br><br> <br><br><br> 
  	
        Not yet a member? <a href="signup.php" style="color:yellow; font-size:1.2em;"><b>Sign up</b></a>

  
  
</form> 
</center>
            
    </div>
    
</body>

</html>

