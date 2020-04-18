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

<div align="center"><h1>Rechargement</h1></div>
<form id="dataform">
  
  <div class="form-row">
        <div class="form-group col-md-3">
                <label for="inputState">Designation</label>
                <select id="produit" class="form-control">
                  <option selected>produit choix</option>
                  <option>shell</option>
                  <option>oryx</option>
                  <option>ToTal</option>
                  <option>petro ci</option>
                  <option>petro ivoire</option>
                  <option>simam</option>
                  <option>olybya</option>
                  <option>kama</option>
                  <option>saphyr</option>
                  <option>simam</option>
                </select>
        </div>
        <div class="form-group col-md-2">
        <label for="inputState">Taile Bouteille</label>
        <select id="categorie" class="form-control">
                <option selected>Choose...</option>
                <option>B6</option>
                <option>B12</option>
                <option>B24</option>
        </select>
        </div>
        <div class="form-group col-md-2">
                        <label for="inputState">Quantity</label>
                        <input type="number" class="form-control" id="qte" required>
                        </div>
        <div class="form-group col-md-2">
        <label for="inputState">Prix</label>
        <input type="number" class="form-control" id="montant" required >
        </div>

        <div class="form-group col-md-3">
        <label for="inputState"></label>
        <div class="btn btn-danger add">Ajouter</div>
        </div>
        
  </div>
</form>

<div id="composant">

<form action="" id="formaff">
<table class="table" id="rechargment" >
  <thead class="thead-light">
    <tr>
      <th scope="col">Designation</th>
      <th scope="col">categorie</th>
      <th scope="col">Quantité</th>
      <th scope="col">Pu</th>
      <th scope="col">Montant</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
       <tbody id="produits">
      </tbody>
  
</table>
</form>
     <div id="aff">
            <div class="form-group col-md-3">
              <label for="inputState" >Montant TTC</label>
              <input  class="form-control MTTC"  readonly value="" >
            </div>
            <div align="center">
                <button type="button" class="btn btn-primary sendData" >
                  envoyer
                </button>
            </div>
      </div>
  </div>

</div>

<script src="jquery-3.3.1.slim.min.js" ></script>
<script src="jquery-3.4.1.min.js"></script>
<script src="popper.min.js" ></script>
<script src="bootstrap.min.js" ></script>
      <script>  

                $('.add').on('click',function(){ 
                  let produit = $('#produit').val();
                  let categorie = $('#categorie').val();
                  let qte = parseInt( $('#qte').val());
                  let montant = parseInt($('#montant').val());
                  let total =montant*qte;
                        $( "#produits" ).append(` 
                                         <tr>
                                                <td>
                                                <input type="hidden"  class="form-control produit " name="produit[]" readonly value="${produit}" >     
                                                ${produit}</td>
                                                <td>
                                                <input type="hidden"  class="form-control  " name="categorie[]" readonly value=" ${categorie}" >
                                                
                                                ${categorie}</td>
                                                <td>
                                                <input type="hidden"  class="form-control qte " name="qte[]"  readonly value="${qte}" >
                                                
                                                ${qte}</td>
                                                <td>
                                                <input type="hidden"  class="form-control montant" name="montant[]" readonly value="${montant}" >
                                                ${montant}</td>
                                                <td class="toto" >
                                                <input type="hidden"  class="form-control Mdt " readonly value="${total}" >
                                                ${total}</td>
                                                
                                                <td> 
                                                <a class="btn btn-success del "  >
                                                <i class="fa fa-minus-square-o "></i> Delete</a>
                                                </td>
                                        </tr>                                    
                        ` );
                        ttc();       
                });

                 element=[];
                function ttc(){
                  data = parseInt($('#montant').val()*$('#qte').val());
                  element.push(data); 
                  let somme=0;
                  for(var i in element)
                  {
                    somme += element[i];
                   // console.log(somme);
                    $('.MTTC').attr('value',somme);
                  }
                }
                $(document).on('click','.del',function(){
              let  Min= parseInt($(this).parent().parent().find('.toto').text());

              var numero = element.indexOf(Min);

                element[numero]=0;
                
                let  Man = parseInt($('#aff').find('.MTTC').val());
                let somme = Math.abs(Man-Min);
                $('.MTTC').attr('value',somme);
                $(this).parent().parent().remove();
                      });

            $('.sendData').on('click',function(){
               
                var form_data = $('#formaff').serialize();
                  	  if(form_data ==''){
                         $("#aff").append(`<div class="alert alert-danger text-center error" role="alert">
                          Merci de creer Une recette
                        </div>`);
                        $(".error").delay(1000).fadeOut();
                      }
                      else
                      {
                        $.ajax({
                        url:"insertRechargement.php",
                        method:"POST",
                        dataType:'json',
                        data:form_data,
                        success:function(data)
                        {
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