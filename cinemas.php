<?php require_once ('resources/config.php')?>
<?php require_once("resources/header.php")?>
<h4 class="text-center">Cinemas</h4>
<div class="row">
<?php
//query to the database to select from the cinema table
$Cinemas = query("SELECT * FROM cinetest_cinema");
confirm($Cinemas);
//Fetching each row from the result
while($Row=fetch_array($Cinemas)){
  $Data = <<<dd
  <div class="col-md-6 col-lg-4 mb-4">
    <div class="card listing-preview">
      <img class="card-img-top" src="{$Row['img_location']}" alt=""  height="200">
      <div class="card-img-overlay">
      </div>
      <div class="card-body">
        <div class="listing-heading text-center">
          <h4 class="text-primary">{$Row['name']}</h4>
        </div>
        <hr>
      </div>
    </div>
  </div>
dd;
  echo $Data;
}
?>
</div>
<?php include_once("resources/footer.php")?>
