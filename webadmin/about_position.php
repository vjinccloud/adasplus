<?php
//讀入設定檔及判斷是否登入
require_once("include/inc_checkinfo.php");


?>

<?php

$sql = "select rowid,a_name,a_job,isenable from about_position_list ";
if (isset($_POST['key'])) {
  $sql .= " where a_name like '%:key%' or a_job like '%:key%' ";
}


$result = $pdo->prepare($sql);
if (isset($_POST['key'])) {
  $result->execute(['key' => $_POST['key']]);
} else {
  $result->execute();
}
$tempresult = array();

$serialnum = 1;
while ($stmt = $result->fetch(PDO::FETCH_ASSOC)) {
  //select column by key and use
  $isenable = intval($stmt['isenable']);
  $enablestr = $isenable == 1 ? '上線' : '下線';
 
  $a_job = $stmt['a_job'];
  $a_name = $stmt['a_name'];
  $rowid = intval($stmt['rowid']);


  array_push($tempresult, ['rowid' => $rowid, 'serialnum' => $serialnum, 'a_name' => $a_name, 'a_job' => $a_job, 'enablestr' => $enablestr]);



  $serialnum += 1;
}
$tempData = json_encode($tempresult);

?>


<!DOCTYPE html>
<!-- saved from url=(0053) -->
<html lang="zxx">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Management Admin</title>

  <link rel="icon" href="img/mini_logo.png" type="image/png" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <!-- themefy CSS -->
  <link rel="stylesheet" href="vendors/themefy_icon/themify-icons.css" />
  <!-- select2 CSS -->
  <link rel="stylesheet" href="vendors/niceselect/css/nice-select.css" />
  <!-- owl carousel CSS -->
  <link rel="stylesheet" href="vendors/owl_carousel/css/owl.carousel.css" />
  <!-- gijgo css -->
  <link rel="stylesheet" href="vendors/gijgo/gijgo.min.css" />
  <!-- font awesome CSS -->
  <link rel="stylesheet" href="vendors/font_awesome/css/all.min.css" />
  <link rel="stylesheet" href="vendors/tagsinput/tagsinput.css" />

  <!-- date picker -->
  <link rel="stylesheet" href="vendors/datepicker/date-picker.css" />

  <link rel="stylesheet" href="vendors/vectormap-home/vectormap-2.0.2.css" />

  <!-- scrollabe  -->
  <link rel="stylesheet" href="vendors/scroll/scrollable.css" />
  <!-- datatable CSS -->
  <link
    rel="stylesheet"
    href="vendors/datatable/css/jquery.dataTables.min.css" />
  <link
    rel="stylesheet"
    href="vendors/datatable/css/responsive.dataTables.min.css" />
  <link
    rel="stylesheet"
    href="vendors/datatable/css/buttons.dataTables.min.css" />
  <!-- text editor css -->
  <link rel="stylesheet" href="vendors/text_editor/summernote-bs4.css" />
  <!-- morris css -->
  <link rel="stylesheet" href="vendors/morris/morris.css" />
  <!-- metarial icon css -->
  <link rel="stylesheet" href="vendors/material_icon/material-icons.css" />

  <link rel="stylesheet" href="css/bootstrap-colorpicker.min.css" />
  <!-- menu css  -->
  <link rel="stylesheet" href="css/metisMenu.css" />
  <!-- style CSS -->
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/colors/default.css" id="colorSkinCSS" />
  <link rel="stylesheet" href="css/style-extend.css" />
  <style>
    #loading {
      position: fixed;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.8);
      /* 半透明白底 */
      z-index: 1000;
      display: flex;
      justify-content: center;
      align-items: center;
    }
  </style>
</head>

