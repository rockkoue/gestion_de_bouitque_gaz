<?php
$connect = new PDO("mysql:host=localhost;dbname=depotgaz", "root", "");
$query = "Select refRechargement,Etat from ref_rechargement Where Etat=1 "; 
$resultrecharg = $connect->query($query);
$query1 = "Select refvente,Etat from ref_vente Where Etat=1 "; 
$resultVente = $connect->query($query1);

//$result->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>
        <!--=============== css  ===============-->
        <link rel="stylesheet" href="bootstrap.min.css" >
        <!-- reference your copy Font Awesome here (from our Kits or by hosting yourself) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <div class="content">

<div align="center"><h1>Recette</h1></div>
<form id="dataform" action="">
  <div class="form-row">
        <div class="form-group col-md-2">
                <label for="inputState">Ref recharge</label>
               
                <select id="produit" name="recharge" class="form-control">
                        
                  <option selected value="">produit choix</option>
                <?php  foreach($resultrecharg as $val){ ?>    
                  <option value="<?= $val['refRechargement'];?>"><?= $val['refRechargement']; ?></option>
                <?php }?>

                </select>
        </div>
        <div class="form-group col-md-2">
        <label for="inputState">Ref vente</label>
        <select id="categorie" name="refvente" class="form-control">
                <option selected value="">Choose...</option>
                <?php  foreach($resultVente as $val){ ?>    
                  <option value="<?= $val['refvente']; ?>"><?= $val['refvente']; ?></option>
                <?php }?>
        </select>
        </div>
        <div class="form-group col-md-2">
        <label for="inputState">Monnaie</label>
        <input type="number" class="form-control" name="monnaie" required>
        </div>
        <div class="form-group col-md-1">
        <label for="inputState">Depense</label>
        <input type="number" class="form-control" name="depense" required >
        </div>
        <div class="form-group col-md-1">
        <label for="inputState">Remboursement</label>
        <input type="number" class="form-control" name="remboursement" required >
        </div>
        <div class="form-group col-md-1">
        <label for="inputState">Avoir</label>
        <input type="number" class="form-control" name="avoir" required >
        </div>
        <div class="form-group col-md-2">
        <label for="inputState">Versement</label>
        <input type="number" class="form-control" name="Versement" required >
        </div>
        <div class="form-group col-md-2">
        <label for="inputState"></label>
        <div class="btn btn-danger sendData">Creation</div>
        </div>  
  </div>
</form>


</div>

<script src="jquery-3.3.1.slim.min.js" ></script>
<script src="jquery-3.4.1.min.js"></script>
<script src="popper.min.js" ></script>
<script src="bootstrap.min.js" ></script>
      <script>  
        $('.sendData').on('click',function(){
          
                    var form_data = $('#dataform').serialize();
                   
                     if(form_data ==''){
                        $("#aff").append(`<div class="alert alert-danger text-center error" role="alert">
                         Merci de creer Une recette
                       </div>`);
                       $(".error").delay(1000).fadeOut();
                     }
                     else
                     {
                      
                       $.ajax({
                       url:"insertRecette.php",
                       method:"POST",
                       dataType:'json',
                       data:form_data,
                       success:function(data)
                       {
                        console.log(data);
                         if(data == 'ok')
                         {
                           $("#aff").append(`<div class="alert alert-success text-center success" role="alert">
                         Données envoyées avec success
                       </div>`);
                       $(".success").delay(1000).fadeOut();
                         }
                       }
                     });
                     }
                }) ;
      </script>
</body>
</html>