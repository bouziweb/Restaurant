<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Burger Gaoubouzi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Holtwood+One+SC" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Pacifico" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bevan" rel="stylesheet">
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="css/main.css">
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
  
    </style>
</head>
<body>
    
    <div class="container-fluid">
            <div class="row post1">
            <div class="col-md-12 pic0">
                    <div class="">
                    <h2 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Burger Gaoubouzi <span class="glyphicon glyphicon-cutlery"></span></h2>
                    </div>
                </div>

                <a href="index.php"><div class="col-md-6 img pic1">
                    <div class="title">
                    <h3>View our menu</h3>
                    <h1>CUISINE</h1>
                    </div>
                </div></a>

                <div class="col-md-6 img pic2">
                    <div class="title">
                    <h3>Indian Cuisine</h3>
                    <h1>HOT BIRIYANI</h1>
                    </div>
                </div>
            </div>

            <div class="row post2">
                <a href="contact/index.html"><div class="col-md-4 img pic3">
                    <div class="title">
                    <h3>Italian Cuisine</h3>
                    <h1>CONTACT US</h1>
                    </div>
                </div></a>

                <div class="col-md-4 img pic4">
                <div class="title">
                    <h3>FIND US</h3>
                    <h1>SAUSAGES</h1>
                    </div>
                </div>
                <a href="admin/login.php"><div class="col-md-4 img pic5">
                    <div class="title">
                    <h3>American Cuisine</h3>
                    <h1>ADMIN</h1>
                    </div>
                </div></a>  
                
            </div>
            
            <footer class="footer"></footer>
    </div>

    <div class="loading"></div>
    
    
</body>
</html>
        <script type="text/javascript">
        $( document ).ready(function() { 
       
        // Add new page in my html
        $(".footer").load("footer/footer.html");
        $(".loading").load("loading/loading.html");
        
        

       //display with time 
        setTimeout(function() {
            $(".loading").css("display", "none");
          // $(".container-fluid").css("display", "block");
           $(".loading").html("display", "none");

         },3000);
        
            });

        </script>