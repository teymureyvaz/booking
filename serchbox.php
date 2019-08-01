<?php
include 'db/db.php';
  if (isset($_POST['nov']) || isset($_POST['searchmarka']) || isset($_POST['searchmodel'])) {
    
    if(isset($_POST['nov']) && empty($_POST['searchmarka']) && empty($_POST['searchmodel'])){
      
      $select = $conn->query("select * from cars where nov='".$_POST['nov']."' ");
    
    }
    elseif (empty($_POST['nov']) && isset($_POST['searchmarka']) && isset($_POST['searchmodel'])) {
      
      $select = $conn->query("select * from cars where ad='".$_POST['searchmarka']."' and marka='".$_POST['searchmodel']."' ");

    }
    elseif (empty($_POST['nov']) && isset($_POST['searchmarka']) && empty($_POST['searchmodel'])) {
      
      $select = $conn->query("select * from cars where ad='".$_POST['searchmarka']."' ");

    }
    elseif (isset($_POST['nov']) && isset($_POST['searchmarka']) && empty($_POST['searchmodel'])) {
      
      $select = $conn->query("select * from cars where nov='".$_POST['nov']."' and ad='".$_POST['searchmarka']."' ");

    }
    elseif(isset($_POST['nov']) && isset($_POST['searchmarka']) && isset($_POST['searchmodel'])){
      
      $select = $conn->query("select * from cars where nov='".$_POST['nov']."' and ad='".$_POST['searchmarka']."' and marka='".$_POST['searchmodel']."' ");
    
    }
    

        
        $say = $select->rowCount();
        $count=1;
        foreach ($select as $row) {
          $ad = $row['ad'];
          $id = $row['id'];
          $marka = $row['marka'];
          $yanacag = $row['yanacag'];
          $baqaj = $row['baqaj'];
          $tutum = $row['tutum'];
          $baqaj = $row['baqaj'];
          $nov = $row['nov'];
          $image = $row['photo'];
          $qiymet = $row['qiymet'];
          $mator = $row['mator'];
         ?>
         <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 pt-5 card_car" id="car<?php echo $count ?>">
                    <div class="card mb-4 shadow-sm">
                      <div class="card shadow-nohover" style="color:gray;border: 0.01rem solid rgba(0,0,0,.2);">
                        <img class="card-img-top top_card img-responsive" src="admin/img/cars_photo/<?php echo $image ?>" alt="<?php echo $ad ?>">
                        <div class="card-body">
                         <div class="row d-flex justify-content-center">
                          <div class="card-title text-center">
                            <h5><small><b><a href="javascript:void(0);" class="small_a"><?php echo $ad; ?></a></b></small></h5>
                          </div>&nbsp;
                          <div class="card-title text-center">
                            <h5><small><b class="small_a"><?php echo $marka; ?></b></small></h5>
                          </div>
                        </div>


                        <div class="row pt-3">
                          <div class="col-6">
                            <b>Qiymət</b>
                          </div>
                          <div class="col-6 ">
                            <div class="d-flex justify-content-center days"><?php echo $qiymet ?>₼/gün</div>
                          </div>
                        </div>
                        <div class="row pt-2">
                          <div class="col-6">
                             <div style="font-size: 14px;"><img src="img/icon/kişi.svg"></i><span> &nbsp;<?php echo $tutum ?> Nəfər</span></div>
                          </div>
                          <div class="col-6 ">
                            <div style="font-size: 14px;"><img src="img/icon/karopka.svg"></i><span>&nbsp;&nbsp;<?php echo $nov ?></span></div>
                          </div>
                        </div>
                        <div class="row pt-2">
                          <div class="col-6">
                            <div style="font-size: 14px;"><img src="img/icon/bagas.svg"><span> &nbsp;<?php echo $baqaj ?> Baqaj</span></div>
                          </div>
                          <div class="col-6 ">
                            <div style="font-size: 14px;"><img src="img/icon/benzin.svg"><span>&nbsp;<?php echo $yanacag ?></span></div>
                          </div>
                        </div>
                      </div>
                        <input type="hidden" name="salam" id="salam" value="<?php echo $say ?>">
                        <div class="container" style="padding: 15px;">
                          <button class="btn btn-warning form-control cardbutton" onclick="rentform(this.id)" id="<?php echo $id ?>" data-toggle="modal" data-target="#rent">Kirayəyə götür</button>
                        </div>
                      </div>
                    </div>
                  </div>


        <?php $count++;
      }
      ?>


      <div class="col-md-12 pt-5">
        <div class="row">

          <div class="col-md-3"><h5><span style="font-family: 'Averta'; " >Nəticə sayı: <strong style="color: #d1ac68"><?php echo $say; ?></strong></div>
            <div class="col-md-6"></div>
            <div class="col-md-3" id="readmorebutton">

              <div class="row">
                <div class="col-md-7">
                  <h5 style="font-family: 'Averta'; " >Daha çox:</h5>
                </div>

                <div class="col-md-5">
                  <span id="clickmore" style="cursor: pointer;" > <img src="img/icon/arrow-right.svg" ></span>
                </div>

              </div>

            </div>
          </div>
          </div>
                <script>
                  $(document).ready(function(){
                    $("#readmorebutton").hide();
                    var maxrow = "<?php echo $say ?>";
                    var count = "<?php echo $count ?>";

                    var length = 6;
                    if(count > length){
                      
                      $("#readmorebutton").show();
                     
                      for (var i = length+1; i <= count; i++) {
                        
                        $("#car"+i+"").hide();
                      }
                      
                    }
                    $("#clickmore").click(function(){
                        
                        length=length+6;
                        
                          for (var i=0; i<length+1 ;i++) {
                              $("#car"+i+"").show();
                          }
                          for (var i = length+1; i<=count; i++) {
                            
                            $("#car"+i+"").hide();
                          }
                        
                    });
                    

                  });  
                  
                </script>
<?php }

  
  
?>