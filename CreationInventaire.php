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

<div align="center"><h1>Inventaire</h1></div>
<form id="dataform">
  
  <div class="form-row">
        <div class="form-group col-md-3">
                <label for="inputState">Designation</label>
                <select id="produit" class="form-control">
                  <option selected>produit choix</option>
                  <option>shell</option>
                  <option>oryx</option>
                  <option>simam</option>
                </select>
        </div>
        <div class="form-group col-md-2">
        <label for="inputState">Taile Bouteille</label>
        <select id="categorie" name="categorie" class="form-control">
                <option selected>Choose...</option>
                <option value="B6">B6</option>
                <option value="B12">B12</option>
                <option value="B24">B24</option>
        </select>
        </div>
        <div class="form-group col-md-2">
                        <label for="inputState">Vide</label>
                        <input type="number" class="form-control" id="qte">
                        </div>
        <div class="form-group col-md-2">
        <label for="inputState">Pleine</label>
        <input type="number" class="form-control" id="montant">
        </div>

        <div class="form-group col-md-3">
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
      <th scope="col">vide</th>
      <th scope="col">pleine</th>
      <th scope="col">Nombre total</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody id="produits">
  </tbody>
</table>
</form>
<div > 


      <div id="aff">
              <div class="form-row">
                      <div class="form-group col-md-1">
                      <label for="inputState" >Total B12</label>
                      <input  class="form-control NbreB12"  readonly value="" >
                      
                      </div>
                      <div class="form-group col-md-1">
                      
                      <label for="inputState" >Total B6</label>
                      <input  class="form-control NbreB6"  readonly value="" >
                  <!--
                      </div>
                      <div class="form-group col-md-2">
                      <label for="inputState" >Nombre de Bouteille</label>
                      <input  class="form-control NbreB"  readonly value="" >
                      
                      </div>
                      -->
                    </div>
            
              </div>   
    </div>  

    <div align="center">
                <a href="" type="button" class="btn btn-primary sendData" >
                  Envoyer
                </a>
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
                  let total =montant+qte;
                 
                        $( "#produits" ).append( ` 
                                         <tr>
                                                <td>
                                                ${produit}
                                                <input type="hidden"   name="produit[]"  value="${produit}" >
                                                
                                                </td>
                                                <td class="categ">${categorie}
                                                <input type="hidden"  class=" lacate" name="categorie[]"  value="${categorie}" >
                                                
                                                </td>
                                                <td >${qte}
                                                
                                                <input type="hidden"   name="vide[]" value="${qte}" >
                                                </td>
                                                <td>${montant}
                                                <input type="hidden"  name="plein[]"  value="${montant}" >
                                                
                                                </td>
                                                <td class="toto" >`+total+`</td>
                                                <input type="hidden"  class=" Mdt "placeholder="`+total+`" >
                                                <td> 
                                                <a class="btn btn-success del "  >
                                                <i class="fa fa-minus-square-o "></i> Delete</a>
                                                </td>
                                        </tr>                                    
                        ` );
                       if(categorie=="B6")
                       {
                        ttb6(total);
                       }
                       if(categorie=="B12"){
                           ttb12(total);
                       }
                       
                       // nbreBout();
                });
                 elementB6=[];
                function ttb6(para){
            
                  data =para;
                  elementB6.push(data);
                  console.log(elementB6);
                  let somme=0;
                  for(var i in elementB6)
                  {
                    somme += elementB6[i];
                    console.log(somme);
                    $('.NbreB6').attr('value',somme);
                  }
                  
                }
                elementB12=[]
                function ttb12(para){
                    data =para;
                  elementB12.push(data);
                  console.log(elementB12);
                  let somme=0;
                  for(var i in elementB12)
                  {
                    somme += elementB12[i];
                    console.log(somme);
                    $('.NbreB12').attr('value',somme);
                  }
                }
                function nbreBout(){
                    var vide=parseInt($('#qte').val());
                    var pleine=parseInt($('#montant').val());
                  data = vide + pleine;
                  element.push(data); 
                  let somme=0;
                  for(var i in element)
                  {
                    somme += element[i];
                    console.log(somme);
                    $('.NbreB').attr('value',somme);
                  }
                }
                $(document).on('click','.del',function(){
              
              let  cate = $(this).parent().parent().find('.lacate').val();
            
                if(cate =="B6")
                {
                  
                        let  Min = parseInt($(this).parent().parent().find('.toto').text());

                        var numero1 = elementB6.indexOf(Min);

                        elementB6[numero1]=0;

                        let  Man = parseInt($('#aff').find('.NbreB6').val());
                        let somme = Math.abs(Man-Min);
                        $('.NbreB6').attr('value',somme);
                        $(this).parent().parent().remove();
                }
                if(cate=="B12"){
                  
                    let  Min = parseInt($(this).parent().parent().find('.toto').text());
                    var numero1 = elementB12.indexOf(Min);

                    elementB12[numero1]=0;

                    let  Man = parseInt($('#aff').find('.NbreB12').val());
                    let somme = Math.abs(Man-Min);
                    $('.NbreB12').attr('value',somme);
                    $(this).parent().parent().remove();
                }
              
                      });
 
                 $('.sendData').on('click',function(event){
                  event.preventDefault();

                  var form_data = $('#formaff').serialize();
                  	 
                  console.log(form_data);

                        $.ajax({
                        url:"insert_inventaire.php",
                        method:"POST",
                        dataType:'json',
                        data:form_data,
                        success:function(data)
                        {
                          if(data == 'ok')
                          {
                            console.log('enregistrement réussit');
                          }
                        }
                      });
                   
                  console.log('ddd');
                });      
                          

      </script>
</body>
</html>