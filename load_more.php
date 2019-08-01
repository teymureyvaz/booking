<?php
include 'db/db.php';
if (isset($_POST['id'])) {
  $select = $conn->query("SELECT * FROM cars WHERE id='".$_POST['id']."' ");
  foreach ($select as $row) {
    $photo = $row['photo'];
    $ad    = $row['ad'];
    $marka = $row['marka'];
    $mator = $row['mator'];
    $qiymet =  $row['qiymet'];
    $photo2='admin/img/cars_photo/'.$photo;
    
    echo '<div class="col-4" style="margin-left: 5px;margin-top: 8px;">
            <img class="card-img-top icon_image img-responsive" src="admin/img/cars_photo/'.$photo.'">
          </div>
          <div class="col-7" style="margin-left: 5px;margin-top: 12px;">
            <div>
            <h6 style="color: #707070;"> '.$ad.' &nbsp;'.$marka.'&nbsp;'.$mator.'</h6>
            </div>
            <div>
            <p style="font-size: 12px; color: #707070;opacity: 0.5;">Günü&nbsp;<span id="masin_qiymet"></span>&nbsp;₼-dən başlayaraq</p>
            </div>
          </div>';
    
  }
  
}

if (isset($_POST['marka'])){
  $result='<option  value="" selected disabled hidden>Model seç</option>';
    $select = $conn->query("SELECT marka FROM cars WHERE ad='".$_POST['marka']."' ");
    foreach ($select as $row) {
      $marka = $row['marka'];
      $result.=  '<option value="'.$row['marka'].'" >'.$row['marka'].'</option>'; 
    }
    echo $result;
}

?>