<?php 
    $con=mysqli_connect('127.0.0.1','root','','gestion_pays') or die(mysqli_error($con));
    $query="SELECT * from contient ";
    $result=mysqli_query($con, $query) or die(mysqli_error($con));
    $rows=mysqli_fetch_all($result,MYSQLI_ASSOC);

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
        .btnn{
            display:flex;
            justify-content:center;
        }
        button,a{
            margin:10px;
        }
        .hh{
            color:red;
        }
        .hhh{
            width:300px;
            position: relative;
            left:600px;
        }
    </style>
</head>
<body>
    <div class="container mt-5 w-50">
        <h1 class="bg-danger alert text-light display-4 text-center">Ajouter Un Pays</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="nomp" class="form-control" placeholder="Nom Du Pays"><br>
            <input type="file" name="flag" id="" class="form-control"><br>
            <select name="idc"  class="form-control">
                <option value="-1">Select Contient</option>
                <?php foreach($rows as $row){  ?>
                    <option value="<?= $row['idc'] ?>"><?= $row['nomc'] ?></option>
                    <!-- dik lvalue hya lli atposta 3dna u nom huwa lli kiban l utilisateur -->
                <?php } ?>
            </select><br><br>
            <div class="btnn">
            <button name="submit" class="btn hh btn-outline-danger btn-lg">Ajouter</button>
            <a href="index.php" class="btn hh btn-outline-danger btn-lg">Annuler</a>
            </div>
            <br><br>
            <?php 
                if(isset($_POST['submit'])){
                    extract($_POST);
                    // db kitcreeyaw des vars wlkin dik file makatcreeyash 7itash makaynash f $post kitla7 f$files
                    $source=$_FILES['flag']['tmp_name'];
                    // hadik flag name dyal dik input
                    $destination="img/".$_FILES['flag']['name'];
                    move_uploaded_file($source,$destination);
                    // kishd l image wkilu7ha fdak dossier img
                    $nomp=addslashes($nomp);
                    // bash ila tsaisatt shi apostrof ula shi 7aja maytkharba9sh wzid wslashe
                    $query="INSERT into Pays values(null, '$nomp','$destination','$idc')";
                    mysqli_query($con, $query) or die(mysqli_error($con));
                    echo '    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </symbol>
                   
                  </svg>
                  </div>
                  <div class="alert hhh alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                      Pays Ajouter Avec succés
                    </div>
                  ';
                }
            
            
            ?>
            
        </form>
    </div>
</div>

</body>
</html>