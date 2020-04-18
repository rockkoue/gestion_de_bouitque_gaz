
<?php
//insert.php;



if( $_POST["recharge"] !='' )
{
   
 $connect = new PDO("mysql:host=localhost;dbname=depotgaz", "root", "");
 //$id = uniqid();
 $newDate = date("d-m-Y");
  $query = "INSERT INTO recette
  (dateRecette,rechargement,vente,depense,monnaie,remboursementAvoir,Avoir,Versement,Commentaire) 
  VALUES (:dateRecette,:rechargement,:vente,:depense,:monnaie,:remboursementAvoir,:Avoir,:versement,:Commentaire)
  ";
  $statement = $connect->prepare($query);

  $fal=$statement->execute(
   array(
    ':dateRecette' =>  $newDate,
    ':rechargement' => $_POST["recharge"], 
    ':vente'   => '$_POST["refvente"]',
    ':depense' => $_POST["depense"], 
    ':monnaie'  => $_POST["monnaie"],
    ':remboursementAvoir' => $_POST["remboursement"],
    ':Avoir' => $_POST["avoir"],
    ':versement' => $_POST["Versement"],
    ':Commentaire' => ''
   )
  );
  var_dump($statement);
  die();

 
//Update refRechargement
$ref1=str_replace(' ','',$_POST["recharge"]);
$queryrecharge= "UPDATE ref_rechargement SET Etat=? WHERE refRechargement=?";
$stmt= $connect->prepare($queryrecharge);
$stmt->execute(['0',$ref1]);
//insertion refRechargement

//Update refvente
if(isset($_POST["refvente"])){
  $ref2=str_replace(' ','',$_POST["refvente"]);
  $queryvente= "UPDATE ref_vente  SET Etat=? WHERE refvente=?";
  $statement2 = $connect->prepare($queryvente);
  $statement2->execute(['0',$ref2]);
}

//end refvente

 $result = $statement2->fetchAll();
 if(isset($result))
 {
  echo json_encode('ok');
 }
}else{
    echo 'error';
}

?>