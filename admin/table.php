<?php 
include "db/db.php"; 
/**********INSERT**********/
if (isset($_POST['insert'])) {
        
        $adi=$_POST['adi'];
        $markasi=$_POST['markasi'];
        $novu=$_POST['novu'];
        $tutum=$_POST['tutum'];
        $mator=$_POST['mator'];
        $yanacag=$_POST['yanacag'];
        $baqaj=$_POST['baqaj'];
        $qiymet=$_POST['qiymet'];
        $status='B';
        $image = $_FILES['photo']['name'];

        /*echo $image;*/
        /*$target = "img/cars_photo/".basename($image);
        
        if(move_uploaded_file($_FILES['photo']['tmp_name'], $target)){
            $query = $conn->prepare("INSERT INTO cars SET
            
            marka = ?,
            ad = ?,
            nov = ?,
            tutum = ?,
            mator = ?,
            yanacag = ?,
            baqaj = ?,
            qiymet = ?,
            photo = ?,
            status = ?");
            $insert = $query->execute(array(
             $markasi,$adi,$novu,$tutum,$mator,$yanacag,$baqaj,$qiymet,$image,$status));
        }*/
}
/**********DELETE**********/
if (isset($_POST['car_id']) && isset($_POST['delete_car']) && $_POST['delete_car']=='del'){
  $status = 'S';
  $id = $_POST['car_id'];
  $sql = "UPDATE cars SET status=? WHERE id=?";
  $stmt= $conn->prepare($sql);
  $stmt->execute([$status, $id]);
}
/**********EDIT**********/
/*var_dump($_POST);*/
if (isset($_POST['edit_cars']) && isset($_POST['edit_id'])) {

    $edit_id      = $_POST['edit_id'];
    $edit_markasi = $_POST['edit_markasi'];
    $edit_adi     = $_POST['edit_adi'];
    $edit_novu    = $_POST['edit_novu'];
    $edit_tutum   = $_POST['edit_tutum'];
    $edit_mator   = $_POST['edit_mator'];
    $edit_yanacag = $_POST['edit_yanacag'];
    $edit_baqaj   = $_POST['edit_baqaj'];
    $edit_qiymet  = $_POST['edit_qiymet'];
    $edit_status  = $_POST['edit_status'];

  if(empty($_FILES['edit_sekil']['name'])){

          if(isset($edit_status)){
            $query = "UPDATE cars SET
            marka = ?,
            ad = ?,
            nov = ?,
            tutum = ?,
            mator = ?,
            yanacag = ?,
            baqaj = ?,
            qiymet = ?, 
            status = ? WHERE id=?";

            $stmt= $conn->prepare($query);
            $stmt->execute([$edit_markasi,$edit_adi,$edit_novu,$edit_tutum,$edit_mator,$edit_yanacag,$edit_baqaj,$edit_qiymet,$edit_status,$edit_id]);
          }
          else{
            $query = "UPDATE cars SET
            marka = ?,
            ad = ?,
            nov = ?,
            tutum = ?,
            mator = ?,
            yanacag = ?,
            baqaj = ?,
            qiymet = ? WHERE id=?";

            $stmt= $conn->prepare($query);
            $stmt->execute([$edit_markasi,$edit_adi,$edit_novu,$edit_tutum,$edit_mator,$edit_yanacag,$edit_baqaj,$edit_qiymet,$edit_id]);
          }  
  }  
  elseif(isset($_FILES['edit_sekil']['name'])){
    $edit_sekil   = $_FILES['edit_sekil']['name'];
    $target = "img/cars_photo/".basename($edit_sekil);
        
        if(isset($edit_status)){

            if(move_uploaded_file($_FILES['edit_sekil']['tmp_name'], $target)){
                $query2 = "UPDATE cars SET
                marka = ?,
                ad = ?,
                nov = ?,
                tutum = ?,
                mator = ?,
                yanacag = ?,
                baqaj = ?,
                qiymet = ?,
                photo = ?, 
                status = ? WHERE id=?";

                $stmt= $conn->prepare($query2);
                $stmt->execute([$edit_markasi,$edit_adi,$edit_novu,$edit_tutum,$edit_mator,$edit_yanacag,$edit_baqaj,$edit_qiymet,$edit_sekil,$edit_status,$edit_id]);
            }

        }
        else{ 

            if(move_uploaded_file($_FILES['edit_sekil']['tmp_name'], $target)){
                $query2 = "UPDATE cars SET
                marka = ?,
                ad = ?,
                nov = ?,
                tutum = ?,
                mator = ?,
                yanacag = ?,
                baqaj = ?,
                qiymet = ?,
                photo = ? WHERE id=?";

                $stmt= $conn->prepare($query2);
                $stmt->execute([$edit_markasi,$edit_adi,$edit_novu,$edit_tutum,$edit_mator,$edit_yanacag,$edit_baqaj,$edit_qiymet,$edit_sekil,$edit_id]);
            }

        }  
  }


}
?>


    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

       <?php include "header.php"; ?>

        <?php include "sidebar.php"; ?>
       
      <div class="page-wrapper" style="overflow: scroll;">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Cədvəl</h4>
                    </div>
                    <div class="col-7">
                        <div class="text-right upgrade-btn">
                            <button class="btn btn-danger" id="cixis">Çıxış</button>
                        </div>
                        <script type="text/javascript">
                            $('#cixis').click(function() {
                                document.location.href='http://localhost/rentcar/admin/logout.php';
                            });
                        </script>
                    </div>
                </div>
            </div>
            <hr>
            <div class="container-fluid">
                <!-- <button class="btn btn-success" style="border-radius: 10px;">Maşın əlavə et</button> -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                  Maşın əlavə et
                </button>

                <!-- Modal -->
                <div class="modal fade text-left bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header text-center">
                        <div class="pt-3 col-11"><h4 id="exampleModalLongTitle">Yeni maşın əlavə et</h4></div>
                        <div class="pt-3 col-1">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                        </div>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="table.php" id="formz" enctype="multipart/form-data" onsubmit="event.preventDefault();" style="font-weight: bold;">
                          <div class="col-12">
                            <div class="row">
                              <div class="col-md-4">  
                                <div class="form-group">
                                  <span>Adı</span>
                                  <input class="form-control" type="text" name="adi">
                                </div>
                                <div class="form-group">
                                  <span>Tutum</span>
                                  <input class="form-control" type="text" name="tutum">
                                </div>
                                <div class="form-group">
                                  <span>Baqaj</span>
                                  <input class="form-control" type="number" name="baqaj">
                                </div>
                              </div>
                              
                              <div class="col-md-4">
                                <div class="form-group">
                                  <span>Markası</span>
                                  <input class="form-control" type="text" name="markasi">
                                </div>
                                <div class="form-group">
                                  <span>Mator</span>
                                  <input class="form-control" type="text" name="mator">
                                </div>
                                <div class="form-group">
                                  <span>Qiymət</span>
                                  <input class="form-control" type="number" name="qiymet">
                                </div>
                              </div>

                              <div class="col-md-4">
                                <div class="form-group">
                                  <span>Transmission növü</span>
                                  <select class="form-control" name="novu">
                                    <option value="0">Transmission</option>
                                    <option value="auto">auto</option>
                                    <option value="manual">manual</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <span>Yanacağ</span>
                                  <input class="form-control" type="text" name="yanacag">
                                </div>
                                <div class="form-group">
                                  <label for="file">Şəkil əlavə et</label>
                                  <input type="file" name="photo" class="image" width="360" height="250" />
                                </div>
                              </div>  
                            </div>  
                          </div>
                          <center><input type="submit" id="submit_insert" class="btn btn-success img-validater" name="insert" style="max-width: 50%;" value="submit"></center>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="pt-3">
                   <table id="example" class="display dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
                      <thead>
                        <tr>
                          <th scope="col">marka</th>
                          <th scope="col">ad</th>
                          <th scope="col">nov</th>
                          <th scope="col">tutum</th>
                          <th scope="col">mator</th>
                          <th scope="col">yanacag</th>
                          <th scope="col">baqaj</th>
                          <th scope="col">qiymet</th>
                          <th scope="col">status</th>
                          <th scope="col">id</th>
                          <th scope="col">tenzimleme</th>
                        </tr>
                      </thead><br>
                      <tbody>
                        <?php 
                                $select = $conn->query("SELECT * FROM cars");
                                foreach ($select as $cars) {
                                    $id      = $cars['id'];
                                    $marka   = $cars['marka'];
                                    $ad      = $cars['ad'];
                                    $nov     = $cars['nov'];
                                    $tutum   = $cars['tutum'];
                                    $mator   = $cars['mator'];
                                    $yanacag = $cars['yanacag'];
                                    $baqaj   = $cars['baqaj'];
                                    $qiymet  = $cars['qiymet'];
                                    $status  = $cars['status'];
                                    $photo   = $cars['photo'];
                         ?>
                         <tr>
                             <td scope="row"><?php echo $marka ?></td>
                             <td><?php echo $ad ?></td>
                             <td><?php echo $nov ?></td>
                             <td><?php echo $tutum ?></td>
                             <td><?php echo $mator ?></td>
                             <td><?php echo $yanacag ?></td>
                             <td><?php echo $baqaj ?></td>
                             <td><?php echo $qiymet ?></td>
                             <td><?php echo $status ?></td>
                             <td><?php echo $id ?></td>
                             <td>
                             <button class="btn btn-danger" onclick="delete_row(this.id)" data-toggle="modal" data-target="#delete<?php echo $id; ?>"><i class="fa fa-trash"></i></button>
                              <div class="modal fade" id="delete<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Tənzimləmə</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      Bu maşını həqiqətən silmək istəyirsiniz mi?
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <form method="POST" action="">
                                        <input type="hidden" name="car_id" value="<?php echo $id; ?>">
                                        <input type="hidden" name="delete_car" value="del">
                                        <button type="submit" class="btn btn-primary">Sil</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                             <button class="btn btn-primary" onclick="edit_row(this.id)" data-toggle="modal" data-target="#edit<?php echo $id; ?>"><i class="fa fa-cog"></i></button>
                              <div class="modal fade" id="edit<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title" id="exampleModalLabel">Redaktə et</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <form method="POST" action="table.php" id="formz" enctype="multipart/form-data" style="font-weight: bold;">
                                              <div class="form-group">
                                                  <span>Markası</span>
                                                  <input class="form-control" type="text" name="edit_markasi" placeholder="markası" value="<?php echo $marka ?>">
                                              </div>
                                              <div class="form-group">
                                                  <span>Adı</span>
                                                  <input class="form-control" type="text" name="edit_adi" placeholder="adı" value="<?php echo $ad ?>">
                                              </div>
                                              <div class="form-group">
                                                  <span>Növü</span>
                                                  <input class="form-control" type="text" name="edit_novu" placeholder="növü" value="<?php echo $nov ?>">
                                              </div>
                                              <div class="form-group">
                                                  <span>Tutum</span>
                                                  <input class="form-control" type="text" name="edit_tutum" placeholder="tutum" value="<?php echo $tutum ?>">
                                              </div>
                                              <div class="form-group">
                                                  <span>Mator</span>
                                                  <input class="form-control" type="text" name="edit_mator" placeholder="mator" value="<?php echo $mator ?>">
                                              </div>
                                              <div class="form-group">
                                                  <span>Yanacağ</span>
                                                  <input class="form-control" type="text" name="edit_yanacag" placeholder="yanacağ" value="<?php echo $yanacag ?>">
                                              </div>
                                              <div class="form-group">
                                                  <span>Baqaj</span>
                                                  <input class="form-control" type="number" name="edit_baqaj" placeholder="baqaj" value="<?php echo $baqaj ?>">
                                              </div>
                                              <div class="form-group">
                                                  <span>Qiymət</span>
                                                  <input class="form-control" type="number" name="edit_qiymet" placeholder="qiymət" value="<?php echo $qiymet ?>">
                                              </div>
                                              <div class="form-group">
                                                  <span>Status</span>
                                                  <select class="form-control" name="edit_status">
                                                    <option value="">Statusu</option>
                                                    <option value="M">Müştəridə</option>
                                                    <option value="B">Boşda</option>
                                                  </select>
                                              </div>
                                              <div class="form-group">
                                                <span>Şəkil əlavə et</span>
                                                <input type="file" name="edit_sekil" class="image" width="360" height="250">
                                              </div>
                                                <input type="hidden" name="edit_id" value="<?php echo $id; ?>">
                                                <input type="hidden" name="edit_cars" value="edit">
                                              <div class="form-group">
                                                <input type="submit" class="form-control btn btn-success img-validater" name="edit" style="max-width: 100%;" value="Təsdiqlə">
                                              </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                             </td>
                          </tr>   
                            
                  <?php } ?>
                  </tbody>
                    </table>
                </div>
            </div>
           
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        
                    </div>
                </div>
            </div>
            <script>

              $("#submit_insert").click(function(event){
                  var file = document.getElementsByName('photo')[0].files[0];

                  console.log(file);
                   if(file && file.size < 2000000) { // 10 MB (this size is in bytes)
                      var form = document.getElementById("formz");
                      if( file ) {
                            var img = new Image();

                            img.src = window.URL.createObjectURL( file );

                            img.onload = function() {
                                var width = img.naturalWidth,
                                    height = img.naturalHeight;
                                console.log(height);

                                window.URL.revokeObjectURL( img.src );

                                if( width < 300 && height < 200 ) {
                                      
                                        var isValid = file.type.match('image/png'); 
                                          if (!isValid) {
                                            alert('Şəkilin formatı PNG formatında olmalıdır');
                                          } else{
                                            form.submit();
                                          }
                                }
                                else {
                                    alert('Şəkil 300x200-dən çox olmamalıdır');
                                }
                            };
                        }
                        else { //No file was input or browser doesn't support client side reading
                            form.submit();
                        }
                    
                      console.log(width);
                      console.log(height);                           
                  } else {
                      //Prevent default and display error
                      event.preventDefault();
                      alert("Seçilmiş şəkil maksimum 2MB olmalıdır");                  }
              })
            </script>
            <?php include "footer.php"; ?>