<?php
$connect = new PDO("mysql:host=localhost;dbname=depotgaz", "root", "");
$query = "Select * from recette "; 
$resultrecharg = $connect->query($query);
$resultrecharg->execute();


$queryjoin ="SELECT * FROM recette,ref_rechargement,ref_vente where recette.rechargement=ref_rechargement.refRechargement AND recette.vente=ref_vente.refvente ";
$resul = $connect->query($queryjoin);
$resul->execute();
/*
foreach($resul as $val){
    echo $val['refRechargement'];
}*/
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

<div align="center"><h1> Voir les Recettes</h1></div>



<table class="table" id="donne">
  <thead class="thead-light">
    <tr>
      <th scope="col">N°</th>
      <th scope="col">Date Recette</th>
      <th scope="col">Montant vente</th>
      <th scope="col">Montant Rechargement</th>
      <th scope="col">Depense</th>
      <th scope="col">Versement</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
   <?php foreach($resul as $av)
   {
       ?>
 <tr>
      <th scope="row" class="ref"><?= $av['Ref_recette']?></th>
      <td class="date"><?= $av['dateRecette']?></td>
      <td><?= $av['MontantVente']?></td>
      <td><?= $av['MontantRecharg']?></td>
      <td><?= $av['depense']?></td>
      <td> <?= $av['Versement']?></td>
      <td>
      <div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    parametre
  </button>
  <div class="dropdown-menu dropdown-menu-left">
    <button class="dropdown-item detailes" type="button" data-toggle="modal" data-target=".bd-example-modal-xl">Detail</button>
    <button class="dropdown-item" type="button">imprimer</button>
  </div>
</div>

      </td>
    </tr>
    <?php }?>
  
   
  </tbody>
</table>
</div>
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div id=recetteGlobale>

      <table class="table" id="table"  style=" width:70%; border-collapse:collapse;" align="center" border="1" >
                                  <thead>
                                    <h1 align="center"> RECHARGEMENT</h1>
                                        <tr style=" background-color:#E3DEDE;">
                                          <th scope="col">Designation</th>
                                          <th scope="col">type de bouteille</th>
                                          <th scope="col">Qte</th>
                                          <th scope="col">Prix Unitaire</th>
                                          <th scope="col">Cumule</th>
                                        </tr>
                                  </thead>
                                        <tbody class="valeur" align="center">
                                        </tbody>     
        </table>
        <table class="table" id ="vente"   style=" width:70%; border-collapse:collapse; " align="center" border="1">
                                  <thead>
                                    <h1 align="center"> VENTE</h1>
                                        <tr  style=" background-color:#E3DEDE;" >
                                          <th scope="col">Designation</th>
                                          <th scope="col">ligne</th>
                                          <th scope="col">Qte</th>
                                          <th scope="col">Prix Unitaire</th>
                                        </tr>
                                  </thead>
                                        <tbody class="Capteur">
                                        </tbody>     
        </table>
        <table class="table" id ="Bilan"  style=" width:70%; border-collapse:collapse;" align="center" border="1">
                                  <thead>
                                    <h1 align="center"> BILAN</h1>
                                        <tr style=" background-color:#E3DEDE;">
                                          <th scope="col">Montant net</th>
                                          <th scope="col">Montant TTC</th>
                                          <th scope="col">Depense</th>
                                          <th scope="col">Avoir</th>
                                          <th scope="col">Remboursement</th>
                                          <th scope="col">Monnaie</th>
                                          <th scope="col">Versement</th>
                                        </tr>
                                  </thead>
                                        <tbody class="Bilan">
                                        </tbody>     
        </table>
<div>

</div>
      </div>

      <button  class=" btn btn-primary" onclick=" printData()"> imprimer </button>
    </div>
   
  </div>
  
</div>


<script src="jquery-3.3.1.slim.min.js" ></script>
<script src="jquery-3.4.1.min.js"></script>
<script src="popper.min.js" ></script>
<script src="bootstrap.min.js" ></script>
      <script>  
       $('.detailes').on('click',function(){

           data =$(this).parent().parent().parent().parent().find('.ref').text();
          
           form_data =data;
           
           $.ajax({
                        url:"recetteDetailes.php",
                        method:"POST",
                        dataType:'json',
                        data:'refRecette=' + form_data,
                        success:function(data)
                        {
                        
                          $('.valeur').html('');
                          $('.Capteur').html('');
                          $('.Bilan').html('');
                          
                          for(var i= 0;i< data['rechargement'].length;i++)
                          {
                                $('.valeur').append(`
                                                            <tr>
                                                              <td>${ data['rechargement'][i].bouteille}</td>
                                                              <td>${data['rechargement'][i].ligneBouteille}</td>
                                                              <td>${data['rechargement'][i].Qte}</td>
                                                              <td>${data['rechargement'][i].PrixU}</td>
                                                              <td>${ parseInt(data['rechargement'][i].Qte) * parseInt(data['rechargement'][i].PrixU)}</td>
                                                            </tr>
                                                  `);
                          }
                          for(var i= 0;i< data['vente'].length;i++)
                          {
                                $('.Capteur').append(`
                                                  <tr>
                                                    <td>${data['vente'][i].produit}</td>
                                                    <td>${data['vente'][i].lignebouteilleVente}</td>
                                                    <td>${data['vente'][i].qteVente}</td>
                                                    <td>${data['vente'][i].PrixUVente}</td>
                                                  </tr>
                              `);
                          }
                           
                            
                            montant =parseInt(data['Recette'][0].MontantRecharg)+parseInt(data['Recette'][0].MontantVente);
                            MontantTTC= montant - parseInt(data['Recette'][0].depense)+parseInt(data['Recette'][0].Avoir)+parseInt(data['Recette'][0].monnaie)-parseInt(data['Recette'][0].remboursementAvoir);
                            $('.Bilan').append(`
                                                  <tr>
                                                    <td>${montant}</td>
                                                    <td>${MontantTTC}</td>
                                                    <td>${data['Recette'][0].depense}</td>
                                                    <td>${data['Recette'][0].Avoir}</td>
                                                    <td>${data['Recette'][0].remboursementAvoir}</td>
                                                    <td>${data['Recette'][0].monnaie}</td>
                                                    <td>${data['Recette'][0].Versement}</td>
                                                  </tr>
                              `);  
                        }//end success
                      
                      });//end ajax
       });


 function printData()
{
   var divToPrint=document.getElementById("recetteGlobale");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

      </script>
</body>
</html>