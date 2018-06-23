<?php
session_start();
  
$qq = '1';
$q = '1';
 if(!$_SESSION['username']){
        
        header("location: index.php");
    }
$db = mysqli_connect("localhost:3306", "paranjoy_task3i", "?,a!rM?*jg~W", "paranjoy_task3");
$us = $_SESSION['username'];
$sql = "SELECT email FROM name WHERE username='$us'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$e = $row["email"];

$sql = "SELECT id FROM name WHERE username='$us'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$id = $row["id"];

if (isset($_POST['delete'])) {
    $qq = '2';
    $delid = $_POST['del_id'];
    $sql = "DELETE FROM note WHERE id='$delid'";
    mysqli_query($db, $sql);   
}
else if (isset($_POST['done'])) {
    $qq = '2';
    $n = $_POST['txt'];
    $d=strtotime("+330 Minutes");
    $sql = "INSERT INTO `note` (`id`, `uid`, `notes`, `timestamp`) VALUES (NULL, '$id', '$n', '$d')";
    mysqli_query($db, $sql);
}
else if (isset($_POST['done_edit'])) {
    $qq = '2';
    $y = $_POST['ed_id'];
    $n = $_POST['qwerty'];
    $d=strtotime("+330 Minutes");
    $sql = "UPDATE `note` SET `notes` = '$n', `timestamp` = '$d' WHERE `id` = '$y'";
    mysqli_query($db, $sql);
//    echo  mysqli_query($db, $sql);
}




else if (isset($_POST['submit2'])) {
    $q = '2';
    $n = $_POST['lists'];
    $sql2 = "INSERT INTO `list` (`id`, `uid`, `lists`, `checked`) VALUES (NULL, '$id', '$n', '1')";
    mysqli_query($db, $sql2);
}

else if (isset($_POST['close'])) {
    $q = '2';
    $nid = $_POST['close'];
    $sql2 = "DELETE FROM list WHERE id='$nid'";
    mysqli_query($db, $sql2);
}



$sql = "DELETE FROM note WHERE notes=''";
$result = mysqli_query($db, $sql);

$sql2 = "DELETE FROM list WHERE lists=''";
$result = mysqli_query($db, $sql2);

$sql = "SELECT * FROM note WHERE uid ='$id' ORDER BY timestamp DESC";
$result = mysqli_query($db, $sql);
$res =  mysqli_query($db, $sql);

$sql2 = "SELECT * FROM list WHERE uid ='$id' ORDER BY id DESC";
$result2 = mysqli_query($db, $sql2);
$res2 =  mysqli_query($db, $sql2);

?>
<!DOCTYPE html>
<html>
<head>

    <title>notes/reminder</title>
    <meta charset="utf-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    
</head>

<body>
    
    <input type="hidden" id="yes" style="display=none;" value="<?php echo $qq;echo $q; ?>">
    
    
    <div id="acc-info">
        <br>
       <center><span style="font-size: 1.45em; color:yellow;">You are logged in as:</span>
        <br><br><br><br><br>
        
           <span style="font-size: 1.6em; color:#FF6A1A;" >
           
            <?php
           
            echo strtoupper($_SESSION['username']);
            ?>
           
           </span>
          
           <br><br><br><br>
           <span style="font-size: 1.1em; color:#FF6A1A;" >
           
            <?php
           
            echo $e;
            ?>
           </span>
           <br>
        </center> 
        
 <a href="redirect.php"><button id="acc-logout" >&nbsp;&nbsp; LOGOUT &nbsp;&nbsp;</button></a>
    </div>           
    
<div id="choice">
 <button id="notes" class="choice" onclick='document.getElementById("show-notes").style.display="block"; document.getElementById("show-todo").style.display="none";' > NOTES </button>   
 <button id="todo" class="choice" onclick='document.getElementById("show-todo").style.display="block"; document.getElementById("show-notes").style.display="none";'> TO-DO/REMINDER</button>
