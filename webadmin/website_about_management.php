<?php
//讀入設定檔及判斷是否登入
require_once("include/inc_checkinfo.php");


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

    <link rel="stylesheet" href="ckeditor/skins/moono-lisa/editor.css">
    <link rel="stylesheet" href="ckeditor/ckeditor5-config.css">
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
        <div class="main_content_iner ">
            <div class="container-fluid p-0 sm_padding_15px">

                <div class="row">
                    <div class="col-12">
                        <div class="page_title_box d-flex align-items-center justify-content-between">
                            <div class="page_title_left">
                                <ol class="breadcrumb page_bradcam mb-0">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">網站管理</a></li>
                                    <li class="breadcrumb-item active">關於我們
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="white_card card_height_100 mb_30">
                            <div class="white_card_body">
                                <div class="card-body">
                                    <form role="form" name="dateEdit"
                                        action="https://team.vjinc.biz/member/website_about/dataSave.html" method="post"
                                        enctype="multipart/form-data">
                                        <div class="row">

                                            <div class="col-lg-12 mb_15">
                                                <div class="col-md-12 mb_15">
                                                    <label class="form-label" for="title">大標題</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        name="title"
                                                        id="title"
                                                        placeholder=""
                                                        value="" />
                                                </div>
                                                <div class="col-md-12 mb_15">
                                                    <label class="form-label" for="title_en">大標題en</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        name="title_en"
                                                        id="title_en"
                                                        placeholder=""
                                                        value="" />





                                                </div>
                                                <div class="col-md-12 mb_15">
                                                    <label class="form-label" for="preface">內容區塊</label>
                                                    <textarea id="preface" class="content" name="block_1"></textarea>
                                                    <label class="form-label" for="preface_en">內容區塊en</label>
                                                    <textarea id="preface_en" class="content" name="block_2"></textarea>
                                                </div>
                                                <div class="col-md-12 mb_15">
                                                    <div class=" card_height_100 ">
                                                        <div class="">
                                                            <div class="card-title">理念說明1</div>
                                                            <div class="card-body"> <label class="form-label" for="illustrate1_title">大標題</label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    name="illustrate1_title"
                                                                    id="illustrate1_title"
                                                                    placeholder=""
                                                                    value="" />
                                                                <label class="form-label" for="illustrate1_textarea1">內文</label>
                                                                <textarea
                                                                    rows="3"
                                                                    type="text"

                                                                    class="form-control"
                                                                    name="illustrate1_textarea1"
                                                                    id="illustrate1_textarea1"
                                                                    placeholder=""
                                                                    value=""></textarea>
                                                                <label class="form-label" for="illustrate1_title_en">大標題en</label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    name="illustrate1_title_en"
                                                                    id="illustrate1_title_en"
                                                                    placeholder=""
                                                                    value="" />
                                                                <label class="form-label" for="illustrate1_textarea1_en">內文en</label>
                                                                <textarea
                                                                    rows="3"
                                                                    type="text"

                                                                    class="form-control"
                                                                    name="illustrate1_textarea1_en"
                                                                    id="illustrate1_textarea1_en"
                                                                    placeholder=""
                                                                    value=""></textarea>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb_15">
                                                    <div class="white_card card_height_100 ">
                                                        <div class="">
                                                            <div class="card-title">理念說明2</div>
                                                            <div class="card-body"> <label class="form-label" for="illustrate2_title">大標題</label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    name="illustrate2_title"
                                                                    id="illustrate2_title"
                                                                    placeholder=""
                                                                    value="" />
                                                                <label class="form-label" for="illustrate2_textarea1">內文</label>
                                                                <textarea
                                                                    rows="3"
                                                                    type="text"

                                                                    class="form-control"
                                                                    name="illustrate2_textarea1"
                                                                    id="illustrate2_textarea1"
                                                                    placeholder=""
                                                                    value=""></textarea>
                                                                <label class="form-label" for="illustrate2_title_en">大標題en</label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    name="illustrate2_title_en"
                                                                    id="illustrate2_title_en"
                                                                    placeholder=""
                                                                    value="" />
                                                                <label class="form-label" for="illustrate2_textarea1_en">內文en</label>
                                                                <textarea
                                                                    rows="3"
                                                                    type="text"

                                                                    class="form-control"
                                                                    name="illustrate2_textarea1_en"
                                                                    id="illustrate2_textarea1_en"
                                                                    placeholder=""
                                                                    value=""></textarea>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb_15">

                                                    <div class="white_card card_height_100 ">
                                                        <div class="">
                                                            <div class="card-title">理念說明3</div>
                                                            <div class="card-body"> <label class="form-label" for="illustrate3_title">大標題</label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    name="illustrate3_title"
                                                                    id="illustrate3_title"
                                                                    placeholder=""
                                                                    value="" />
                                                                <label class="form-label" for="illustrate3_textarea1">內文</label>
                                                                <textarea
                                                                    rows="3"
                                                                    type="text"

                                                                    class="form-control"
                                                                    name="illustrate3_textarea1"
                                                                    id="illustrate3_textarea1"
                                                                    placeholder=""
                                                                    value=""></textarea>
                                                                <label class="form-label" for="illustrate3_title_en">大標題en</label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    name="illustrate3_title_en"
                                                                    id="illustrate3_title_en"
                                                                    placeholder=""
                                                                    value="" />
                                                                <label class="form-label" for="illustrate3_textarea1_en">內文en</label>
                                                                <textarea
                                                                    rows="3"
                                                                    type="text"

                                                                    class="form-control"
                                                                    name="illustrate3_textarea1_en"
                                                                    id="illustrate3_textarea1_en"
                                                                    placeholder=""
                                                                    value=""></textarea>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>




                                            </div>
                                        </div>

                                        <div class="devices_btn justify-content-end">
                                            <div class="">
                                                <input type="hidden" name="bId" value="">
                                                <button type="button" class="btn btn-success mb-3" onclick="saveData()">送出</button>
                                                <!-- <button type="button"
													class="btn btn-secondary mb-3 cancelBtn">取消</button> -->
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
                            <p>2020 © Influence - Designed by <a
                                    href="#"> <i
                                        class="ti-heart"></i> </a><a
                                    href="#"> Dashboard</a></p>
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

    <script src="ckeditor/ckeditor.js"></script>
    <!-- Page script -->
    <script type="text/javascript">
        const url = "about_post.php";
        async function getData() {
            const form_data = new FormData();
            form_data.append("dowhat", "query");
            try {
                const response = await fetch(url, {
                    method: "POST",
                    body: form_data,
                });
                if (!response.ok) {
                    throw new Error(`Response status: ${response.status}`);
                }

                const json = await response.json();

                CKEDITOR.instances.preface.setData(json["data"][0].textarea1);
                CKEDITOR.instances.preface_en.setData(json["data"][0].textarea1_en);

                $('#title').val(json['data'][0].a_title);
                $('#title_en').val(json['data'][0].a_title_en);
                $('#illustrate1_title').val(json['data'][0].illustrate1_title);
                $('#illustrate1_textarea1').val(json['data'][0].illustrate1_textarea1);
                $('#illustrate1_title_en').val(json['data'][0].illustrate1_title_en);
                $('#illustrate1_textarea1_en').val(json['data'][0].illustrate1_textarea1_en);
                $('#illustrate2_title').val(json['data'][0].illustrate2_title);
                $('#illustrate2_textarea1').val(json['data'][0].illustrate2_textarea1);
                $('#illustrate2_title_en').val(json['data'][0].illustrate2_title_en);
                $('#illustrate2_textarea1_en').val(json['data'][0].illustrate2_textarea1_en);
                $('#illustrate3_title').val(json['data'][0].illustrate3_title);
                $('#illustrate3_textarea1').val(json['data'][0].illustrate3_textarea1);
                $('#illustrate3_title_en').val(json['data'][0].illustrate3_title_en);
                $('#illustrate3_textarea1_en').val(json['data'][0].illustrate3_textarea1_en);



            } catch (error) {
                console.error(error.message);
            }
        }
        async function saveData() {
            //   console.log({ "editors:": CKEDITOR.editor });
            //   return;

            const form_data = new FormData();
            form_data.append("dowhat", "edit");
            form_data.append("textarea1", CKEDITOR.instances.preface.getData());
            form_data.append("textarea1_en", CKEDITOR.instances.preface_en.getData());

            form_data.append("title", $('#title').val());
            form_data.append("title_en", $('#title_en').val());
            form_data.append("illustrate1_title", $('#illustrate1_title').val());
            form_data.append("illustrate1_textarea1", $('#illustrate1_textarea1').val());
            form_data.append("illustrate1_title_en", $('#illustrate1_title_en').val());
            form_data.append("illustrate1_textarea1_en", $('#illustrate1_textarea1_en').val());

            form_data.append("illustrate2_title", $('#illustrate2_title').val());
            form_data.append("illustrate2_textarea1", $('#illustrate2_textarea1').val());
            form_data.append("illustrate2_title_en", $('#illustrate2_title_en').val());
            form_data.append("illustrate2_textarea1_en", $('#illustrate2_textarea1_en').val());

            form_data.append("illustrate3_title", $('#illustrate3_title').val());
            form_data.append("illustrate3_textarea1", $('#illustrate3_textarea1').val());
            form_data.append("illustrate3_title_en", $('#illustrate3_title_en').val());
            form_data.append("illustrate3_textarea1_en", $('#illustrate3_textarea1_en').val());

            // console.log({
            //     'myeditor:': JSON.stringify(data)
            // });
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
                    $("#modaltext").text("編輯成功");
                    $("#myModal").modal("show");

                } else {
                    $("#modaltext").text("編輯失敗");
                    $("#myModal").modal("show");
                }
                //   console.log({
                //     "response:": json,
                //   });
            } catch (error) {
                console.error(error.message);
            }
        }


        $(function() {
            var oImg = new classImg();

            CKEDITOR.replace('block_1', {
                customConfig: '../ckeditor/ckeditor4-config.js',
                filebrowserImageUploadUrl: './CKeditor_ImgUpload.php' // 用來處理上傳檔案的程式位置
            });
            CKEDITOR.replace('block_2', {
                customConfig: '../ckeditor/ckeditor4-config.js',
                filebrowserImageUploadUrl: './CKeditor_ImgUpload.php' // 用來處理上傳檔案的程式位置
            });


            $('form[name="dateEdit"]').on('submit', null, function() {
                if (confirm('確定送出?')) {
                    saveData();
                    return true;
                } else {
                    return false;
                }
            }).on('click', '.deleteInfo', function() {
                return false;
            }).on('click', 'button.cancelBtn', function() {
                window.location.href = '//team.vjinc.biz/member/website_blog/';
            }).on("change", ".upl", function() {
                oImg.preview(this, '.preview');
            });

            getData();
        });
    </script>
    <!-- Page script end -->

</body>

</html>