<?php require_once ('resources/config.php')?>
<?php require_once("resources/header.php")?>

<h4 class="text-center">Todays Schedule</h4>
<div class="row">
<?php
$Schedules = query("SELECT * FROM cinetest_schedule WHERE date(date)=curdate()");
confirm($Schedules);
if(num_rows($Schedules)<1){
  $Data = <<<d
    <h6>No Schedule found for today</h6>
  d;
  echo $Data;
}
else{
  while($Row=fetch_array($Schedules)){
    $Cinema = query("SELECT * FROM cinetest_cinema WHERE id={$Row['cinema_id']}");
    confirm($Cinema);
    $Cinema1 = fetch_array($Cinema);
    $Movie = query("SELECT * FROM cinetest_movie WHERE id={$Row['movie_id']}");
    confirm($Movie);
    $Movie1 = fetch_array($Movie);
    $Data = <<<dd
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="card listing-preview">
        <a href="schedule/index.php?s_id={$Row['id']}"><img class="card-img-top" src="{$Movie1['img_location']}" alt=""  height="200"></a>
        <div class="card-body">
          <div class="listing-heading text-center">
            <a href="schedule/index.php?s_id={$Row['id']}" class="text-decoration-none"><h4 class="text-primary">{$Movie1['title']}</h4></a>
          </div>
          <hr>
          <div class="listing">
            <p>At: {$Cinema1['name']}</p>
            <p>Duration: {$Movie1['duration']}</p>
            <p>From: {$Row['start_time']}-{$Row['end_time']}</p>
          </div>
        </div>
      </div>
    </div>
  dd;
    echo $Data;
  }
 
}
?>
</div>
<?php include_once("resources/footer.php")?>