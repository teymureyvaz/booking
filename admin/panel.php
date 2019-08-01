<?php
include 'db/db.php';
if (isset($_POST['musteri_id']) && isset($_POST['delete_musteri']) && $_POST['delete_musteri']=='del'){

  $id = $_POST['musteri_id'];
  $sql = "DELETE FROM musteri WHERE musteri_id=?";
  $stmt= $conn->prepare($sql);
  $stmt->execute([$id]);

}
if (isset($_POST['musteri_id']) && isset($_POST['update_musteri']) && $_POST['update_musteri']=='update') {
  $status = '2';
  $id = $_POST['musteri_id'];
  $sql = "UPDATE musteri SET status=? WHERE musteri_id=?";
  $stmt= $conn->prepare($sql);
  $stmt->execute([$status, $id]);
}

?>

    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

        <?php include "header.php"; ?>

        <?php include "sidebar.php"; ?>

        <div class="page-wrapper" style="overflow: scroll;">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Ana səhifə</h4>
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

                <div class="row">
                    <div class="col-md-8">
                    </div>
                </div>
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="pt-3">
                    <table id="example2" class="display" style="width:100%">
                      <thead>
                        <tr>
                          <th scope="col">fullname</th>
                          <th scope="col">phone</th>
                          <th scope="col">t.alma yer</th>
                          <th scope="col">t.verme yer</th>
                          <th scope="col">t.alma tarix</th>
                          <th scope="col">t.verme tarix</th>
                          <th scope="col">muraciet_tarix</th>
                          <th scope="col">secdiyi masin</th>
                          <th scope="col">marka</th>
                          <th scope="col">qiymet</th>
                          <th scope="col">tenzimleme</th>
                        </tr>
                      </thead><br>
                      <tbody>
                        <?php 
                                $select = $conn->query("SELECT m.musteri_id,m.musteri_ad,m.musteri_mail,m.musteri_tel,m.t_alma_yer,m.t_verme_yer,m.t_alma_tarix,m.t_verme_tarix,m.create_date,m.status,c.ad,c.marka,c.qiymet from musteri m,cars c where m.cars_id=c.id");
                                foreach ($select as $cars) {
                                    $musteri_id = $cars['musteri_id'];
                                    $musteri_ad = $cars['musteri_ad'];
                                    $musteri_mail = $cars['musteri_mail'];
                                    $musteri_tel = $cars['musteri_tel'];
                                    $t_alma_yer = $cars['t_alma_yer'];
                                    $t_verme_yer = $cars['t_verme_yer'];
                                    $t_alma_tarix = $cars['t_alma_tarix'];
                                    $t_verme_tarix = $cars['t_verme_tarix'];
                                    $create_date = $cars['create_date'];
                                    $ad = $cars['ad'];
                                    $marka = $cars['marka'];
                                    $qiymet = $cars['qiymet'];
                                    $status = $cars['status'];
                               if($status==2){
                              ?>
                                <tr id="<?php echo $musteri_ad ?>" class="table table-success">
                              <?php    
                               }
                               else{
                              ?>
                                <tr id="<?php echo $musteri_ad ?>">
                              <?php
                               }     
                              ?>

                         
                             <td scope="row"><?php echo $musteri_ad ?></td>
                             <td><?php echo $musteri_tel ?></td>
                             <td><?php echo $t_alma_yer ?></td>
                             <td><?php echo $t_verme_yer ?></td>
                             <td><?php echo $t_alma_tarix ?></td>
                             <td><?php echo $t_verme_tarix ?></td>
                             <td><?php echo $create_date ?></td>
                             <td><?php echo $ad ?></td>
                             <td><?php echo $marka ?></td>
                             <td><?php echo $qiymet ?></td>
                             <td align="center">
                             <button class="btn btn-primary" data-toggle="modal" data-target="#update<?php echo $musteri_id; ?>"><i class="fa fa-cog"></i></button>
                             <div class="modal fade" id="update<?php echo $musteri_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Tənzimləmə</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      Sifarişi aktivləşdirmək istəyirsinizmi?
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <form method="POST" action="">
                                        <input type="hidden" name="musteri_id" value="<?php echo $musteri_id; ?>">
                                        <input type="hidden" name="update_musteri" value="update">
                                        <button type="submit" class="btn btn-primary">Təsdiqlə</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                             <button class="btn btn-danger" data-toggle="modal" data-target="#delete<?php echo $musteri_id; ?>"><i class="fa fa-trash"></i></button>
                             <div class="modal fade" id="delete<?php echo $musteri_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      Bu müştərini həqiqətən silmək istəyirsiniz mi?
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <form method="POST" action="">
                                        <input type="hidden" name="musteri_id" value="<?php echo $musteri_id; ?>">
                                        <input type="hidden" name="delete_musteri" value="del">
                                        <button type="submit" class="btn btn-primary">Sil</button>
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
                </div>
            </div>

           <?php include "footer.php"; ?>