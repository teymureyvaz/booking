<?php
include "db/db.php";
/***********form musteri*********/
if (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['location1']) && isset($_POST['location2']) && isset($_POST['date1']) && isset($_POST['date2'])) {


      if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
    
        }
        $secretKey = "6LfFGK8UAAAAACMuTGMLp8E-vy4OmRtM4JIiL8Yv";
        $ip = $_SERVER['REMOTE_ADDR'];
        // post request to server
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);
        // should return JSON with success as true
        if($responseKeys["success"]) {
              $fullname=$_POST['fullname'];
              $email=$_POST['email'];
              $phone=$_POST['phone'];
              $location1=$_POST['location1'];
              $location2=$_POST['location2'];
              $date1=$_POST['date1'];
              $date2=$_POST['date2'];
              $date1 = date('Y-m-d H:i', strtotime($date1));
              $date2 = date('Y-m-d H:i', strtotime($date2));
              $id = $_POST['car_id'];
              $status = 1;
              $create_date=date('Y-m-d');

              $query = $conn->prepare("INSERT INTO musteri SET

                cars_id = ?,
                musteri_ad = ?,
                musteri_mail = ?,
                musteri_tel = ?,
                t_alma_yer = ?,
                t_verme_yer = ?,
                t_alma_tarix = ?,
                t_verme_tarix = ?,
                create_date = ?,
                status = ?");
              $insert = $query->execute(array(
               $id,$fullname,$email,$phone,$location1,$location2,$date1,$date2,$create_date,$status));
                    
        } else {
               echo "query error";
        }


  
}

      ?>
      <html>
      <head>
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="true">
        <link rel="stylesheet" href="index.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="bootstrapt_select/bootstrap-select.min.css">
        <script type="text/javascript" src="bootstrapt_select/bootstrap-select.min.js"></script>

        <script src='https://www.google.com/recaptcha/api.js' async defer></script>


        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <!-- <script type="text/javascript" src="jquery_dd.js"></script>
        <script type="text/javascript" src="jquery_dd_min.js"></script> -->

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        
      </head>
      <body>
        <!-- Header hissesi -->
        <header>
         <div class="header">
          <nav class="navbar navbar-expand-lg  ftco_navbar  ftco-navbar-light" id="ftco-navbar">
            <div class="container" style="margin-top:5%;">
              <a class="navbar-brand" href="index.php"><span> <img src="images/Untitled_43_A0_Rectangle_22_pattern.png" alt=""> </span></a>
              <button class="navbar-toggler" id="toggle-icon" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                 <span>+</span>
              </button>

              <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item active"><a href="#carss" class="nav-link"><h5>Maşınlar</h5></a></li>
                  <li class="nav-item"><a href="#about" class="nav-link"><h5>Haqqımızda</h5></a></li>
                  <li class="nav-item"><a href="#contact" class="nav-link"><h5>Əlaqə</h5></a></li>
                </ul>
              </div>
            </div><br>

          </nav>
          <div class="search-bar col-md-7 pt-2" style="margin-left: auto;margin-right: auto;">
              <form method="POST" action="" >
                
                  <div class="row d-flex justify-content-center" style="background-color: white;padding: 32px; border-radius: 15px;">

                    <div class="col-md-3">
                      <select name="searchmarka" id="searchmarka" class="form-control" style="background-color: #fff;border-radius: 10px;">
                        <option value='' selected disabled hidden>Marka seç</option>
                        <?php
                        $select = $conn->query("SELECT DISTINCT(ad) FROM cars ORDER BY id DESC");
                        $say = $select->rowCount();
                        $count=0;
                        foreach ($select as $row) {
                          echo "<option value='".$row['ad']."'>".$row['ad']."</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <select name="searchmodel" id="searchmodel" class="form-control" style="background-color: #fff;border-radius: 10px;">
                        <option value='' selected disabled hidden>Model seç</option>
                        
                      </select>
                    </div>
                    <div class="col-md-3">
                      <select name="searchnov" id="searchnov" class="form-control" style="background-color: #fff;border-radius: 10px;width: 100%;">
                        <option value='' selected disabled hidden>Transmissiya</option>
                        <option value="Automatic">Auto</option>
                        <option value="Manual">Manual</option>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <input type="button" class="btn btn-warning" id="search" style="width: 100%;border-radius: 10px; font-family: 'Averta' "; value="Axtar">
                    </div>

                  </div>
                
              </form>
            </div>
          </div>
        </header>
        <br>
        <!-- Card hissesi -->   
        <div class="container"> 
        <section id="carss">
          <!-- <center> -->
          <?php if (count($_POST)>0) echo "<div class='row' id='alert-result'>
              <div class='col-sm-12'><div class='alert alert-success'><p class='text-center ' style='font-family: \'Times New Roman\', Times, serif;'>MÜRACİƏTİNİZ QEYDİYYATA ALINDI. YAXIN ZAMAN ƏRZİNDƏ SİZİNLƏ ƏLAQƏ SAXLIYACAYIQ. TƏŞƏKKÜR EDİRİK.</p></div></div>
            </div>"; unset($_POST);?>
            
            <!--   </center> -->
            <div class="contacars" >

              <div id="text" class="pt-3 col-md-6" style="text-align:center;margin:auto;">

              <h2 style="font-family: 'Averta'; font-size: 40px; ">Bütün maşınlar</h2><br>
              <div class="row ourcars">

                <h5 style="text-align:center;margin:auto;">
                  <a href=""><span style="color: black; font-family: 'Averta'; font-size: 20px;">Ən çox istənilən</span></a><span><b> / </b></span>
                  <a href=""><span style="color: black; font-family: 'Averta'; font-size: 20px;">Məşhur maşınlar</span></a><span><b> / </b></span>
                  <a href=""><span style="color: black; font-family: 'Averta'; font-size: 20px;">Ekonomik maşınlar</span></a>
                </h5>

              </div>  

            </div>

              <div class="row" id="cars">
                <?php 
                $select = $conn->query("SELECT  * FROM cars ORDER BY id DESC");
                $say = $select->rowCount();
                $count=1;
                foreach ($select as $row) {
                  $ad      = $row['ad'];
                  $id      = $row['id'];
                  $marka   = $row['marka'];
                  $yanacag = $row['yanacag'];
                  $baqaj   = $row['baqaj'];
                  $tutum   = $row['tutum'];
                  $baqaj   = $row['baqaj'];
                  $nov     = $row['nov'];
                  $image   = $row['photo'];
                  $qiymet  = $row['qiymet'];
                  $mator   = $row['mator'];
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


                

                <?php $count = $count+1; } ?>
                


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

              </div>
              <div class="modal fade text-left bd-example-modal-lg" id="rent" tabindex="-1" role="dialog" aria-labelledby="rent" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header text-center">
                      <div class="pt-3 col-md-11"><h3 style="margin-left: 10%;">Rent form</h3></div>
                      <div class="pt-3 col-md-1">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                      </div>
                    </div>
                    <div class="modal-body">
                      <form action="" method="POST" id="formz" role="form">                                
                        <div class="row">
                          <input type="hidden" name="car_id" id="car_id" value="">
                          <div class="col-md-6 col-sm-6">
                            <div class="form-group"><input type="text" name="fullname" id="fullname" class="form-control form" placeholder="Ad Soyad" required placeholder="Enter Name" oninvalid="this.setCustomValidity('Zəhmət olmasa doldurun')" oninput="this.setCustomValidity('')"></div>
                            <div class="row">
                              <div class="col-md-6 pt-3">
                                <div class="form-group"><input type="text" name="email" id="email" class="form-control form" placeholder="E-mail" required placeholder="Enter Name" oninvalid="this.setCustomValidity('Zəhmət olmasa doldurun')" oninput="this.setCustomValidity('')"></div>
                              </div>
                              <div class="col-md-6 pt-3">
                                <div class="form-group"><input type="text" name="phone" id="phone" class="form-control form" placeholder="Telefon" required placeholder="Enter Name" oninvalid="this.setCustomValidity('Zəhmət olmasa doldurun')" oninput="this.setCustomValidity('')"></div>
                              </div>
                            </div>


                            <div class="row pt-3">

                              <div class="col-md-4 col-4">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                  <input type="checkbox" class="custom-control-input" id="defaultInline1">
                                  <label class="custom-control-label" for="defaultInline1">Sigorta</label>
                                </div>
                              </div>

                              <div class="col-md-4 col-4">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                  <input type="checkbox" class="custom-control-input" id="defaultInline2">
                                  <label class="custom-control-label" for="defaultInline2">Sigorta</label>
                                </div>
                              </div>

                              <div class="col-md-4 col-4">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                  <input type="checkbox" class="custom-control-input" id="defaultInline3">
                                  <label class="custom-control-label" for="defaultInline3">Sigorta</label>
                                </div>
                              </div>

                            </div>
                            <div class="col-12">
                              <div class="form-group pt-3">
                                <div style="height: 80px;border-radius: 15px;background-color: #f2f5f9;">
                                  <div class="row" id="box_masin">
                                    
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>  
                          <div class="col-md-6 col-sm-6">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <select name="location1" id="location1" class="form-control form" required placeholder="Enter Name" oninvalid="this.setCustomValidity('Zəhmət olmasa doldurun')" oninput="this.setCustomValidity('')" style="color: #6f7984">
                                    <option value="" selected="">Götürüləcək yer</option>
                                    <?php
                                    $select1 = $conn->query("SELECT DISTINCT(location_ad) FROM location ORDER BY id DESC");
                                    foreach ($select1 as $row) {
                                      echo "<option value='".$row['location_ad']."'>".$row['location_ad']."</option>";
                                    }
                                    ?>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <select name="location2" id="location2" class="form-control form" required placeholder="Enter Name" oninvalid="this.setCustomValidity('Zəhmət olmasa doldurun')" oninput="this.setCustomValidity('')" style="color: #6f7984">
                                    <option value="" selected="">Qaytarılacaq yer</option>
                                    <?php
                                    $select2 = $conn->query("SELECT DISTINCT(location_ad) FROM location ORDER BY id DESC");
                                    foreach ($select2 as $row) {
                                      echo "<option value='".$row['location_ad']."'>".$row['location_ad']."</option>";
                                    }
                                    ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6 pt-3">
                                <div class="form-group">
                                  <input type="text" name="date1" class="form-control date1 form" placeholder="Götürüləcək tarix">
                                </div>
                              </div>
                              <div class="col-md-6 pt-3">
                                <div class="form-group">
                                  <input type="text" name="date2" class="form-control date2 form" placeholder="Qaytarılacaq tarix">
                                </div>
                              </div>
                            </div>
                            <script>

                              $( function() {
                                $( ".date1" ).datepicker({
                                  onSelect: function() {
                                    var date2 = $('.date1').datepicker('getDate');
                                    var date1 = $('.date1').datepicker('getDate');

                                    date2.setDate(date2.getDate()+3)

                                    $( ".date2" ).datepicker("setDate", date2,);
                                    $(".date2").datepicker( "option", "minDate", date2 );
                                  }
                                });
                              });
                              $( function() {
                                $( ".date2" ).datepicker();
                              }); 
                            </script>
                            <div class="pt-2"></div>
                            <div class="form-group pt-5">
                              <button type="submit" class="btn btn-warning g-recaptcha" data-sitekey="6LfFGK8UAAAAADPuarv9XzCWRD9Vm_FsnS8HzAg9" data-badge="inline" data-callback='onSubmit' style="width: 100%;height: 80px;border-radius: 15px;background-color: #d48e26;color: #ffffff">Rent this car</button>
                            </div>
                          </div>

                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            </section>

          <!-- Haqqimizda -->
          <section id="about">
            <div class="container pt-5">
              <div class="d-flex justify-content-center"><h2>Lorem ipsum simply</h2></div>
              <div class="d-flex justify-content-center"><p class="d-flex justify-content-center pt-3">Lorem ipsum is simply dummy text of the printing typesetting industry</p></div> 
              <div class="row" id="about">
                <div class="col-md-4 pt-5">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="card shadow-nohover pt-5">
                      <div class="card-body">
                        <i class="fa fa-car masin d-flex justify-content-center"></i>
                      </div>
                      <div class="container pt-5" style="padding: 15px;">
                        <h4 class="d-flex justify-content-center">Choose your car</h4>
                        <p class="d-flex justify-content-center pt-3">Lorem ipsum is simply dummy text of</p>
                        <p class="d-flex justify-content-center">the printing typesetting industry</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 pt-5">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="card shadow-nohover pt-5">
                      <div class="card-body">
                        <i class="fa fa-car masin d-flex justify-content-center"></i>
                      </div>
                      <div class="container pt-5" style="padding: 15px;">
                        <h4 class="d-flex justify-content-center">Choose your car</h4>
                        <p class="d-flex justify-content-center pt-3">Lorem ipsum is simply dummy text of</p>
                        <p class="d-flex justify-content-center">the printing typesetting industry</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 pt-5">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="card shadow-nohover pt-5">
                      <div class="card-body">
                        <i class="fa fa-car masin d-flex justify-content-center"></i>
                      </div>
                      <div class="container pt-5" style="padding: 15px;">
                        <h4 class="d-flex justify-content-center">Choose your car</h4>
                        <p class="d-flex justify-content-center pt-3">Lorem ipsum is simply dummy text of</p>
                        <p class="d-flex justify-content-center">the printing typesetting industry</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> 
          </section>

          <!-- Əlaqə hissəsi -->
          <section id="contact">
            <div class="container pt-5">
              <div class="col-md-12 col-sm-12 col-xs-12 pt-5">
                <h2 id="elaqe_vasite">Əlaqə vasitələri</h2>
              </div>
            
              <div class="col-md-12 pt-5">
                <div class="row elaqe">
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-body">
                        <form name="mesaj" id="mesaj" action="" method="POST">
                          <div class="form-group">
                            <input class="form-control" type="text" name="email_elaqe" id="email_elaqe" placeholder="e-mail" required id="doc_type" oninvalid="this.setCustomValidity('E-mailinizi daxil edin')">
                          </div>
                          <div class="form-group">
                            <input class="form-control" type="text" name="phone_elaqe" id="phone_elaqe" placeholder="telefon" required id="doc_type" oninvalid="this.setCustomValidity('Telefon nömrəsizi daxil edin')">
                          </div>
                          <div class="form-group">
                            <textarea class="form-control" placeholder="mesaj" name="textarea" id="textarea" required id="doc_type" oninvalid="this.setCustomValidity('Əlaqə səbəbinizi bildirin')"></textarea>
                          </div>  
                          <div class="form-group">
                            <input type="button" class="btn btn-warning" name="elaqe_gonder" id="elaqe_gonder" style="width: 100%;" value="Göndər">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div><br>
                  <div class="col-md-6 pt-3" style="padding-left: 10%;">
                    <h4><b>Location</b></h4>
                    <p class="pt-3">Cəfər Cəbbarlı küç., 609 
                      "Globus Center"
                      AZ1010, Azərbaycan, Bakı ş.
                    </p>
                    <h4 class="pt-3"><b>Əlaqə nömrəsi</b></h4>
                    <p class="pt-3"> (+994) 55 123 45 67
                    </p>
                    <h4 class="pt-3"><b>Mail</b></h4>
                    <p class="pt-3"> nümünə@nümünə.com
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </section>

        </div>


         <footer>
           <div style="background-color: #30303A; color: #fff">
              <div class="container">
                <div class="row pt-5">
                  <div class="col-lg-6 col-md-12 col-sm-12 col-12" style="margin-left:auto;margin-right:auto;">
                    <div class="pt-3">
                      <div class="row">
                        <div class="col-md-2 col-2"></div>
                          <?php
                            $select_link = $conn->query("SELECT * FROM link_url ORDER BY id DESC");
                            foreach ($select_link as $row) {
                              echo  '<div class="col-md-2 col-2">
                                      <a href="'.$row["link_url"].'"><i class="'.$row["icon"].'" style="color: #fff!important;"></i></a>
                                    </div>';
                            }
                          ?>

                        <div class="col-md-2 col-2"></div>  
                      </div>
                    </div>
                  </div>
              </div>
              <hr style="border: 1px solid #fff">
              <div class="text-center" style="margin-right: 5%;">
                All rights reserved.All rights reserved.
              </div>
              <div class="pt-3">
                
              </div>
              </div>
           </div>
         </footer>


        </body>

<script type="text/javascript">
  
  function rentform(id) {
    $('#car_id').val(id);

    $.post('load_more.php', { 'id':id}, function( data ) {
        $('#box_masin').html(data);
    });

  }
   
   function onSubmit(token) {
         document.getElementById("formz").submit();
       }
          
    /* Azerbaijani (UTF-8) initialisation for the jQuery UI date picker plugin. */
    ( function( factory ) {
      if ( typeof define === "function" && define.amd ) {

        // AMD. Register as an anonymous module.
        define( [ "../widgets/datepicker" ], factory );
      } else {

        // Browser globals
        factory( jQuery.datepicker );
      }
    }( function( datepicker ) {

    datepicker.regional.az = {
      closeText: "Bağla",
      prevText: "&#x3C;Geri",
      nextText: "İrəli&#x3E;",
      currentText: "Bugün",
      monthNames: [ "Yanvar","Fevral","Mart","Aprel","May","İyun",
      "İyul","Avqust","Sentyabr","Oktyabr","Noyabr","Dekabr" ],
      monthNamesShort: [ "Yan","Fev","Mar","Apr","May","İyun",
      "İyul","Avq","Sen","Okt","Noy","Dek" ],
      dayNames: [ "Bazar","Bazar ertəsi","Çərşənbə axşamı","Çərşənbə","Cümə axşamı","Cümə","Şənbə" ],
      dayNamesShort: [ "B","Be","Ça","Ç","Ca","C","Ş" ],
      dayNamesMin: [ "B","B","Ç","С","Ç","C","Ş" ],
      weekHeader: "Hf",
      dateFormat: "dd.mm.yy",
      firstDay: 1,
      isRTL: false,
      showMonthAfterYear: false,
      yearSuffix: "" };
    datepicker.setDefaults( datepicker.regional.az );

    return datepicker.regional.az;

    } ) );

        setTimeout(function () {
             $('#alert-result').hide(800);
        }, 30000);  

      $('#searchmarka').change(function() {
        var marka = $('#searchmarka').val();
        $.post('load_more.php', { 'marka':marka}, function( data ) {
            $('#searchmodel').html(data);
        });
      });   
      
      $("#search").click(function(){
        var nov = $('#searchnov').val();
        var searchmarka = $('#searchmarka').val();
        var searchmodel = $('#searchmodel').val();
        
        if(nov=='' && searchmarka=='' && searchmodel==''){
          window.location.href = 'index.php';
        }
        else{
          $.post('serchbox.php', { 'nov':nov,'searchmarka': searchmarka,'searchmodel':searchmodel}, function( data ) {
            $('#cars').html(data);
          });
        }
      });                               
      $('#elaqe_gonder').on('click', function() {
        
        var email = $('#email').val();
        var phone = $('#phone').val();
        var textarea = $('#textarea').val();
        if(email=='' && phone=='' && textarea==''){
          swal("Zəhmət olmasa bütün xanaları doldurun","","error");
          
        }else{
          //alert("OLDU");
          swal("Tezliklə sizinlə əlaqə saxlanılacaq","","success");
        }
      });  
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>

