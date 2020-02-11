<?php 
   session_start();
   $Email=$password=$errorEmail=$errorPassword=null;
   $AdminEmail="admin";
   $AdminPassword="admin";
   $isSuccess=true;
   $valid=1;
   
  
 
     if(!empty($_POST))
     {
         $Email=checkInput(($_POST['Email']));
         $password=checkInput(($_POST['password']));
         
        
         if(empty($email) && empty($password)) 
         {
              header("Location:http://localhost/projet%20burger/admin/login.php?validEmpty=1");
              $isSuccess=false;
     
          }
          elseif(empty($Email))
            {
                header("Location:http://localhost/projet%20burger/admin/login.php?error=1&email=1");
                $isSuccess=false;
                
            }
            elseif(empty($password))
            {
                header("Location:http://localhost/projet%20burger/admin/login.php?error=1&password=1");
                $isSuccess=false;
                
            }
            elseif($Email !=$AdminEmail && !empty($Email) )
                {
                    header("Location:http://localhost/projet%20burger/admin/login.php?error=1&ErrorEmail=1");
                    $isSuccess=false;
                }
            elseif($password !=$AdminPassword && !empty($password))
                {
                    header("Location:http://localhost/projet%20burger/admin/login.php?error=1&ErrorPassword=1");
                    $isSuccess=false;
                }
                elseif($isSuccess)
            
                {
                    $_SESSION['connect']=1;
                    $valid=0;
                    header("Refresh:0.1; url=index.php?success=1");
                    
                    
                    
                    
                    
                
                }  
                
                
               
        
         
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
    <title>Login</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
     <link href="https://fonts.googleapis.com/css?family=Holtwood+One+SC" rel="stylesheet">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="../css/styleLogin.css">
    <script src="js/script.js"></script>
    <link rel="shortcut icon" href="../images/b1.png">
    <style>
        .loading {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        background-color:white;
    }
  
    </style>
</head>
<body>
   
   <div class="container-fluid">
      <div class="row">
       
           <div class="hidden-xs hidden-sm  col-md-8 picture" >
               
           </div>
           <div class="col-xs-12 col-sm-12 col-md-4 loginForm">
            <br><br>
             <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Burger Gaoubouzi <span class="glyphicon glyphicon-cutlery"></span></h1>
              <br><br>
              
               <form class="form" role="form" action="login.php" method="post" enctype="multipart/form-data">

                  <?php
                              if(isset($_SESSION['connect'])) 
                              {
                              echo'<div class="alert alert-success">
                                  <strong>Success!</strong> Indicates a successful or positive action.
                                  </div>';
                                  
                                  
                                 
                              }

                                elseif (isset($_GET['error']) ) {

                                    
                                    if (isset($_GET['email'])) {
                                            echo'<div class="alert alert-danger">
                                                <strong>Error!</strong> Enter your email Please.
                                                </div>';
                                        }

                                        elseif (isset($_GET['password'])) {
                                            echo'<div class="alert alert-danger">
                                                <strong>Error!</strong> Enter your Password Please.
                                                </div>';
                                        }

                                        elseif (isset($_GET['ErrorEmail'])) {
                                        echo'<div class="alert alert-danger">
                                            <strong>Error!</strong> Your incorrect Email!.
                                            </div>';
                                        }

                                        elseif (isset($_GET['ErrorPassword'])) {
                                        echo'<div class="alert alert-danger">
                                            <strong>Error!</strong> Your incorrect password!.
                                            </div>';
                                        }
                                        
                                }
                                elseif (isset($_GET['validEmpty'])) 
                                {
                                   echo'<div class="alert alert-danger">
                                     <strong>Error!</strong> Enter your email & Password Please.
                                     </div>';
                                }

                               
                                

                    ?>
                         <div class="form-group">
                             <label for="name">Email:</label>
                             <input type="text" class="form-control" autofocus id="Email" name="Email" placeholder="E-mail" checked value="<?php echo $Email; ?>">
                             <span class="help-inline"><?php echo $errorEmail; ?></span>
                         </div>
                         <div class="form-group">
                             <label for="Description">Password:</label>
                             <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo $password; ?>">
                             <span class="help-inline"><?php echo $errorPassword; ?></span>
                         </div>
                        
                       
                     <div class="form-action">
                        <button type="submit" class="btn btn-lg btn-primary">Login</button>
                     </div>
                  </form>
           
               
           </div>
       </div>
  </div>
  <div class="loading"></div>
</body>
</html>
<script type="text/javascript">
        $( document ).ready(function() { 
       
        // Add new page in my html
       
        $(".loading").load("../loading/loading.html");
        
        

       //display with time 
        setTimeout(function() {
            $(".loading").css("display", "none");
          // $(".container-fluid").css("display", "block");
           $(".loading").html("display", "none");

         },2000);
        
            });

        </script>