<body class="crm_body_bg">
  <!-- main content part here -->

  <!-- sidebar  -->
  <nav class="sidebar">
    <div class="logo d-flex justify-content-between">
      <a class="large_logo" href="https://team.vjinc.biz/member/index.html"><img src="./img/logo.png" alt="" /></a>
      <a class="small_logo" href="https://team.vjinc.biz/member/index.html"><img src="./img/mini_logo.png" alt="" /></a>
      <div class="sidebar_close_icon d-lg-none">
        <i class="ti-close"></i>
      </div>
    </div>
    <?php require_once("include/inc_sidebar.php") ?>
  </nav>
  <!--/ sidebar  -->

  <section class="main_content dashboard_part large_header_bg">
    <!-- menu  -->
    <div class="container-fluid g-0">
      <div class="row">
        <div class="col-lg-12 p-0">
          <div
            class="header_iner d-flex justify-content-between align-items-center">
            <div class="sidebar_icon d-lg-none">
              <i class="ti-menu"></i>
            </div>
            <div class="line_icon open_miniSide d-none d-lg-block">
              <img src="./img/line_img.png" alt="" />
            </div>
            <?php require_once("include/inc_header_right.php") ?>
          </div>
        </div>
      </div>
    </div>
    <!--/ menu  -->
    <div class="main_content_iner overly_inner">
      <div class="container-fluid p-0">
        <!-- page title  -->
        <div class="row">
          <div class="col-12">
            <div
              class="page_title_box d-flex align-items-center justify-content-between">
              <div class="page_title_left">
                <ol class="breadcrumb page_bradcam mb-0">
                  <li class="breadcrumb-item">關於我們</li>

                  <li class="breadcrumb-item active">關於我們-成員介紹</li>
                </ol>
              </div>

              <div class="add_button ms-2">

                <a href="about_position_dataCreate.php"
                  class="btn btn-success editbtns">建立</a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">

        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30 pt-4">
              <div class="white_card_body">
                <div class="white_box_tittle list_header">
                  <h4>關於我們-成員介紹</h4>
                  <div class="box_right d-flex lms_block">

                  </div>
                </div>
                <div class="table-responsive">
                  <table id="myTable" class="table ">
                    <thead>
                      <tr>
                        <th scope="col">流水號</th>
                        <th scope="col">標題</th>
                        <!-- <th scope="col">副標題</th> -->
                        <th scope="col">發佈日期</th>
                        <th scope="col">是否上線</th>
                        <th>功能</th>
                      </tr>
                    </thead>
                  </table>
                </div>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade show"
      id="search_modal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-modal="true"
      style="display: none">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <form
            role="form"
            name="search"
            action="//team.vjinc.biz/member/website_customer/search.html"
            method="post"
            enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">搜尋條件</h5>
              <button
                type="button"
                class="close"
                data-bs-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="common_input mb_15">
                      <input
                        type="text"
                        placeholder="姓名"
                        name="csName"
                        value="" />
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="common_input mb_15">
                      <input
                        type="text"
                        placeholder="手機"
                        name="csMobile"
                        value="" />
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="common_input mb_15">
                      <input
                        type="text"
                        placeholder="電子信箱"
                        name="csEmail"
                        value="" />
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="col-lg-6">
                        <input
                          type="checkbox"
                          class="form-check-input"
                          id="enable"
                          name="enable"
                          value="1" />
                        <label
                          class="form-label form-check-label"
                          for="enable">帳號可用</label>
                      </div>
                      <div class="col-lg-6">
                        <input
                          type="checkbox"
                          class="form-check-input"
                          id="disable"
                          name="disable"
                          value="1" />
                        <label
                          class="form-label form-check-label"
                          for="disable">帳號不可用</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">送出</button>
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal">
                關閉
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- footer part -->
    <div class="footer_part">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="footer_iner text-center">
              <p>
                2020 © Influence - Designed by
                <a href="#"> <i class="ti-heart"></i> </a><a href="#"> Dashboard</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- main content part end -->


  <div
    class="modal fade bd-example-modal-sm"
    tabindex="-1"
    role="dialog"
    aria-labelledby="mySmallModalLabel"
    aria-hidden="true"
    id="myModal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content p-4">
        <p id="modaltext" style="font-size: larger"></p>
      </div>
    </div>
  </div>

  <div id="back-top" style="display: none">
    <a title="Go to Top" href="#">
      <i class="ti-angle-up"></i>
    </a>
  </div>
  <div id="loading" style="display: none">
    <img src="./img/loading.gif" alt="Loading..." />
  </div>

  <!-- footer  -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="js/popper.min.js"></script>
  <!-- bootstarp js -->
  <script src="js/bootstrap.min.js"></script>
  <!-- sidebar menu  -->
  <script src="js/metisMenu.js"></script>
  <!-- waypoints js -->
  <script src="vendors/count_up/jquery.waypoints.min.js"></script>
  <!-- waypoints js -->
  <script src="vendors/chartlist/Chart.min.js"></script>
  <!-- counterup js -->
  <script src="vendors/count_up/jquery.counterup.min.js"></script>

  <!-- nice select -->
  <script src="vendors/niceselect/js/jquery.nice-select.min.js"></script>
  <!-- owl carousel -->
  <script src="vendors/owl_carousel/js/owl.carousel.min.js"></script>

  <!-- responsive table -->
  <script src="vendors/datatable/js/jquery.dataTables.min.js"></script>
  <script src="vendors/datatable/js/dataTables.responsive.min.js"></script>
  <script src="vendors/datatable/js/dataTables.buttons.min.js"></script>
  <script src="vendors/datatable/js/buttons.flash.min.js"></script>
  <script src="vendors/datatable/js/jszip.min.js"></script>
  <script src="vendors/datatable/js/pdfmake.min.js"></script>
  <script src="vendors/datatable/js/vfs_fonts.js"></script>
  <script src="vendors/datatable/js/buttons.html5.min.js"></script>
  <script src="vendors/datatable/js/buttons.print.min.js"></script>

  <!-- datepicker  -->
  <script src="vendors/datepicker/datepicker.js"></script>
  <script src="vendors/datepicker/datepicker.en.js"></script>
  <script src="vendors/datepicker/datepicker.custom.js"></script>

  <script src="js/chart.min.js"></script>
  <script src="vendors/chartjs/roundedBar.min.js"></script>

  <!-- progressbar js -->
  <script src="vendors/progressbar/jquery.barfiller.js"></script>
  <!-- tag input -->
  <script src="vendors/tagsinput/tagsinput.js"></script>
  <!-- text editor js -->
  <script src="vendors/text_editor/summernote-bs4.js"></script>
  <script src="vendors/am_chart/amcharts.js"></script>

  <!-- scrollabe  -->
  <script src="vendors/scroll/perfect-scrollbar.min.js"></script>
  <script src="vendors/scroll/scrollable-custom.js"></script>

  <!-- vector map  -->
  <script src="js/vectormap-2.0.2.min.js"></script>
  <script src="js/vectormap-world-mill-en.js"></script>

  <!-- <script src="//team.vjinc.biz/member/vendors/echart/echarts.min.js"></script> -->

  <script src="vendors/chart_am/core.js"></script>
  <script src="vendors/chart_am/charts.js"></script>
  <script src="vendors/chart_am/animated.js"></script>
  <script src="vendors/chart_am/kelly.js"></script>
  <script src="vendors/chart_am/chart-custom.js"></script>

  <script src="js/bootstrap-colorpicker.min.js"></script>

  <!-- custom js -->
  <script src="js/dashboard_init.js"></script>
  <div class="jvectormap-tip"></div>
  <script src="js/custom.js"></script>

  <script src="js/class-comm.js" type="text/javascript"></script>
  <script src="js/main.js" type="text/javascript"></script>
  <script>
    function delconfim(id){
           if (confirm('確定刪除?')) {
          delData(id);
          return true;
        } else {
          return false;
        }
    }
    async function delData(id) {
      const myurl = "about_position_post.php";
      const form_data = new FormData();

      form_data.append('id', id)

      form_data.append('dowhat', "delete");

      try {
        const response = await fetch(myurl, {
          method: "POST",

          body: form_data, //JSON.stringify(data),
        });
        if (!response.ok) {
          throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json();

        if (json.isSuccess) {
          $('#modaltext').text("刪除成功");
          $('#myModal').modal('show');

        } else {
          $('#modaltext').text("刪除失敗");
          $('#myModal').modal('show');

        }

      } catch (error) {
        console.error(error.message);
      }
    }

    function setEditbtns() {
      $('.editbtns').each(function() {
        if (isedit == 0) {
          $(this).hide();
        }
      })
    }

    var isedit = <?php echo $pedit; ?>;
    $(document).ready(function() {
      $('#myTable').DataTable({
        "data": JSON.parse('<?php echo $tempData  ?>'),
        "columns": [{
            data: 'serialnum'
          },
          {
            data: 'a_name'
          },
          {
            data: 'a_job'
          },
          {
            data: 'enablestr'
          },
          {
            data: 'rowid',
            title: "操作功能", // 這邊是欄位
            render: function(data, type, row) {
              return '<button class="btn_2 editBtn editbtns" onclick="location.href = \'about_position_dataEdit.php?id=' + data + '\';">修改</button>' +
                '<button class="btn_2 editBtn editbtns tabledelbtn" style="margin-left:10px" onclick="delconfim('+data+')"  data-pid="' + data + '">刪除</button>'
            }
          },
        ],
        drawCallback: function(settings) {
          setEditbtns();
          // var api = this.api();

          // // Output the data for the visible rows to the browser's console
          // console.log(api.rows({
          //   page: 'current'
          // }).data());
        }
      });
      setEditbtns();

    });

    var userSelection = document.getElementsByClassName('tabledelbtn');

    for (var i = 0; i < userSelection.length; i++) {
      (function(index) {
        userSelection[index].addEventListener("click", function() {
          console.log("Clicked index: " + index);
        })
      })(i);
    }
    // let tabledelbtns=document.getElementsByClassName('tabledelbtn');
    // tabledelbtns.foreach(function(el){
    //   el.addEventListener('click', function() {
    //     console.log({
    //         'id=': $(this).data('pid')
    //     });
    //     let pid = $(this).data('pid');
    //     if (confirm('確定刪除?')) {
    //       delData(pid);
    //       return true;
    //     } else {
    //       return false;
    //     }

    //   })
    // });

    // $('.tabledelbtn').each(function() {
    //   $(this).on('click', function() {
    //     console.log({
    //         'id=': $(this).data('pid')
    //     });
    //     let pid = $(this).data('pid');
    //     if (confirm('確定刪除?')) {
    //       delData(pid);
    //       return true;
    //     } else {
    //       return false;
    //     }

    //   });
    // })

    $("#myModal").on('hide.bs.modal', function() {
      if ($("#modaltext").text().includes("成功")) {
        window.location.reload();
      }

    });
  </script>
</body>

</html>