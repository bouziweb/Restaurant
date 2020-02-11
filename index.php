<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>projet burger</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <link href="https://fonts.googleapis.com/css?family=Holtwood+One+SC" rel="stylesheet">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <script src="js/codejquery.js"></script>
   
    <link rel="shortcut icon" href="images/b1.png">
    <style>
        .loading {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        background-color:#fdcd77;
    }
    .menu{display:block}

  
    </style>
</head>
<body>

<div class="menu"></div>
  <div class="container site">
  
     <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Burger Gaoubouzi<span class="glyphicon glyphicon-cutlery"></span></h1>
     
     
    
     <?php
      require 'admin/database.php';
      echo '<nav>
             <ul class="nav nav-pills">';
                
      $db=database::connect();
      $statement=$db->query('SELECT * FROM categories');
      $categories = $statement->fetchAll();
      foreach($categories as $category)
      {
          if($category['id']=='1')
              echo '<li role="presentation" class="active"><a href="#'.$category['id'].'" data-toggle="tab">'.$category['name'].'</a></li>';
          else
              echo'<li role="presentation" ><a href="#'.$category['id'].'" data-toggle="tab">'.$category['name'].'</a></li>';
              
      }
      
      echo  '</ul>
           </nav>';
      echo '<div class="tab-content">';
        
        foreach($categories as $category)
      {
          if($category['id']=='1')
              echo '<div class="tab-pane active" id="'.$category['id'].'">';
          else
              echo '<div class="tab-pane " id="'.$category['id'].'">';
            
          echo'<div class="row">';
          
            
            $statement=$db->prepare('SELECT * FROM items WHERE items.category=?');
            $statement->execute(array($category['id']));
            
              while($item=$statement->fetch())
                 {
                     echo'  <div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <img src="images/'.$item['image'].'" alt="...">
                                    <div class="price">'.number_format($item['price'],2,'.','').' $</div>
                                    <div class="caption">
                                        <h4>'.$item['name'].'</h4>
                                        <p>'.$item['description'].'</p>
                                        <a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-cutlery"></span> Commander</a>
                                    </div>
                                </div>
                            </div> ';

                }
            
                    

             echo' </div>
       
             </div>';
   
      }
       
      database::disconnect();
      echo'</div>';
      ?>
     
      
   </div>
   <div class="loading"></div>
    </body>  

    </html>

    <script type="text/javascript">
        $( document ).ready(function() { 
       
        // Add new page in my html
        $(".menu").load("menu/menu.html");
       
        $(".loading").load("loading/loading.html");
        
        
        

       //display with time 
        setTimeout(function() {
            $(".loading").css("display", "none");
          // $(".container-fluid").css("display", "block");
           $(".loading").html("display", "none");
           
        
          
           


         },2000);
        
            });

        </script>
   
