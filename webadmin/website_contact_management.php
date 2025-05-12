<?php
//讀入設定檔及判斷是否登入
require_once("include/inc_checkinfo.php");

$sql = "select p.rowid,p.username,p.phone,p.email,p.createdt,p.statussettings from contact_list p ";
// $sql .= " left join category_detail c on c.rowid=p.category  order by sort ";
$result = $pdo->prepare($sql);

$result->execute();

$tempresult = array();
// while ($stmt = $result->fetch(PDO::FETCH_ASSOC)) {
//     //select column by key and use
//     $username = $stmt['username'];
//     $rowid = $stmt['rowid'];
//     $phone = $stmt['phone'];
//     $email = $stmt['email'];
//     $createdt = $stmt['createdt'];
//     $statussettingsstr = ''; //狀態設定 1未處理2處理中3選處理
//     switch (intval($stmt['statussettings'])) {
//         case 1:
//             $statussettingsstr = '未處理';
//             break;
//         case 2:
//             $statussettingsstr = '處理中';
//             break;

//         case 3:
//             $statussettingsstr = '已處理';
//             break;
//     }
//     array_push($tempresult, ['rowid' => $rowid, 'username' => $username, 'phone' => $phone, 'email' => $email, 'status' => $statussettingsstr, 'createdt' => $createdt]);
// }

// $tempData = json_encode($tempresult);


?>

