<?php
require_once("../resources/config.php");
require_once("../resources/schedules/header.php");

if(isset($_GET['s_id'])){
  ?>
  <div class="row>
  <?php
  $Sid = escape_string($_GET['s_id']);
  $Schedule = query("SELECT * FROM cinetest_schedule WHERE id={$Sid}");
  confirm($Schedule);
  $Row = fetch_array($Schedule);
  $Cinema = query("SELECT * FROM cinetest_cinema WHERE id={$Row['cinema_id']}");
  confirm($Cinema);
  $Cinema1 = fetch_array($Cinema);
  $Movie = query("SELECT * FROM cinetest_movie WHERE id={$Row['movie_id']}");
  confirm($Movie);
  $Movie1 = fetch_array($Movie);
  $Db_date = explode("-",$Row['date']);
  $Date = date("D M j, Y", mktime(0,0,0,$Db_date[1],$Db_date[2],$Db_date[0]));;
  $Data = <<<d
  <div class="col-md-6 col-lg-4 mb-4">
    <div class="card listing-preview">
      <img class="card-img-top" src="../{$Movie1['img_location']}" alt=""  height="400">
      <div class="card-body">
        <div class="listing-heading text-center">
          <h4 class="text-primary">{$Movie1['title']}</h4>
        </div>
        <hr>
        <div class="">
          <p>At: {$Cinema1['name']}</p>
          <p>Duration: {$Movie1['duration']}</p>
          <p>Date: {$Date}</p>
          <p>From: {$Row['start_time']}-{$Row['end_time']}</p>
        </div>
      </div>
    </div>
  </div>
  d;
  echo $Data;
  ?>
  <h6>Seats, click to reserve</h6>
  <hr>
  <div class="bg-light">
    <?php
    $Seats = query("SELECT * FROM `cinetest_seat` WHERE `price_id` IN (SELECT id FROM `cinetest_price` WHERE `cinema_id`={$Cinema1['id']})");
    confirm($Seats);
    while($Row1=fetch_array($Seats)){
      $Reservation_seat = query("SELECT * FROM cinetest_reservations WHERE schedule_id ={$Row['id']} AND seat_id ={$Row1['id']} AND is_valid =1");
      confirm($Reservation_seat);
      $Seat_price = query("SELECT * FROM cinetest_price WHERE id={$Row1['price_id']}");
      confirm($Seat_price);
      $Seat_price_row = fetch_array($Seat_price);
      $SeatClass = 'bg-white';
      if(!num_rows($Reservation_seat)<1){
        $SeatClass = 'btn-primary';
      }
      $D=<<<d
        <button onClick="flipModal({$Row1['id']})" type="button" class="{$SeatClass} text-lg-center btn mb-4" ><span>Seat no. {$Row1['seat_no']}</span><hr>Price: {$Seat_price_row['price']} Birr</button>
      d;
      echo $D;
}

    ?>
  </div>
  </div>
  <?php
}
else{
  redirect('../index.php');
}
?>
<div class="modal fade" id="reserveModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="reserveModalLabel"><i class="fas fa-envelope"></i>Reserve</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h6>Reserve: </h6>
          <br>
          <form action="" enctype="multipart/form-data" method="post">
            <input type="text" name="sc_id" required class="form-control" value="<?php echo $Row['id']?>" hidden/>
            <input type="text" name="seat_id" required class="form-control" hidden id="seat_id"/>
            <label>First name:<span class="text-danger"><sup>*</sup></span></label>
            <input type="text" name="fname" required class="form-control"/>
            <label>Last name:<span class="text-danger"><sup>*</sup></span></label>
            <input type="text" name="lname" required class="form-control"/>
            <label>Phonenumber:<span class="text-danger"><sup>*</sup></span></label>
            <input type="text" name="pno" required class="form-control"/>
            <br>
            <?php reserve_for_guest()?>
            <input type="submit" value="Reserve" class="btn btn-success">
            <a href="#" class="btn btn-secondary" style="float: right;" data-dismiss="modal">
            Cancel
            </a>
          </form>
        </div>
    </div>
  </div>
</div>
<?php require_once("../resources/schedules/footer.php")?>
