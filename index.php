<?php session_start();  
  require_once("configs/db_config.php");
  $base_url="cpanel";
  //require_once("library/classes/system_log.class.php");
  
  if(isset($_POST["btnSignIn"])){
    
     $username=trim($_POST["txtUsername"]);
     $password=trim($_POST["txtPassword"]);
     //echo $username," ",$password;
     $result=$db->query("select u.id,u.username,r.name from {$tx}users u,{$tx}roles r where r.id=u.role_id and u.username='$username' and u.password='$password'");

     if($db->affected_rows==1){
         
         list($uid,$_username,$role)=$result->fetch_row();
         $_SESSION["uid"]=$uid;
         $_SESSION["uname"]=$_username;
         $_SESSION["urole"]=$role;

        //  $now=date("Y-m-d H:i:s");
        //  $log=new System_log("","LOGIN","Successfully logged in user : $uid-$_username",$now);
        //  $log->save();

         header("location:home");
        

     }else{
      
        $error="Password or Username incorrect";
       
     }  
  
    }

?>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login Page with Background Image Example</title>
  <link rel="stylesheet" href="style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div id="bg"></div>
<div style="text-align:center;color:orange;font-weight:bold"> <?php echo isset($error)?$error:"";?></div>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
  <div class="form-field">
    <input type="text"  name="txtUsername" id="txtUsername" placeholder="Username" required/>
  </div>
  
  <div class="form-field">
    <input type="password" name="txtPassword" id="txtPassword" placeholder="Password" required/>                         
  </div>
  
  <div class="form-field">
    <button class="btn" type="submit" name="btnSignIn" >Sign In</button>
  </div>
</form>
<!-- partial -->
  
</body>
</html>

<script>
$(function () {

rememberStatus();

$('#txtUsername').on("input",function(){
  remember();
});

$('#txtPassword').on("input",function(){
  remember();
});

$('#chkRemember').click(function () {
  remember();
});

function remember(){
  if ($('#chkRemember').is(':checked')) {
        // save username and password
        localStorage.username = $('#txtUsername').val().trim();
        localStorage.pass = $('#txtPassword').val().trim();
        localStorage.chkbox = $('#chkRemember').val();
    } else {
        localStorage.username = '';
        localStorage.pass = '';
        localStorage.chkbox = '';
    }
}

function rememberStatus(){
    if (localStorage.chkbox && localStorage.chkbox != '') {
      $('#chkRemember').attr('checked', 'checked');
      $('#txtUsername').val(localStorage.username);
      $('#txtPassword').val(localStorage.pass);
    }else {
      $('#chkRemember').removeAttr('checked');
      $('#txtUsername').val('');
      $('#txtPassword').val('');
   }
}

});
  </script>