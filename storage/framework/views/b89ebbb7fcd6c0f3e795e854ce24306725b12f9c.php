<!DOCTYPE html>
<html lang="es">    
    <head>
        <meta charset="utf-8">
        <meta content="text/html;charset=utf-8" http-equiv="content-type"/>
        <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
        <meta content="Dashlead -  Admin Panel HTML Dashboard Template" name="description">
        <meta content="Spruko Technologies Private Limited" name="author">
        <meta content="Sistema de contratista y supervisores" name="keywords">
        <!-- Favicon -->
        <link href="<?php echo e(asset('img2/sircse.png')); ?>" rel="icon" type="image/x-icon"/>
        <!-- Title -->
        <title>Sircse | Portal</title>
        <!---Fontawesome css-->
        <link href="<?php echo e(asset('dashlead/plugins/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet"/>
        <!---Ionicons css-->
        <link href="<?php echo e(asset('dashlead/plugins/ionicons/css/ionicons.min.css')); ?>" rel="stylesheet"/>
        <!---Typicons css-->
        <link href="<?php echo e(asset('dashlead/plugins/typicons.font/typicons.css')); ?>" rel="stylesheet"/>
        <!---Feather css-->
        <link href="<?php echo e(asset('dashlead/plugins/feather/feather.css')); ?>" rel="stylesheet"/>
        <!---Falg-icons css-->
        <link href="<?php echo e(asset('dashlead/plugins/flag-icon-css/css/flag-icon.min.css')); ?>" rel="stylesheet"/>
        <!---Style css-->
        <link href="<?php echo e(asset('dashlead/css/style.css')); ?>" rel="stylesheet"/>
        <link href="<?php echo e(asset('dashlead/css/custom-style.css')); ?>" rel="stylesheet"/>
        <link href="<?php echo e(asset('dashlead/css/skins.css')); ?>" rel="stylesheet"/>
        <link href="<?php echo e(asset('dashlead/css/dark-style.css')); ?>" rel="stylesheet"/>
        <link href="<?php echo e(asset('dashlead/css/custom-dark-style.css')); ?>" rel="stylesheet"/>
        
        <!---Jquery.mCustomScrollbar css-->
        <link href="<?php echo e(asset('dashlead/plugins/jquery.mCustomScrollbar/jquery.mCustomScrollbar.css')); ?>" rel="stylesheet"/>
        <!---Sidebar css-->
        <link href="<?php echo e(asset('dashlead/plugins/sidebar/sidebar.css')); ?>" rel="stylesheet"/>
        <!---Switcher css-->                            
        <link href="<?php echo e(asset('dashlead/switcher/demo.css')); ?>" rel="stylesheet"/>

        <!--Mi estilo  sircse-->
        <link href="<?php echo e(asset('css/cssHeader.css')); ?>" rel="stylesheet"/>
        
        <?php echo $__env->yieldContent('styles'); ?>

        <style type="text/css">
            .alert-success {
              padding: 5px;
                padding-left: 5px;
              padding-left: 15px;
              background-color: #D1E7DD;
              color: #009933;
              border-radius: 10px;
              border-color: #4CAE50;
            }
            .alert-success {
              color: #3c763d;
              background-color: #dff0d8;
              border-color: #d6e9c6;
            }
            .alert-success {
              color: #3c763d;
              background-color: #dff0d8;
              border-color: #d6e9c6;
            }

            .alert-danger {
              padding: 5px;
                padding-left: 5px;
              padding-left: 15px;
              background-color: #f8d7da;
              color: #721c24;
              border-radius: 10px;
              border-color: #f8d7da;
            }
            .alert-danger {
              color: #721c24;
              background-color: #f8d7da;
              border-color: #f8d7da;
            }
            .alert-danger {
              color: #721c24;
              background-color: #f8d7da;
              border-color: #f8d7da;
            }

            ul {
              /* My style goes here.. */
              padding-left: 10px;
              font-size: 16px;
            }
        
            .list {
              list-style-type: none;
              /*padding-left: 0;*/
            }
        
            .list li {
              padding: 5px;
              /*border-bottom: 1px solid #dddddd;*/
            }
        
            .list li:hover {
              background-color: #fffbc3;
            }

            
        </style>
    </head>
    <body class="light-theme dark-horizontal">     
        <div class="page main-signin-wrapper">

            <!-- Row -->
            <div class="row pl-0 pr-0 ml-0 mr-0">
                <div class="col-lg-8 d-block mx-auto">
                    <div class="text-center mb-2">

                        <img src="<?php echo e(asset('img/SAyBG.png')); ?>" class="" alt="logo" width="30%" />
                    </div>
                    <div class="card custom-card">
                        <div class="card-body">
                            <?php echo $__env->yieldContent('content'); ?>

                            <div class="mt-3 text-center">
                                <p class="mb-2">Secretaría Anticorrupción y Buen Gobierno</p>
                                <p class="mb-2"><b>© Unidad de Informática y Desarrollo Digital</b></p>
                                <p class="mb-2"> Blvd. los Castillos No. 410, Fracc. Montes Azules, C.P. 29056 Tuxtla Gutiérrez, Chiapas.<br>
                                    Conmutador: (961) 61 8 75 30 Teléfono Quejas y Denuncias 800-900-9000 <br>
                                    https://www.anticorrupcionybg.gob.mx
                                </p>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->       
        </div>
        <!-- End Page -->
        <!-- Back-to-top -->
       
        <!-- Jquery js-->
        <script src="<?php echo e(asset('dashlead/plugins/jquery/jquery.min.js')); ?>">
        </script>
        <!-- Bootstrap js-->
        <script src="<?php echo e(asset('dashlead/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>">
        </script>
        <!-- Rating js-->
        <script src="<?php echo e(asset('dashlead/plugins/rating/jquery.rating-stars.js')); ?>">  </script>
       
        <script src="<?php echo e(asset('dashlead/plugins/sweetalert/dist/sweetalert.min.js')); ?>"></script>
       
        <!-- Jquery.mCustomScrollbar js-->
        <script src="<?php echo e(asset('dashlead/plugins/jquery.mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js')); ?>">
        </script>
        <!-- Sidebar js-->
        <script src="<?php echo e(asset('dashlead/plugins/sidebar/sidebar.js')); ?>">
        </script>
        <!-- Perfect-scrollbar js-->
        <script src="<?php echo e(asset('dashlead/plugins/perfect-scrollbar/perfect-scrollbar.min.js')); ?>">
        </script>
       
        <!-- Custom js-->
        <script src="<?php echo e(asset('dashlead/js/custom.js')); ?>"></script>

        <?php echo $__env->yieldContent('js'); ?>
      

        <script type="text/javascript">
            var project_name= "/sircse";
            var vuri = window.location.origin + '/sircse';

            $(document).ready(function () {
                <?php echo $__env->yieldContent('script'); ?>
            });
        </script>
    </body>
</html><?php /**PATH /var/cores/c-sircse/resources/views/layouts/app_valida.blade.php ENDPATH**/ ?>