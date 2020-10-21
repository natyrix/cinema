<?php
function redirect($location){
  header("Location: $location");
}
function query($sql){
  global $Connection;
  return mysqli_query($Connection,$sql);
}

function confirm($result){
  global $Connection;
  if(!$result){
      die("QUERY FAILED " . mysqli_error($Connection));
  }
}
function escape_string($string){
  global $Connection;
  return mysqli_real_escape_string($Connection,$string);
}
function fetch_array($result){
  return mysqli_fetch_array($result);
}
function num_rows($result){
  $x=mysqli_num_rows($result);
  return $x;
}

function search_by_date(){
  if($_SERVER['REQUEST_METHOD']=="POST" || isset($_POST['submit'])){
    $Selected_date = escape_string(trim($_POST['sch_date']));
    $_SESSION['sch_date'] = $Selected_date;
    redirect('schedules.php');
  }
}
function reserve_for_guest(){
  if($_SERVER['REQUEST_METHOD']=="POST" || isset($_POST['submit'])){
    $First_name = escape_string(trim($_POST['fname']));
    $Last_name = escape_string(trim($_POST['lname']));
    $P_no = escape_string(trim($_POST['pno']));
    $Seat_id = escape_string(trim($_POST['seat_id']));
    $Schedule_id = escape_string(trim($_POST['sc_id']));
    $Date = date('Y-m-d H:m:s');
    $Guest = query("INSERT INTO cinetest_guest(first_name,last_name,phone,created_at) VALUES ('{$First_name}','{$Last_name}','{$P_no}',curdate())");
    confirm($Guest);
    $Saved_Guest = query("SELECT * FROM cinetest_guest WHERE first_name='{$First_name}' AND last_name='{$Last_name}' AND phone='{$P_no}' AND created_at=curdate()");
    confirm($Saved_Guest);
    $G_row = fetch_array($Saved_Guest);
    if(num_rows($Saved_Guest)>0){
      $G_id = $G_row['id'];
      $_SESSION['G_id'] = $Schedule_id;
      echo $G_id;
      $Reservation = query("INSERT INTO cinetest_reservations(created_at,guest_id,schedule_id,seat_id,is_valid ) VALUES(curdate(), '{$G_id}','{$Schedule_id}','{$Seat_id}',1)");
      confirm($Reservation);
      redirect("../schedule/index.php?s_id={$Schedule_id}");
    }
    else{
      $_SESSION['G_id'] = 'G_id';
    }
    redirect("../schedule/index.php?s_id={$Schedule_id}");
  }
}

?>