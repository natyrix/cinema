<?php require_once ('resources/config.php')?>
<?php require_once("resources/header.php")?>
<h5>Search schedule by date</h5>
<!-- To display saved schedules for any particular day -->
<form action="" class="form-inline" enctype="multipart/form-data" method="post">
  <input type="date" name='sch_date' id="sch_date" required/>
  <br>
  <?php search_by_date()?>
  <input type="submit" value="Search">
</form>
<h4 class="text-center" id='title'>Schedule for<span class="text-danger">
<?php
if(isset($_SESSION['sch_date'])){
  $Selected_date = explode("-",$_SESSION['sch_date']);
  echo date("D M j, Y", mktime(0,0,0,$Selected_date[1],$Selected_date[2],$Selected_date[0]));
}
else{
  $Today = date("D M j, Y");
  echo " {$Today}";
}
?>
</span>
</h4>
<div class="row">
<?php
if(!isset($_SESSION['sch_date'])){
  $Now = date('Y-m-d');
  $_SESSION['sch_date'] = $Now;
}

$Schedules = query("SELECT * FROM cinetest_schedule WHERE date(date)=date('{$_SESSION['sch_date']}')");
confirm($Schedules);
if(num_rows($Schedules)<1){
  $Data = <<<d
    <h6>No Schedule found for this day.</h6>
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
          <div class="">
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
<?php
include_once("resources/footer.php")?>
<script>
  const Sch_date_control = document.getElementById('sch_date');
  Sch_date_control.valueAsDate = new Date();
  Sch_date_control.min = new Date().toISOString().split("T")[0];
  // const Title_h = document.getElementById('title');
  // Title_h.innerHTML=`${Sch_date_control.value} Schedule`

</script>