<?php

session_start();

if (!isset($_SESSION['connect'])) {
    header('location:http://localhost:88888/projet%20burger/admin/login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin page</title>
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
          <div class="col-sm-8">
           <h1><strong>Liste des items </strong><a class="btn btn-success btn-lg" href="insert.php"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h1>
           </div>
           <div class="col-sm-4">
           <a class="btn btn-dark btn-lg" href="settings.php"><span class="glyphicon glyphicon-cog"></span> Settings</a>
           <a class="btn btn-warning btn-lg" href="logout.php"><span class="glyphicon glyphicon-log-out"></span> LogOut</a>
           </div>
        </div>
           
           <table class="table table-striped table-bordered">
                   <thead>
                       <tr>
                           <th>Nom</th>
                           <th>Description</th>
                           <th>Prix</th>
                           <th>Categorie</th>
                           <th>Actions</th>
                       </tr>
                   </thead>
                           <tbody>
                            
                             <?php 

                                 require 'database.php';
                                 $db=database::connect();
                                 $statement=$db->query('SELECT items.id,items.name,items.description,items.price,categories.name AS category
                                 FROM items LEFT JOIN categories ON items.category=categories.id ORDER BY items.id DESC');
                                   while ( $item=$statement->fetch())
                                   {
                                       echo'<tr>';
                                             echo'<td>'.$item['name'].'</td>';
                                             echo'<td>'.$item['description'].'</td>';
                                             echo'<td>'.number_format((float)$item['price'],2,'.','').'</td>';
                                             echo'<td>'.$item['category'].'</td>';
                                             echo'<td width=300>';
                                             echo' <a href="view.php?id='.$item['id'].'" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>';
                                             echo ' ';
                                             echo '<a href="update.php?id='.$item['id'].'" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                                             echo ' ';
                                             echo ' <a href="delete.php?id='.$item['id'].'" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
                                             echo'</td>';
                                       echo'</tr>';
                                   }
                                Database::disconnect();

                             ?>
                            



                           </tbody>
                 </table>
                 
            
        </div>
         
        
        
        
    </div>
    
</body>
</html>