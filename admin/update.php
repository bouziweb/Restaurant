<?php

  require  'database.php';

  if(!empty($_GET['id']))
  {
      $id=checkInput($_GET['id']);
  }
  $nameError=$descriptionError=$priceError=$categoryError=$imageError="";
  

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
               $isImageUpdated=false;
           }
           else 
           {
               $isImageUpdated=true;
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

           if(($isSuccess && $isUpLoadSuccess && $isImageUpdated) || ($isSuccess && !$isImageUpdated) )
           {
               $db=database::connect();
               if($isImageUpdated)
               {
                   $statement=$db->prepare("update items SET name =? , description =?, price=?, category=?, image=? WHERE id=?");
                   $statement->execute(array($name,$description,$price,$category,$image,$id));
               }
               else
               {
                   $statement=$db->prepare("update items SET name =? , description =?, price=?, category=? WHERE id=?");
                   $statement->execute(array($name,$description,$price,$category,$id));
               }
               Database::disconnect();
               header("Location: index.php");

           }
       
               else if(!$isImageUpdated && !$isUpLoadSuccess)
               {
                     
                    $db=database::connect();
                     $statement=$db->prepare("SELECT image FROM items where id = ?");
                     $statement->execute(array($id));
                     $item=$statement->fetch();
                     $image= $item['image'];
                     database::disconnect();


               }

 }

 else
 {
     
     $db=database::connect();
     
     $statement=$db->prepare("SELECT * FROM items WHERE id =? ");
     $statement->execute(array($id));
     $item=$statement->fetch();
     $name         = $item['name'];
     $description  = $item['description'];
     $price        = $item['price'];
     $category     = $item['category'];
     $image        = $item['image'];
     
     database::disconnect();
     
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
    <title>update</title>
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
            <div class="col-sm-6">
                 <h1><strong>Modifier un item</strong></h1>
                         <br>
                         <form class="form" role="form" action="<?php echo 'update.php?id='.$id; ?>" method="post" enctype="multipart/form-data">
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
                                 <input type="text" step="0.01" class="form-control" id="price" name="price" placeholder="Prix" value="<?php echo $price; ?> ">
                                 <span class="help-inline"><?php echo $priceError; ?></span>
                             </div>
                             <div class="form-group">
                                 <label for="category">categorie:</label>
                                 <select class="form-control" name="category" id="category">
                                    <?php
                                     $db= Database::connect();
                                     foreach($db->query('SELECT * FROM categories') as $row)
                                     {
                                         if($row['id']==$category)
                                         
                                             echo '<option selected="selected" value ="' .$row['id']. '">' .$row['name']. '</option>';
                                         else
                                             echo '<option  value ="' .$row['id']. '">' .$row['name']. '</option>';
                                         
                                         
                                     }

                                      Database::disconnect();

                                     ?>

                                 </select>
                                 <span class="help-inline"><?php echo $categoryError; ?></span>
                             </div>
                             <div class="form-group">
                                <label>image :</label>
                                <p><?php echo $image;?></p>
                                 <label for="image">Selection une image:</label>
                                 <input type='file' id="image" name="image">
                                 <span class="help-inline"><?php echo $imageError; ?></span>
                             </div>


                         <div class="form-action">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>Modifier</button>
                             <a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                         </div>
                      </form>


            </div>
            <div class="col-sm-6 site">
                 <div class="thumbnail">
                    <img src="<?php  echo  '../images/' . $image; ?>" alt="...">
                    <div class="price"><?php echo  number_format((float)$price,2,'.','') .' ';?>$</div>
                    <div class="caption">
                       <h4><?php echo ' '.$name; ?></h4>
                       <p><?php echo ' '.$description; ?></p>
                       <a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-cutlery"></span> Commander</a>
                    </div>
                 </div>
              </div>
        
        </div>
        
    </div>
    
</body>
</html>
 