<?php
session_start();
$pagename = "Home";
require('config.php');
require('lib/cek_session.php');
$cekvisitor = mysqli_num_rows(mysqli_query($conn, "SELECT visitor_id FROM visitor"));
$cekskill = mysqli_num_rows(mysqli_query($conn, "SELECT skill_id FROM skill"));
$ceksosmed = mysqli_num_rows(mysqli_query($conn, "SELECT sosmed_id FROM sosmed"));
$cekpesan = mysqli_num_rows(mysqli_query($conn, "SELECT pesan_id FROM pesan"));
$cekpesanunread = mysqli_num_rows(mysqli_query($conn, "SELECT pesan_id FROM pesan WHERE status_read='no'"));
$respon = " ";
if (isset($_GET['delete'])) {
  $y = protek($_GET['delete']);
   $dell = mysqli_query($conn, "DELETE FROM pesan WHERE pesan_id='$y' ");
   if ($dell == false) {
    $respon = '<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button><b>Gagal</b> Sepertinya Ada Yang Salah
    </div>';
  }else {
    $respon = '<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button><b>Sukses</b> Data Berhasil Di Hapus
    </div>';
  }

}


include('lib/header.php');
?>
      <!-- Modal-->
      <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 id="exampleModalLabel" class="modal-title">Pesan Masuk</h4>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <div class="modal-data"></div>
            </div>
            <div class="modal-footer">
              <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Modal -->
      
        <div class="container-fluid px-xl-5">
          <section class="py-5">
            <div class="row">
              <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                  <div class="flex-grow-1 d-flex align-items-center">
                    <div class="dot mr-3 bg-violet"></div>
                    <div class="text">
                      <h6 class="mb-0">Unique Visitor</h6><span class="text-gray"><?= $cekvisitor; ?></span>
                    </div>
                  </div>
                  <div class="icon text-white bg-violet"><i class="fas fa-eye"></i></div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                  <div class="flex-grow-1 d-flex align-items-center">
                    <div class="dot mr-3 bg-green"></div>
                    <div class="text">
                      <h6 class="mb-0">Skill</h6><span class="text-gray"><?= $cekskill; ?></span>
                    </div>
                  </div>
                  <div class="icon text-white bg-green"><i class="fas fa-lightbulb"></i></div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                  <div class="flex-grow-1 d-flex align-items-center">
                    <div class="dot mr-3 bg-blue"></div>
                    <div class="text">
                      <h6 class="mb-0">Sosmed</h6><span class="text-gray"><?= $ceksosmed; ?></span>
                    </div>
                  </div>
                  <div class="icon text-white bg-blue"><i class="fa fa-tags"></i></div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                  <div class="flex-grow-1 d-flex align-items-center">
                    <div class="dot mr-3 bg-red"></div>
                    <div class="text">
                      <h6 class="mb-0">Pesan</h6><span class="text-gray"><?= $cekpesan; ?></span>
                    </div>
                  </div>
                  <div class="icon text-white bg-red"><i class="fa fa-envelope"></i></div>
                </div>
              </div>
            </div>
            
          </section>
          <section>
             <!-- Basic Form-->
             <div class="col-lg-12 mb-4">
                <div class="card">
                  <div class="card-header">
                    <h6 class="text-uppercase mb-0">Pesan Masuk<span style="font-size: 12px;" class="text-success"><?php if ($cekpesanunread >= 1) echo "(+$cekpesanunread)"; ?></span></h6>
                  </div>
                  <div class="card-body"> 
                    <?=$respon;?>
                  <div class="table-responsive-sm">                        
                    <table class="table table-striped table-hover card-text">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nama</th>
                     
                          <th>Mail</th>
                          <th>Waktu</th>
                          <th>Action</th>
                        </tr>
                      </thead>
<?php
// start paging config
$query_list = "SELECT * FROM pesan ORDER BY pesan_id DESC";
$records_per_page = 10; // edit

