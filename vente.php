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
        <style>
        .invisibleConsille{
            display: none;
        }
        .invisibleAssessoir{
            display: none;
        }
        
        </style>
</head>
<body>
    <div class="content">

<div align="center"><h1>Ventes</h1></div>
<form id="dataform">
  
  <div class="form-row ">
        <div class="form-group col-md-2">
                <label for="inputState">types de vente</label>
                <select  class="form-control design">
                  <option selected>produit choix</option>
                  <option value="Consilles">Consilles</option>
                  <option value="Accessoires">Accessoires</option>
                </select>
        </div>
        <div class="form-group col-md-2 invisibleConsille">
        <label for="inputState">Types Consilles</label>
        <select  name="produit" class="form-control categorieC laconsille ">
                <option selected>Choose...</option>
                <option value="SHELL">shell</option>
                <option value="ORYX">oryx</option>
                <option value="SIMAM">simam</option>
        </select>
        </div>
        <div class="form-group col-md-2 invisibleConsille">
        <label for="inputState">Categorie</label>
        <select name="categorie" class="form-control categorieC categorie">
                <option selected>Choose...</option>
                <option value="B6">B6</option>
                <option value="B12">B12</option>
                <option value="B24">B24</option>
        </select>
        </div>
        <div class="form-group col-md-2 invisibleAssessoir">
        <label for="inputState">Types Assessoir</label>
        <select  name="Accessoir" class="form-control categorieA ">
                <option selected>Choose...</option>
                <option value="SUPPORT">support</option>
                <option value="BRULEUR">bruleur</option>
                <option value="SUPPORT SHELL">support shell</option>
        </select>
        </div>
        <div class="form-group col-md-2">
                        <label for="inputState">qte</label>
                        <input type="number" class="form-control" id="qte">
          </div>
        <div class="form-group col-md-2">
        <label for="inputState">prix</label>
        <input type="number" class="form-control" id="montant">
        </div>

        <div class="form-group col-md-2">
        <label for="inputState"></label>
        <div class="btn btn-danger add">Ajouter</div>
        </div>
        
  </div>
  </form>
        <div id="composant">
<form action="" id="formaff">
      <table class="table" id="rechargment">
        <thead class="thead-light">
          <tr>
            <th scope="col">Designation</th>
            <th scope="col">categorie</th>
            <th scope="col">qte</th>
            <th scope="col">pu</th>
            <th scope="col">Montant</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody id="produits">
        </tbody>
      </table>
</form>
        </div>
           

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
<script src="jquery-3.3.1.slim.min.js" ></script>
<script src="jquery-3.4.1.min.js"></script>
<script src="popper.min.js" ></script>
<script src="bootstrap.min.js" ></script>
      <script>
       
            $('.design').change('click',function()
            {
             
                var choix = $('.design').find(":selected").val();
               if(choix =='Consilles')
               {  
                 $('.categorieC').parent().removeClass('invisibleConsille');
                 $('.categorieA').parent().addClass('invisibleAssessoir');       
               }
               if(choix=='Accessoires'){
                $('.categorieA').parent().removeClass('invisibleAssessoir');
                $('.categorieC').parent().addClass('invisibleConsille');
               }
               
            });


               
                $('.add').on('click',function(){ 

                 choixtype  = $('#dataform .design').val();

                    //verification du choix Consilles
                      if(choixtype =='Consilles'){   
                        console.log('vrai');     
                        let typeVente ='Consilles';
                  let produit = $('.laconsille').val();
                  console.log(produit);
                  let categorie = $('.categorie').val();
                  let qte = parseInt( $('#qte').val());
                  let montant = parseInt($('#montant').val());
                  let total =montant*qte;
                        $( "#produits" ).append( ` 
                                         <tr>
                                                <td>
                                                ${produit}
                                                <input type="hidden"  class="form-control produit " name="produit[]" readonly value="${produit}" > 
                                                <input type="hidden"  class=" produit " name="typevente[]" readonly value="${typeVente}" >    
                                                </td>
                                                </td>
                                                <td class="categ">
                                                ${categorie}
                                                <input type="hidden"  class="form-control  " name="categorie[]" readonly value=" ${categorie}" >
                                                </td>
                                                <td >
                                                <input type="hidden"  class="form-control qte " name="qte[]"  readonly value="${qte}" >
                                                
                                                ${qte}
                                                </td>
                                                <td>
                                                
                                                <input type="hidden"  class="form-control montant" name="prixu[]" readonly value="${montant}" >
                                                ${montant} 
                                                </td>
                                                <td class="toto" >${total}
                                                <input type="hidden"  class="form-control Mdt " readonly placeholder="${total}" >
                                                </td>
                                                <td> 
                                                <a class="btn btn-success del "  >
                                                <i class="fa fa-minus-square-o "></i> Delete</a>
                                                </td>
                                        </tr>                                    
                        ` );
                        ttc(); 
                      }
                      //verification du choix Accessoir 
                      if(choixtype =='Accessoires'){ 
                        console.log('farai');
                  let typeVente ='Accessoires';
                 let  categorie = '';
                  let produit = $('.categorieA').val();
                  let qte = parseInt( $('#qte').val());
                  let montant = parseInt($('#montant').val());
                  let total =montant*qte;
                        $( "#produits" ).append( ` 
                                         <tr>
                                                <td>
                                                ${produit}
                                                <input type="hidden"  class=" produit " name="produit[]" readonly value="${produit}" >
                                                <input type="hidden"  class=" produit " name="typevente[]" readonly value="${typeVente}" >
                                                </td>
                                                <td class="categ">
                                                ${categorie}
                                                <input type="hidden"  class="form-control  " name="categorie[]" readonly value=" ${categorie}" >
                                                </td>
                                                <td class="qte">
                                                ${qte}
                                                <input type="hidden"  class="form-control qte " name="qte[]"  readonly value="${qte}" >

                                                </td>
                                                <td class="montant">${montant} 
                                                <input type="hidden"  class="form-control montant" name="prixu[]" readonly value="${montant}" >
                                                </td>
                                                <td class="toto" >${total} </td>
                                                <input type="hidden"  class="form-control Mdt " readonly placeholder="${total} " >
                                                <td> 
                                                <a class="btn btn-success del "  >
                                                <i class="fa fa-minus-square-o "></i> Delete</a>
                                                </td>
                                        </tr>                                    
                        ` );
                        ttc(); 
                      }
    
                        
                       // nbreBout();
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
                    console.log( Min);

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
                       url:"insertVente.php",
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