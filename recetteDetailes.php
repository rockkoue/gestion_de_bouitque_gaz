<?php 
$connect = new PDO("mysql:host=localhost;dbname=depotgaz", "root", "");
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

$query1 = "SELECT * FROM recette,ref_rechargement,ref_vente where recette.rechargement=ref_rechargement.refRechargement AND recette.vente=ref_vente.refvente "; 

if($_POST['refRecette']!=''){
    $ref = $_POST['refRecette'];
    $query = "SELECT Ref_recette,dateRecette FROM recette  Where Ref_recette='$ref'"; 
    $resultrecharg = $connect->query($query);
    $da=$resultrecharg->execute( );
    $dd=$resultrecharg->fetch();
     
     $date=$dd['dateRecette'];
     //SELECT * FROM rechargement,recette WHERE recette.dateRecette='$date' AND rechargement.DateRechargement='$date' AND vente.dateVente='$date' 
     
    $query1 = "SELECT *  FROM rechargement,recette WHERE recette.dateRecette=rechargement.DateRechargement   AND recette.dateRecette='$date'"; 
    $recharg = $connect->query($query1);
    $recharg->execute();
    $dds=$recharg->fetchAll();

    $query2 = "SELECT *  FROM recette, vente WHERE recette.dateRecette=vente.dateVente AND recette.dateRecette='$date'"; 
    $vente = $connect->query($query2);
    $vente->execute();
    $valss=$vente->fetchAll();
    //$queryjoin ="SELECT * FROM recette,ref_rechargement,ref_vente where recette.rechargement=ref_rechargement.refRechargement AND recette.vente=ref_vente.refvente ";
   // $query3 = "SELECT *  FROM recette WHERE  recette.dateRecette='$date'"; 
     $query3= "SELECT * FROM recette,ref_rechargement,ref_vente WHERE recette.rechargement=ref_rechargement.refRechargement AND recette.vente=ref_vente.refvente AND recette.dateRecette='$date'";
    $recette = $connect->query($query3);
    $recette->execute();
    $voleur=$recette->fetchAll();

  echo json_encode(array('rechargement' =>$dds,
                        'vente'         =>$valss,
                        'Recette'       =>$voleur
                    ));
    
}


?>