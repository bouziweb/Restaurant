<?php

  require  'database.php';
  $name=$description=$price=$category=$image=$nameError=$descriptionError=$priceError=$categoryError=$imageError="";
  

   if(!empty($_POST))
   {
       $name           = checkInput($_POST['name']);
       $description    = checkInput($_POST['description']);
       $price          = checkInput($_POST['price']);
       $category       = checkInput($_POST['category']);
       $image          = checkInput($_FILES['image']['name']);
       $imagePath      ='../images/'.basename($image);
       $imageExtension =pathinfo($imagePath, PATHINFO_EXTENSION);
       $isSuccess      =true;
       $isUpLoadSuccess=false;
   
   
   if(empty($name))
   {
       $nameError='ce champ ne peut pas etre vide';
       $isSuccess=false;
   }

   if(empty($description))
   {
       $descriptionError='ce champ ne peut pas etre vide';
       $isSuccess=false;
   }
   
   if(empty($price))
   {
       $priceError='ce champ ne peut pas etre vide';
       $isSuccess=false;
   }
  
   if(empty($category))
   {
       $categoryError='ce champ ne peut pas etre vide';
       $isSuccess=false;
   }

   if(empty($image))
   {
       $imageError='ce champ ne peut pas etre vide';
       $isSuccess=false;
   }
   else
   {
       $isUpLoadSuccess=true;
       if($imageExtension !="jpg" && $imageExtension !="png" && $imageExtension !="jpeg" && $imageExtension !="gif"  )
       {
           $imageError="les fichiers autorises sont .jpg, .jpeg, .png, .gif";
           $isUploadSucces=false;
       }
       if(file_exists($imagePath))
       {
           $imageError="le fichier existe deja";
           $isUploadSucces=false;
       }
       if($_FILES["image"]["size"]>500000)
       {
           $imageError="le fichier ne diot pas depasser les 500KB";
           $isUploadSucces=false;
       }
       if($isUpLoadSuccess)
       {
           if(!move_uploaded_file($_FILES["image"]["tmp_name"],$imagePath))
           {
                $imageError="il y a eu une erreur lors de l'upload";
                $isUploadSucces=false;
           }
       }
   }

   if($isSuccess && $isUpLoadSuccess)
   {
       $db=database::connect();
       $statement=$db->prepare("INSERT INTO items (name,description,price,category,image) values(?,?,?,?,?)");
       $statement->execute(array($name,$description,$price,$category,$image));
       database::disconnect();
       header("Location: index.php");
       
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
             <h1><strong>Ajouter un item</strong></h1>
                     <br>
                     <form class="form" role="form" action="insert.php" method="post" enctype="multipart/form-data">
                         <div class="form-group">
                             <label for="name">Nom:</label>
                             <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name; ?> ">
                             <span class="help-inline"><?php echo $nameError; ?></span>
                         </div>
                         <div class="form-group">
                             <label for="Description">Description:</label>
                             <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description; ?> ">
                             <span class="help-inline"><?php echo $descriptionError; ?></span>
                         </div>
                         <div class="form-group">
                             <label for="price">Prix:(en $)</label>
                             <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Prix" value="<?php echo $price; ?> ">
                             <span class="help-inline"><?php echo $priceError; ?></span>
                         </div>
                         <div class="form-group">
                             <label for="category">categorie:</label>
                             <select class="form-control" name="category" id="category">
                                <?php
                                 $db= Database::connect();
                                 foreach($db->query('SELECT * FROM categories') as $row)
                                 {
                                     echo '<option value ="' .$row['id']. '">' .$row['name']. '</option>';
                                 }
                                 
                                  Database::disconnect();
                                 
                                 ?>
                                 
                             </select>
                             <span class="help-inline"><?php echo $categoryError; ?></span>
                         </div>
                         <div class="form-group">
                             <label for="image">Selection une image:</label>
                             <input type='file' id="image" name="image">
                             <span class="help-inline"><?php echo $imageError; ?></span>
                         </div>
                     
                     
                     <div class="form-action">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>Ajouter</button>
                         <a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                     </div>
                  </form>
           
            
        </div>
        
        
        
    </div>
    
</body>
</html>
 