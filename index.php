<?php 
    $rows=array();  
    $con=mysqli_connect('127.0.0.1','root','','gestion_pays') or die(mysqli_error($con));
    $query="SELECT * from contient ";
    $result=mysqli_query($con, $query) or die(mysqli_error($con));
    $rows_c=mysqli_fetch_all($result,MYSQLI_ASSOC);

    if(isset($_POST['idc'])){

        $idc=$_POST['idc'];
        $query="SELECT pays.*, contient.nomc 
        from pays, contient
        where pays.idc=contient.idc
        and pays.idc='$idc'
        ";
        $result=mysqli_query($con, $query) or die(mysqli_error($con));
        $rows=mysqli_fetch_all($result,MYSQLI_ASSOC);
    
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
         .content{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            justify-content: space-evenly;
        }

        .article-img{
            width: 200px;
            height: 300px;
        }
        .article-img img{
            width:100%
            
        }
        
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="bg-danger alert text-light display-4">Liste Des Pays</h1>
        <a href="ajouter.php">Add Pays</a>
        <form action="" method="post" enctype="multipart/form-data">
            
            <select name="idc"  class="form-control" onchange="return submit()">
                <option value="-1">Select Contient</option>
                <?php foreach($rows_c as $row){  ?>
                    <option value="<?= $row['idc'] ?>"><?= $row['nomc'] ?></option>
                <?php } ?>
            </select><br><br>
           <br>
             <div class="content">
           <?php foreach($rows as $row){ ?>
               
                <div class="article text-center">
                <div class="article-title">
                    <h2><?= $row['nomp']  ?></h2>
                </div>
                <div class="article-img">
                <img src="<?= $row['flag'] ?>" alt="img">
                </div>
            </div>     
              
            <?php } ?> 
         </div>
        </form>

    </div>
</body>
</html>