<!DOCTYPE html>
<!-- saved from url=(0053) -->
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Management Admin</title>

    <link rel="icon" href="img/mini_logo.png" type="image/png">
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
    <link rel="stylesheet" href="vendors/datatable/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="vendors/datatable/css/responsive.dataTables.min.css" />
    <link rel="stylesheet" href="vendors/datatable/css/buttons.dataTables.min.css" />
    <!-- text editor css -->
    <link rel="stylesheet" href="vendors/text_editor/summernote-bs4.css" />
    <!-- morris css -->
    <link rel="stylesheet" href="vendors/morris/morris.css">
    <!-- metarial icon css -->
    <link rel="stylesheet" href="vendors/material_icon/material-icons.css" />

    <link rel="stylesheet" href="css/bootstrap-colorpicker.min.css">
    <!-- menu css  -->
    <link rel="stylesheet" href="css/metisMenu.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/colors/default.css" id="colorSkinCSS">
    <link rel="stylesheet" href="css/style-extend.css">
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
            <a class="large_logo" href="https://team.vjinc.biz/member/index.php"><img
                    src="./img/logo.png" alt=""></a>
            <a class="small_logo" href="https://team.vjinc.biz/member/index.php"><img
                    src="./img/mini_logo.png" alt=""></a>
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
                <div class="col-lg-12 p-0 ">
                    <div class="header_iner d-flex justify-content-between align-items-center">
                        <div class="sidebar_icon d-lg-none">
                            <i class="ti-menu"></i>
                        </div>
                        <div class="line_icon open_miniSide d-none d-lg-block">
                            <img src="./img/line_img.png" alt="">
                        </div>
                        <?php require_once("include/inc_header_right.php") ?>
                    </div>
                </div>
            </div>
        </div>
        <!--/ menu  -->
        <div class="main_content_iner overly_inner ">
            <div class="container-fluid p-0 ">
                <!-- page title  -->
                <div class="row">
                    <div class="col-12">
                        <div class="page_title_box d-flex align-items-center justify-content-between">
                            <div class="page_title_left">
                                <ol class="breadcrumb page_bradcam mb-0">
                                    <li class="breadcrumb-item">網站管理</li>
                                    <li class="breadcrumb-item active">聯絡我們</li>
                                </ol>
                            </div>
                            <div class="add_button ms-2">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-12">
                        <div class="white_card card_height_100 mb_30 pt-4">
                            <div class="white_card_body">
                                <div class="white_box_tittle list_header">
                                    <h4>聯絡我們</h4>
                                    <div class="box_right d-flex lms_block">
                                        <!-- <div class="serach_field_2">
                                            <div class="search_inner">
                                                <form active="#">
                                                    <div class="search_field">
                                                        <input type="text" placeholder="Search content here...">
                                                    </div>
                                                    <button type="submit"> <i class="ti-search"></i> </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="add_button ms-2">
                                            <a href="#" data-toggle="modal" data-target="#addcategory"
                                                class="btn_1">search</a>
                                        </div> -->
                                        <div class="add_button ms-2">
                                            <button class="btn_1 deleteInfo" >批次刪除</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="mytable" class="table lms_table_active3">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">姓名</th>
                                                <th scope="col">電話</th>
                                                <th scope="col">email</th>
                                                <th scope="col">提問時間</th>
                                                <th scope="col">狀態</th>
                                                <th scope="col">功能</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($stmt = $result->fetch(PDO::FETCH_ASSOC)) {
                                                //select column by key and use
                                                $username = $stmt['username'];
                                                $rowid = $stmt['rowid'];
                                                $phone = $stmt['phone'];
                                                $email = $stmt['email'];
                                                $createdt = $stmt['createdt'];
                                                $statussettingsstr = '未處理'; //狀態設定 1未處理2處理中3選處理
                                                switch (intval($stmt['statussettings'])) {
                                                    case 1:
                                                        $statussettingsstr = '未處理';
                                                        break;
                                                    case 2:
                                                        $statussettingsstr = '處理中';
                                                        break;

                                                    case 3:
                                                        $statussettingsstr = '已處理';
                                                        break;
                                                }
                                                // $username="";
                                                // $statussettingsstr="";
                                                array_push($tempresult, ['rowid' => $rowid, 'username' => $username, 'phone' => $phone, 'email' => $email, 'status' => $statussettingsstr, 'createdt' => $createdt]);


                                            ?>


                                                <tr class="dataRow">
                                                    <td><input aria-label="Select row" class="dt-select-checkbox" type="checkbox" value="<?php echo $rowid ?>" onchange="selectrowdata(this)"></td>
                                                    <td><?php echo $username ?></td>
                                                    <td><?php echo $phone ?></td>
                                                    <td><?php echo $email ?></td>
                                                    <td><?php echo $createdt ?></td>
                                                    <td>
                                                        <i class="far fa-circle f_s_14 text_color_3"></i> <?php echo $statussettingsstr ?>
                                                    </td>
                                                    <td>
                                                        <button class="btn_2 editBtn editbtns" onclick="location.href ='./website_contact_management_dataEdit.php?id=<?php echo $rowid ?>'">修改</button>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            $tempData = json_encode($tempresult);
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- <div class="col-lg-12">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-end">
                                            <li class="page-item disabled"><a class="page-link"
                                                    href="//team.vjinc.biz/member/website_product_classification/?page=1"
                                                    tabindex="-1" aria-disabled="true">Previous</a></li>
                                            <li class="page-item active"><a class="page-link"
                                                    href="//team.vjinc.biz/member/website_product_classification/?page=1">1</a>
                                            </li>
                                            <li class="page-item disabled"><a class="page-link"
                                                    href="//team.vjinc.biz/member/website_product_classification/?page=1">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div> -->

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- footer part -->
        <div class="footer_part">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer_iner text-center">
                            <p>2020 © Influence - Designed by <a href="#"> <i class="ti-heart"></i> </a><a href="#">
                                    Dashboard</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- main content part end -->


    <div id="back-top" style="display: none;">
        <a title="Go to Top" href="#">
            <i class="ti-angle-up"></i>
        </a>
    </div>
    <div id="loading" style="display:none;">
        <img src="./img/loading.gif" alt="Loading...">
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
    <!-- Page script -->
    <script type="text/javascript">
        var rowdatas = [];

        function selectrowdata(e) {
            let rowid = $(e).val();
            if ($(e).prop('checked')) {
                rowdatas.push(rowid);
            } else {
                rowdatas = $.grep(rowdatas, function(value) {
                    return value !== rowid;
                });
            }

            // console.log({
            //     'rowids:': rowdatas
            // });
        }
        const url = "contact_post.php";
        async function delData() {


            const form_data = new FormData();

            form_data.append('delrowids', rowdatas)

            form_data.append('dowhat', "mdelete");

            try {
                const response = await fetch(url, {
                    method: "POST",

                    body: form_data, //JSON.stringify(data),
                });
                if (!response.ok) {
                    throw new Error(`Response status: ${response.status}`);
                }

                const json = await response.json();

                if (json.isSuccess) {
                    // $('#modaltext').text("刪除成功");
                    // $('#myModal').modal('show');
                    alert('刪除成功');
                    window.location.reload();
                } else {
                    // $('#modaltext').text("刪除失敗");
                    // $('#myModal').modal('show');
                    alert('刪除失敗');

                }

            } catch (error) {
                console.error(error.message);
            }
        }

        $(function() {
            $('.deleteInfo').on('click', function() {
                if (confirm('確定刪除?')) {
                    delData();
                    return true;
                } else {
                    return false;
                }
            })
            $('#mytable').DataTable();
            // var tempdata = '<?php echo $tempData  ?>';
            // $('#myTable').DataTable({
            //     "data": JSON.parse('<?php echo $tempData  ?>'),
            //     "columns": [{
            //             data: "rowid",
            //             render: DataTable.render.select()
            //         },
            //         {
            //             data: 'username'
            //         },
            //         {
            //             data: 'phone'
            //         },
            //         {
            //             data: 'email'
            //         },
            //         {
            //             data: 'createdt'
            //         },
            //         {
            //             data: 'status'
            //         },
            //         {
            //             data: 'rowid',
            //             title: "操作功能", // 這邊是欄位
            //             render: function(data, type, row) {
            //                 return '<button class="btn_2 editBtn editbtns" onclick="location.href = \'website_contact_management_dataEdit.php?id=' + data + '\';">修改</button>'
            //             }
            //         },
            //     ],
            //     select: {
            //         style: 'multi',
            //         selector: 'td:first-child',
            //         headerCheckbox: 'select-page'
            //     }

            // });

        });
    </script>

</body>

</html>