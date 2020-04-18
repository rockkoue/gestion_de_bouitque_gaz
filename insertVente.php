
<?php
//insert.php;

if(isset($_POST["produit"]))
{
   
 $connect = new PDO("mysql:host=localhost;dbname=depotgaz", "root", "");
 //$id = uniqid();


 
 $newDate = date("d-m-Y");
 $Dateref = date("dmY");
 $montant=0;
 for($count = 0; $count < count($_POST["produit"]); $count++)
 {  
    $montant = $montant + ($_POST["qte"][$count]*$_POST["prixu"][$count]); 
  $query = "INSERT INTO vente 
  (dateVente,typeVente, produit,lignebouteilleVente, qteVente,PrixUVente) 
  VALUES (:dateVente,:typeVente, :produit, :categorie, :qte, :prixu)
  ";
  $statement = $connect->prepare($query);

  $fal=$statement->execute(
   array(
    ':dateVente' =>  $newDate, 
    ':typeVente' => $_POST["typevente"][$count], 
    ':produit'   => $_POST["produit"][$count],
    ':categorie' => $_POST["categorie"][$count], 
    ':qte'  => $_POST["qte"][$count],
    ':prixu' => $_POST["prixu"][$count]
   )
  );

  
 }

//insertion refRechargement
$Ref = uniqid();
$Ref= 'REVente-'.$Dateref;
$query = "INSERT INTO ref_vente
(refvente,MontantVente, Datevente ) 
VALUES (:refvente, :Montant, :Datevente) ";
$statement = $connect->prepare($query);

$fal=$statement->execute(
 array(
  ':refvente'   =>  $Ref,  
  ':Montant'    =>  $montant,
  ':Datevente'  =>  $newDate
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