$starting_position = 0;
if(isset($_GET["page_no"])) {
	$starting_position = ($_GET["page_no"]-1) * $records_per_page;
}
$new_query = $query_list." LIMIT $starting_position, $records_per_page";
$new_query = mysqli_query($conn, $new_query);
// end paging config

$no = 1;
while($data = mysqli_fetch_assoc($new_query)){
?>
                      <tbody>
                        <tr>
                        <td><?= $no; ?></td>
                        <td><?= $data['nama_pengirim'];?></td>
                        <td><?= $data['mail_pengirim'];?></td>
                      
                        <td><?= $data['waktu'];?></td>
                        <td>
                          <form action="" method="get">
                          <button type="button" class="btn btn-success btn-sm" style="padding: 2px 19px;" data-toggle="modal" data-target="#myModal" data-id="<?= $data['pesan_id']; ?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
                          <button name="delete" value="<?= $data['pesan_id']; ?>" class="btn btn-danger btn-sm" style="padding: 2px 20px; margin:2px"><i class="fa fa-trash" aria-hidden="true"></i></button>
                          </form>
                        </td>
                        </tr>
                      </tbody>

<?php
$no++;
 } ?>
                    </table>

                    <ul class="pagination">
                    <?php
// start paging link
$self = $_SERVER['PHP_SELF'];
$query_list = mysqli_query($conn, $query_list);
$total_records = mysqli_num_rows($query_list);
if ($total_records > 11) {
  

echo "<li class='page-item disabled'><a class='page-link' href='#'>".$total_records."</a></li>";
if($total_records > 0) {
	$total_pages = ceil($total_records/$records_per_page);
	$current_page = 1;
	if(isset($_GET["page_no"])) {
		$current_page = protek($_GET["page_no"]);
		if ($current_page < 1) {
			$current_page = 1;
		}
	}
	if($current_page > 1) {
		$previous = $current_page-1;
		//echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=1'>First</a></li>";
		echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=".$previous."'>Previous</a></li>";
	}
	// limit page
	$limit_page = $current_page+3;
	$limit_show_link = $total_pages-$limit_page;
	if ($limit_show_link < 0) {
		$limit_show_link2 = $limit_show_link*2;
		$limit_link = $limit_show_link - $limit_show_link2;
		$limit_link = 3 - $limit_link;
	} else {
		$limit_link = 3;
	}
	$limit_page = $current_page+$limit_link;
	// end limit page
	// start page
	if ($current_page == 1) {
		$start_page = 1;
	} else if ($current_page > 1) {
		if ($current_page < 4) {
			$min_page  = $current_page-1;
		} else {
			$min_page  = 3;
		}
		$start_page = $current_page-$min_page;
	} else {
		$start_page = $current_page;
	}
	// end start page
	for($i=$start_page; $i<=$limit_page; $i++) {
		if($i==$current_page) {
			echo "<li class='page-item active'><a class='page-link' href='".$self."?page_no=".$i."'>".$i."</a></li>";
		} else {
			echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=".$i."'>".$i."</a></li>";
		}
	}
	if($current_page!=$total_pages) {
		$next = $current_page+1;
		echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=".$next."'>Next</a></li>";
	//echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=".$total_pages."'>Last</a></li>";
	}
}
// end paging link
}
                      ?>
                    </ul>
                    </div>
                  </div>
                </div>
              </div>
          </section>
        </div>
 <script type="text/javascript">
    $(document).ready(function(){
        $('#myModal').on('show.bs.modal', function (e) {
            var getId = $(e.relatedTarget).data('id');
            $.ajax({
                type : 'post',
                url : 'ajax/pesan/detail.php',
                data :  'getId='+ getId,
                success : function(data){
                $('.modal-data').html(data);
                }
            });
         });
    });
  </script>
  <?php
  include('lib/footer.php');
  ?>