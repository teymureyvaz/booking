<?php
include 'db/db.php';
if (isset($_POST['musteri_id']) && isset($_POST['delete_musteri']) && $_POST['delete_musteri']=='del'){

  $id = $_POST['musteri_id'];
  $sql = "DELETE FROM location WHERE id=?";
  $stmt= $conn->prepare($sql);
  $stmt->execute([$id]);

}
if (isset($_POST['seher_ad'])) {
  $location = $_POST['seher_ad'];
  $status = 1;
    $query = $conn->prepare("INSERT INTO location SET
            location_ad = ?,
            status = ?");
            $insert = $query->execute(array(
             $location,$status));
}
if (isset($_POST['facebook']) || isset($_POST['instagram']) || isset($_POST['twitter']) || isset($_POST['linkedin'])) {
  $facebook = $_POST['facebook'];
  $instagram = $_POST['instagram'];
  $twitter = $_POST['twitter'];
  $linkedin = $_POST['linkedin'];

  $facebook_ad  = 'facebook';
  $instagram_ad = 'instagram';
  $twitter_ad   = 'twitter';
  $linkedin_ad  = 'linkedin';

  if(isset($_POST['facebook']) && $_POST['facebook'] != ''){
    $sql = "UPDATE link_url SET link_url=? WHERE link_ad=?";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$facebook, $facebook_ad]);
  }
  if(isset($_POST['instagram']) && $_POST['instagram'] != ''){
    $sql = "UPDATE link_url SET link_url=? WHERE link_ad=?";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$instagram, $instagram_ad]);
  }
  if(isset($_POST['twitter']) && $_POST['twitter'] != ''){
    $sql = "UPDATE link_url SET link_url=? WHERE link_ad=?";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$twitter, $twitter_ad]);
  }
  if(isset($_POST['linkedin']) && $_POST['linkedin'] != ''){
    $sql = "UPDATE link_url SET link_url=? WHERE link_ad=?";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$linkedin, $linkedin_ad]);
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
                        <h4 class="page-title">Məkanlar</h4>
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
                <div>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Məkan əlavə et
                  </button>
                </div>&nbsp;&nbsp;
                <div>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#linkModal">
                    Link url-ləri əlavə et
                  </button>
                </div>
              </div>

                
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Şəhər adı qeyd edin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="">
                          <div class="form-group">
                            <input class="form-control" type="text" name="seher_ad" placeholder="Şəhər adı">
                          </div>
                        
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Təsdiq et</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal fade" id="linkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Link url-ləri qeyd edin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="">
                          <div class="form-group">
                            <span><b>Facebook</b></span>
                            <input class="form-control" type="text" name="facebook">
                          </div>
                          <div class="form-group">
                            <span><b>Instagram</b></span>
                            <input class="form-control" type="text" name="instagram">
                          </div>
                          <div class="form-group">
                            <span><b>Twitter</b></span>
                            <input class="form-control" type="text" name="twitter">
                          </div>
                          <div class="form-group">
                            <span><b>LinkedIn</b></span>
                            <input class="form-control" type="text" name="linkedin">
                          </div>

                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Təsdiq et</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

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
                          <th scope="col">Id</th>
                          <th scope="col">Məkan</th>
                          <th scope="col">tenzimleme</th>
                        </tr>
                      </thead><br>
                      <tbody>
                        <?php 
                                $select = $conn->query("SELECT * from location");
                                foreach ($select as $cars) {
                                    $musteri_id = $cars['id'];
                                    $musteri_ad = $cars['location_ad'];
                                   

                         ?>
                         <tr>
                             <td scope="row"><?php echo $musteri_id?></td>
                             <td><?php echo $musteri_ad ?></td>
                             <td>
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
                                      Bu məkanı həqiqətən silmək istəyirsiniz mi?
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