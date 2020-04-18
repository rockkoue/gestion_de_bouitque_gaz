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
<div class="bnr_select_main cf">
<select class="chosen-select" data-placeholder="What are they interested in" id="category" multiple="" name="category[]" tabindex="-1" style="display: none;">
                        <option value="">What are they interested in</option>
                        <option value="1">Sports</option>
   <option value="2">Fashion</option>
   <option value="4">Electronics</option>
   <option value="18">Experiences</option>
   <option value="19">Health &  Beauty</option>
   <option value="7">Home & Garden</option>
   <option value="8">Entertainment</option>
   <option value="9">Babies</option>
   <option value="10">Toys</option>
   <option value="11">Alchohol</option>
   <option value="24">Gift Vouchers</option>
  </select><div class="chosen-container chosen-container-multi" style="width: 658px;" title="" id="category_chosen"><ul class="chosen-choices"><li class="search-field"><input type="text" value="What are they interested in" class="default" autocomplete="off" style="width: 202px;" tabindex="4"></li></ul><div class="chosen-drop"><ul class="chosen-results"></ul></div></div>
            </div>
<div class="bnr_select_main" id="show_location" style="display: none;">
<select id="state" name="state" tabindex="1">
      <option value="">Location</option>
     
    <option value="VIC">VIC</option>
     
    <option value="NSW">NSW</option>
     
    <option value="QLD">QLD</option>
     
    <option value="WA">WA</option>
     
    <option value="SA">SA</option>
     
    <option value="TAS">TAS</option>
     
    <option value="NT">NT</option>
     
    <option value="ACT">ACT</option>
        </select>
</div>
<script src="jquery-3.3.1.slim.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js" type="text/javascript"></script>
<script src="popper.min.js" ></script>
<script src="bootstrap.min.js" ></script>


      <script>
       
       $(document).bind("pageinit", function() {
    $(".choix").chosen();
});    
                       

      </script>
      <script type="text/javascript">
$(function(){
    $(".chosen-select").chosen();
});
$(document).ready(function(){
  
  jQuery("#category").chosen().change(function(){
   
  categorytext = jQuery(this).find("option:selected").text();   
  categoryval = jQuery(this).find("option:selected").val();   
   
  var options = jQuery("#category option:selected");
  
  var values = jQuery.map(options, function (option) {
   
   return option.value; //option.text;
  });   
   jQuery.ajax({
     type: "POST",
     url: "home/getexperience",
     data: 'cat_id='+values,
     success: function(data) {
    if(data == 'Experiences'){
     jQuery("#show_location").show();
     }else{
      jQuery("#show_location").hide();
     }
      
     
      },
    error: function(data) {
     jQuery(".f_error").html(data).focus();
    }
   });
     });
   
 });
 

</script>
</body>
</html>