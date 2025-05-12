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

    <section class="login-form">
        <div class="div-form">
            <div class="row justify-content-center">
                <img class="col-lg-8" src="img/logo.png" alt="">

            </div>
            <div class="item">
                <div class="label">您的帳號</div>
                <div class="controler">
                    <div class="box box-eye">
                        <input type="text" id="account" placeholder="帳號" data-change-type="password"><i></i>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="label">您的密碼</div>
                <div class="controler">
                    <div class="box box-eye hide">
                        <input id="password" type="password" placeholder="password" data-change-type="text"><i></i>
                    </div>
                </div>
            </div>
            <div class="item action">
                <button class="btn-blue" type="button" onclick="Login()">登入</button>
            </div>
        </div>
    </section>
    <div id="loading" style="display:none;">
        <img src="./img/loading.gif" alt="Loading...">
    </div>
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
        async function Login() {


            const url = "user_post.php";

            const form_data = new FormData();

            form_data.append("account", $("#account").val());
            form_data.append("password", $("#password").val());

            form_data.append('dowhat', "login");

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
                    $('#modaltext').text(json.msg);
                    $('#myModal').modal('show');
                    console.log(json);
                    window.location.href = "../webadmin/" + json.data;
                } else {
                    $('#modaltext').text(json.msg);
                    $('#myModal').modal('show');

                }

            } catch (error) {
                console.error(error.message);
            }
        }
        $(function() {
            setEyeToggle();

        });

        function setEyeToggle() {
            if ($('.box-eye').length > 0) {
                $('.box-eye').each(function() {
                    $(this).find('i').click(function() {
                        $(this).parent().toggleClass('hide');
                        var changeType = $(this).parent().find('input').attr("data-change-type");
                        var originalType = $(this).parent().find('input').attr("type");
                        $(this).parent().find('input').attr("data-change-type", originalType);
                        $(this).parent().find('input').attr("type", changeType);
                    });
                });
                $('.box-eye i').click(function() {


                });
            }
        }
    </script>

</body>

</html>