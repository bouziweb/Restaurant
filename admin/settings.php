<?php 
   require'database.php';

   $loginError=$Password=$RPassword=$passwordError=$RRasswordError="";

   if(!empty($_POST))
       
   {
   $login     = checkInput($_POST['login']);
   $Password  = checkInput($_POST['Password']);
   $RPassword = checkInput($_POST['RPassword']);
   $valid=true;

   if (empty($login)) {
    $loginError="This field can not be empty !";
    $valid=false;
   }
   elseif (empty($Password) && !empty($RPassword))  {
    $passwordError="enter the password, please !";
    $valid=false;
   }
   elseif (!empty($Password) && empty($RPassword)){
    $RRasswordError="enter the R-Password, please";
    $valid=false;
   }
   elseif ($Password != $RPassword){
    $passwordError="error";
    $RRasswordError="error";
    $valid=false;
   }
   elseif (empty($Password) && empty($RPassword)){
    $valid=false;
    header("location:http://localhost/projet%20burger/admin/index.php");
   }
   elseif($valid==true){
 
       $db=database::connect();
       $statement=$db->prepare("update login SET Email=?, password =? , Rpassword =?");
                   $statement->execute(array($login,$Password,$RPassword));
       header("location:http://localhost/projet%20burger/admin/index.php");
       Database::disconnect();
   } 
   
  



   }
   else{
       
   $db=database::connect();
   $statement=$db->prepare("SELECT Email FROM login");
   $statement->execute(array());
   $item=$statement->fetch();
   $login=$item['Email'];
   Database::disconnect();
   }






  function checkInput($data)
  {
      $data=trim($data);
      $data=stripslashes($data);
      $data=htmlspecialchars($data);
      return $data;
  }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Holtwood+One+SC" rel="stylesheet">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="../css/style.css">
      <link rel="shortcut icon" href="../images/b1.png">
      <style>
        
      </style>
</head>
<body>
   
    <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Burger Gaoubouzi <span class="glyphicon glyphicon-cutlery"></span></h1>
    
    
    <div class="container admin">
       
        <div class="row">
             <h1><strong>Settings</strong></h1>
                     <br>
                     <form class="form col-md-6"  role="form" action="Settings.php" method="post" enctype="multipart/form-data">
                         <div class="form-group">
                             <label for="name">E-mail:</label>
                             <input type="text" class="form-control" id="login" name="login" placeholder="" value="<?php echo $login; ?>">
                             <span class="help-inline"><?php echo $loginError; ?></span>
                         </div>
                         <div class="form-group">
                             <label>New Password:</label>
                             <input type="password" class="form-control" id="Password" name="Password" placeholder="*******" value="<?php echo $Password; ?>">
                             <span class="help-inline"><?php echo $passwordError; ?></span>
                         </div>
                         <div class="form-group">
                             <label>R-Password:</label>
                             <input type="password"  class="form-control" id="RPassword" name="RPassword" placeholder="*******" value="<?php echo $RPassword; ?>">
                             <span class="help-inline"><?php echo $RRasswordError; ?></span>
                         </div>
                     
                     
                     <div class="form-action">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>Update</button>
                         <a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
                     </div>
                  </form>
           
            
        </div>
        
        
        
    </div>
    
</body>
</html>