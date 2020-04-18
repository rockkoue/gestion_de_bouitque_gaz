
<?php
//insert.php;

if(isset($_POST["produit"]))
{
   
 $connect = new PDO("mysql:host=localhost;dbname=depotgaz", "root", "");
 //$id = uniqid();


 
 $newDate = date("d-m-Y");
 $Dateref = date("dmY");

 for($count = 0; $count < count($_POST["produit"]); $count++)
 {  
     
  $query = "INSERT INTO inventaire 
  (date_inventaire,bouteille, lignebouteille,BoutV, BoutP) 
  VALUES (:dateinventaire, :produit, :categorie, :vide, :plein)
  ";
  $statement = $connect->prepare($query);

  $fal=$statement->execute(
   array(
    ':dateinventaire'   =>  $newDate,  
    ':produit'   => $_POST["produit"][$count],
    ':categorie'  => $_POST["categorie"][$count], 
    ':vide' => $_POST["vide"][$count], 
    ':plein'  => $_POST["plein"][$count]
   )
  );

  
 }

 //insertion refinventaire
 //iiii
 $vid=0;
for($k=0;$k<count($_POST["vide"]);$k++){
  $vid= $vid +($_POST["vide"][$k]);
  }
  $plein=0;
for($j=0;$i<count($_POST["plein"]);$j++){
  $plein= $plein +($_POST["plein"][$j]);
  }


 ///
 $Ref = uniqid();
 $Ref= 'REfinvent-'.$Dateref;
 $query = "INSERT INTO ref_inventaire
 (refInventaire,videBouteile,pleinBouteille, DateInventaire ) 
 VALUES (:refInv, :videBouteille, :pleinBouteile,dateIn)
 ";
 $statement = $connect->prepare($query);

 $fal=$statement->execute(
  array(
   ':refInv'        =>  $Ref,  
   ':videBouteille' =>  $vid,
   ':pleinBouteile' =>  $plein,
   ':dateIn'        =>  $newDate
  )
  );
//insertion refRechargement


 $result = $statement->fetchAll();
 if(isset($result))
 {
  echo json_encode('ok');
 }
}else{
    echo 'error';
}

?>