</div>    
    
   
    

        
        <div id="show-notes" >   
    
        <div >
    
    
          <div id="done_ed" style="display:none;">
            <center>    
             <form method="post" action="<?php  echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" > 
            
              <textarea id="txtt" rows="10" name="qwerty"></textarea> <br><br>
              <input type="hidden" style="display:none;" id="ed_id" name='ed_id' value="">
                 
              <input type="submit" name="done_edit" value=" Done " id="done__ed" style="background-color:green; color: white; font-size: 1.3em; margin: 4px; border: 2px solid black; padding: 5px;">
              
                
             </form>
          <button id='cancel_ed' style="background-color:orangered; color: white; font-size: 1.3em; margin: 4px; border: 2px solid black; padding: 5px; display:none;" > Cancel </button>   
              </center>
           </div> 
    
    
    
    
    
   <center> 
    <button id="addnotes" > Add notes </button>   
        <div>
         <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
         <div id="notepad" style="display:none;"> <textarea id="txt" rows="10" name="txt"></textarea> <br><br> </div>
         <input type="submit" name="done" value=" Done " id="done" style="background-color:green; color: white; font-size: 1.3em; margin: 4px; border: 2px solid black; padding: 5px; display:none;">
         </form>

       <button id='cancel' style="background-color:orangered; color: white; font-size: 1.3em; margin: 4px; border: 2px solid black; padding: 5px; display:none;"> Cancel </button>    
        </div>
    </center>   
       <div id="notes_" > 
       
       <?php
       if(mysqli_num_rows($result)>0){ ?>
        <?php   while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){ 
               
               $note = $row['notes'];
               $note_id = $row['id'];
               $t = $row['timestamp'];
               $t = date("F d, Y   h: i: s A", $t);   
                                       ?>
               <div id="qwerty">
               <div class="n" id='<?php echo $note_id."a"   ?>' > 
                    
                   
                     <div class="ipn" id='<?php echo $note_id   ?>'> <?php  echo $note;  ?>  </div>   
                   
                   <center>  
                       <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                           <button class="de" name='delete'> delete </button>
                           <input type="hidden" style="display:none;" name='del_id' value="<?php echo $note_id;  ?>">
                       </form>
                       
                       <button class="ed" 
                        onclick='document.getElementById("done_ed").style.display="block"; document.getElementById("txtt").value="<?php echo $note;  ?>";
                        document.getElementById("ed_id").value="<?php echo $note_id;  ?>";          
                        document.getElementById("addnotes").style.display="none";
                        document.getElementById("notes_").style.display="none"; document.getElementById("cancel_ed").style.display="block";' > view/edit </button>       
                  
                   </center>
                   <br> 
                    <div class="time1"> 
                        <?php    echo $t;   ?>
                   </div>
                   
                   
               </div>
                   </div> 
<!--                    </div>-->
           
          
           
           
            <?php   } ?>
           
      <?php   }  ?>     
  
         </div>    
     </div>
             
    </div>              
         
    
        
<div id="show-todo" >
    
     <div >
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">     
               <input type="text" id="myInput" name="lists" placeholder="Add REMINDERS...">
               <button  class="addBtn" name="submit2"> Add </button>
               <br>
    <br>
    <br>
    <hr>
        </form>
 
    
    <?php
       if(mysqli_num_rows($result2)>0){ ?>
    
       <ul id="myUL">
    
        <?php   while($row2 = mysqli_fetch_array($result2, MYSQL_ASSOC)){ 
               
               $list = $row2['lists'];
               $list_id = $row2['id'];
               $c = $row2['checked'];
                //if($c == 1){}      ?>
           <li ><?php echo $list;  ?> 
               <form class="close" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                   <center><button class="close" name="close" value="<?php echo $list_id;  ?> " > &times; </button>  </center>
               </form>
           </li>
           
    <?php  } ?>
           
       </ul>
           
               <?php                       }   ?>       
    
    
</div>
      
    
    </div>  
    
    
    
    
    <script>
        var x=1;
        var s="";
        var w= document.getElementById("yes").value;
        console.log(w);
        if(w == 21){
        document.getElementById("show-todo").style.display="none";
        document.getElementById("show-notes").style.display="block"; 
        }
        if(w == 12){
        document.getElementById("show-todo").style.display="block";
        document.getElementById("show-notes").style.display="none" ;
        }
        
        document.getElementById("done").addEventListener("click", function(){change();});
        document.getElementById("addnotes").addEventListener("click", function(){change();});
        document.getElementById("cancel").addEventListener("click", function(){cancel();});
        document.getElementById("cancel_ed").addEventListener("click", function(){canceled();});
        
    function change(){
         if(x == 1){
        document.getElementById("txt").value="";     
        document.getElementById("addnotes").style.display="none"; 
        document.getElementById("done").style.display="block";
        document.getElementById("cancel").style.display="block";     
        document.getElementById("notepad").style.display="block";
        document.getElementById("notes_").style.display="none";     
          x=x*(-1);
         }
         else if(x == -1){
        s = document.getElementById("txt").value;      
        document.getElementById("done").style.display="none"; 
        document.getElementById("cancel").style.display="none";      
        document.getElementById("addnotes").style.display="block";      
        document.getElementById("notepad").style.display="none";
        document.getElementById("notes_").style.display="block";
             console.log(s); 
          x=x*(-1);
         }
        
    }
    
   function cancel(){ 
        document.getElementById("done").style.display="none"; 
        document.getElementById("cancel").style.display="none";      
        document.getElementById("addnotes").style.display="block";      
        document.getElementById("notepad").style.display="none";
        document.getElementById("notes_").style.display="block";
        x=x*(-1);
   }
        
    function canceled(){ 
        document.getElementById("cancel_ed").style.display="none";
        document.getElementById("done_ed").style.display="none";
        document.getElementById("addnotes").style.display="block";      
        document.getElementById("notes_").style.display="block";
   }    
        
        
// Add a "checked" symbol when clicking on a list item
//        var list = document.querySelector('ul');
//        list.addEventListener('click', function(ev) {
//        if (ev.target.tagName === 'LI') {
//            ev.target.classList.toggle('checked');
//            }
//        }, false);
//        
        
    </script>
</body>

</html>