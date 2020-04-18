
<?php
//insert.php;

if(isset($_POST["produit"]))
{
 $connect = new PDO("mysql:host=localhost;dbname=depotgaz", "root", "");
 

 $newDate = date("d-m-Y");
 $Dateref = date("dmY");
 $montant=0;
 

 for($count = 0; $count < count($_POST["produit"]); $count++)
 {  
     $montant = $montant + ($_POST["qte"][$count]*$_POST["montant"][$count]); 
     
  $query = "INSERT INTO rechargement
  (DateRechargement,bouteille, ligneBouteille,Qte, PrixU) 
  VALUES (:daterechargement, :produit, :categorie, :qte, :prixu)
  ";
  $statement = $connect->prepare($query);

  $fal=$statement->execute(
   array(
    ':daterechargement'   =>  $newDate,  
    ':produit'   => $_POST["produit"][$count],
    ':categorie'  => $_POST["categorie"][$count], 
    ':qte' => $_POST["qte"][$count], 
    ':prixu'  => $_POST["montant"][$count]
   )
  );
 }
 //insertion refRechargement
 $Ref = uniqid();
 $Ref= 'REfRech-'.$Dateref;
 $query = "INSERT INTO ref_rechargement
 (refRechargement,MontantRecharg, DateRchargement ) 
 VALUES (:refRechargement, :Montant, :DateRechargement)
 ";
 $statement = $connect->prepare($query);

 $fal=$statement->execute(
  array(
   ':refRechargement'   =>  $Ref,  
   ':Montant'           =>  $montant,
   ':DateRechargement'  =>  $newDate
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