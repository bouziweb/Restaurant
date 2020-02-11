<?php

  require  'database.php';
  if(!empty($_GET['id']))
  {
      $id=checkInput($_GET['id']);
  }
 if (!empty($_POST))
 {
     $id=checkInput($_POST['id']);
     $db=database::connect();
     $statement=$db->prepare("DELETE FROM items WHERE id=?");
     $statement->execute(array($id));
     database::disconnect();
     header("Location: index.php");
     
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
    <title>view page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Holtwood+One+SC" rel="stylesheet">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="../css/style.css">
      <link rel="shortcut icon" href="../images/b1.png">
</head>
<body>
   
    <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Burger Gaoubouzi <span class="glyphicon glyphicon-cutlery"></span></h1>
    
    
    <div class="container admin">
       
        <div class="row">
            <div>
                 <h1><strong>Supprimer un item</strong></h1>
                        <form class="form" role="form" action='delete.php' method="post" enctype="multipart/form-data">
                         <input type="hidden" name="id" value="<?php  echo $id;?>">
                         <p class="alert alert-warning">Etes vous sur de vouloir supprimer ?</p>
                         <div class="form-action">
                            <button type="submit" class="btn btn-warning">Oui</button>
                             <a href="index.php" class="btn btn-default">Non</a>
                         </div>
                      
                     </form>
                </div>
           
        
        </div>
        
    </div>
    
</body>
</html>
 