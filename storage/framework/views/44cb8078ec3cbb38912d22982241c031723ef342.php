<!DOCTYPE html>
<html lang="es">    
    <head>
        <meta charset="utf-8">
        <meta content="text/html;charset=utf-8" http-equiv="content-type"/>
        <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
        <meta content="Admin Panel HTML Dashboard Template" name="description">
        <meta content="Spruko Technologies Private Limited" name="author">
        <meta content="Sistema de contratista y supervisores" name="keywords">
        <!-- Favicon -->
        <link href="<?php echo e(asset('public/img2/sircse.png')); ?>" rel="icon" type="image/x-icon"/>
        <!-- Title -->
        <title>Sircse | Portal</title>
        <!---Fontawesome css-->
        <link href="<?php echo e(asset('public/dashlead/plugins/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet"/>
        <!---Ionicons css-->
        <link href="<?php echo e(asset('public/dashlead/plugins/ionicons/css/ionicons.min.css')); ?>" rel="stylesheet"/>
        <!---Typicons css-->
        <link href="<?php echo e(asset('public/dashlead/plugins/typicons.font/typicons.css')); ?>" rel="stylesheet"/>
        <!---Feather css-->
        <link href="<?php echo e(asset('public/dashlead/plugins/feather/feather.css')); ?>" rel="stylesheet"/>
        <!---Falg-icons css-->
        <link href="<?php echo e(asset('public/dashlead/plugins/flag-icon-css/css/flag-icon.min.css')); ?>" rel="stylesheet"/>
        <!---Style css-->
        <link href="<?php echo e(asset('public/dashlead/css/style.css')); ?>" rel="stylesheet"/>
        <link href="<?php echo e(asset('public/dashlead/css/custom-style.css')); ?>" rel="stylesheet"/>
        <link href="<?php echo e(asset('public/dashlead/css/skins.css')); ?>" rel="stylesheet"/>
        <link href="<?php echo e(asset('public/dashlead/css/dark-style.css')); ?>" rel="stylesheet"/>
        <link href="<?php echo e(asset('public/dashlead/css/custom-dark-style.css')); ?>" rel="stylesheet"/>
        
        <!---Jquery.mCustomScrollbar css-->
        <link href="<?php echo e(asset('public/dashlead/plugins/jquery.mCustomScrollbar/jquery.mCustomScrollbar.css')); ?>" rel="stylesheet"/>
        <!---Sidebar css-->
        <link href="<?php echo e(asset('public/dashlead/plugins/sidebar/sidebar.css')); ?>" rel="stylesheet"/>
        <!---Switcher css-->                            
        <link href="<?php echo e(asset('public/dashlead/switcher/demo.css')); ?>" rel="stylesheet"/>

        <!--Mi estilo  sircse-->
        <link href="<?php echo e(asset('public/css/cssHeader.css')); ?>" rel="stylesheet"/>
        
        <?php echo $__env->yieldContent('styles'); ?>

    </head>
    <body class="light-theme dark-horizontal">  
        <!-- Loader -->
        <div id="global-loader">
            <img alt="Loader" class="loader-img" src="<?php echo e(asset('public/dashlead/img/loader.svg')); ?>" />
        </div>
        <!-- End Loader -->
        <!-- Page -->
        <div class="page">
            <!-- Main Header-->
            <div class="main-header hor-header">
                <div class="container">
                    <div class="main-header-left">
                        <a class="main-header-menu-icon d-lg-none" href="#" id="mainNavShow">
                            <span>
                            </span>
                        </a>
                        <a class="main-logo" style="color: #6b0f24; text-transform: none;" href="#">
                            <img src="<?php echo e(asset('public/img2/sircse.png')); ?>" class="header-brand-img desktop-logo" alt="logo"> Portal Sircse

                            <!--img alt="logo" class="header-brand-img desktop-logo" src="<?php echo e(asset('img2/sircse.png')); ?>">
                                <img alt="logo" class="header-brand-img icon-logo" src="<?php echo e(asset('img2/sircse.png')); ?>">
                                    <img alt="logo" class="header-brand-img desktop-logo theme-logo" src="<?php echo e(asset('img2/sircse.png')); ?>">
                                        <img alt="logo" class="header-brand-img icon-logo theme-logo" src="<?php echo e(asset('img2/sircse.png')); ?>">
                                        </img>
                                    </img>
                                </img>
                            </img-->
                        </a>
                    </div>
                    <div class="main-header-right">
                        <?php 
                            $id_registro=Auth::User()->id_registro;                     
                            $count_obs=0;                                                       
                            $ult_tramite=\App\Http\Models\Backend\T_Registro::find($id_registro);
                            if($ult_tramite->id_ultimo_tramite!=0)
                            {
                                $array_o=[];
                                $array_o['id_tramite']=$ult_tramite->id_ultimo_tramite;
                                $array_o['status_t']=1;
                                $total_obs=\App\Http\Models\Backend\T_Tramite_Observacion::totalObservaciones($array_o);
                                $count_obs=count($total_obs);
                            }
                        ?>

                        <div class="dropdown main-header-notification">
                            <a class="nav-link icon" href="#">                                
                                <i class="fe fe-bell"></i>                                
                                <?php if( $count_obs!=0 && $total_obs[0]->id_c_tramites_seguimiento == 2 ): ?>
                                <span class="pulse bg-danger"></span>
                                <?php endif; ?>
                            </a>
                            <div class="dropdown-menu">
                                <div class="header-navheading">
                                    <p class="main-notification-text">
                                        Notificaciones del sistema
                                    </p>
                                </div>
                                <div class="main-notification-list">
                                    <div class="media new">
                                        <div class="main-img-user online">
                                            <img alt="avatar" src="<?php echo e(asset('public/dashlead/img/contratista.png')); ?>"/>
                                        </div>
                                        <div class="media-body">
                                            <p>
                                                <?php if( $count_obs!=0 && $total_obs[0]->id_c_tramites_seguimiento == 2 ): ?>
                                                    Tu trámite tiene <strong><?php echo $count_obs; ?> observaciones</strong>, las cuales se requieren atiendas a la brevedad.
                                                <?php else: ?>
                                                    Ninguna notificación por el momento
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-footer">
                                    <?php if( $count_obs!=0 && $total_obs[0]->id_c_tramites_seguimiento == 2 ): ?>
                                    <a href="<?php echo e(Route('mis-observaciones.index')); ?>">
                                        Ver las observaciones
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown main-profile-menu">
                            <a class="main-img-user" href="#">
                                <img alt="avatar" src="<?php echo e(asset('public/dashlead/img/contratista.png')); ?>"/>
                            </a>
                            <div class="dropdown-menu">
                                <div class="header-navheading">
                                    <h6 class="main-notification-title">
                                        <?php echo e(Auth::User()->name); ?>

                                    </h6>
                                    <p class="main-notification-text">
                                        <?php echo e(Auth::User()->roles->first()->description); ?>

                                    </p>
                                </div>
                                <a class="dropdown-item border-top" href="#">
                                    <i class="fe fe-user">
                                    </i>
                                    Mi Perfil
                                </a>
                                                                
                                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fe fe-power">
                                    </i>
                                    Cerrar sesión
                                </a>
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
				                    <?php echo csrf_field(); ?>
				                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Main Header-->
            <!-- Horizonatal menu-->
            <div class="main-navbar sticky">
                <div class="container">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('mis-tramites.index')); ?>">
                                <i class="fe fe-airplay"></i> Inicio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(Route('tramites.seguimientos')); ?>">
                                <i class="fa fa-search"></i> Avance Trámite
                            </a>
                        </li>                        
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(Route('mis-observaciones.index')); ?>">
                                <?php if(
                                    $count_obs!=0 &&
                                    $total_obs[0]->id_c_tramites_seguimiento == 2
                                ): ?><span class="badge pull-right"><?php echo $count_obs; ?></span><?php endif; ?>
                                <i class="fe fe-eye"></i> Observaciones
                            </a>                                
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(Route('descargas-f.index')); ?>"><i class="fe fe-file-text"></i> Formatos</a>                    
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#mdlAtencion" data-toggle="modal"><i class="fe fe-phone-call"></i> Atencion telefonica</a>               
                        </li>

                    </ul>
                </div>
            </div>
            <!--End  Horizonatal menu-->
            <!-- Main Content-->
            <div class="main-content pt-0">
                <div class="container">
                    <!-- Page Header -->
                    <div class="page-header">
                        <div>
                            <?php echo $__env->yieldContent('title'); ?>
                            <ol class="breadcrumb">
                                <?php echo $__env->yieldContent('breadcrumb'); ?>
                            </ol>
                        </div>
                        <div class="d-flex">
                            <div class="mr-2">
                                <?php echo $__env->yieldContent('buttons'); ?>
                            </div>
                        </div>
                    </div>
                    <!-- End Page Header -->
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
            <!-- End Main Content-->

            <div class="modal fade" id="mdlAtencion">
                <div class="modal-dialog">
                    <div class="modal-content" style="width: 640px;">
                        <div class="modal-header">
                            <h4 class="modal-title">Atenci&oacute;n Telef&oacute;nica</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center">
                                <b style="font-size: 18px;">Secretaría Anticorrupción y Buen Gobierno</b><br>
                                Blvd. los Castillos No. 410, Fracc. Montes Azules, C.P. 29056 Tuxtla Gutiérrez, Chiapas.
                            </p>

                            <p class="text-center">
                                <b style="font-size: 15px;">Coordinación de Verificación de la Supervisión Externa de la Obra Pública Estatal</b>                       
                            </p>

                            <p class="text-center">
                                <b style="font-size: 18px;">SIRCSE</b><br>
                                Servicio de Informaci&oacute;n Telef&oacute;nica
                            </p>
                            <hr>
                            <p class="text-center">
                                <b style="font-size: 15px;">&Aacute;rea Legal</b><br>
                                Conmutador: 961 61 87530, ext. 22022
                            </p>

                            <p class="text-center">
                                <b style="font-size: 15px;">&Aacute;rea Financiera</b><br>
                                Conmutador: 961 61 87530, ext. 22351
                            </p>

                            <p class="text-center">
                                <b style="font-size: 15px;">&Aacute;rea T&eacute;cnica</b><br>
                                Conmutador: 961 61 87530, ext. 22232
                            </p>                        
                        </div>
                        <div class="modal-footer">
                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Cerrar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page -->
        <!-- Back-to-top -->
        <a href="#top" id="back-to-top">
            <i class="fe fe-arrow-up">
            </i>
        </a>
        <!-- Jquery js-->
        <script src="<?php echo e(asset('public/dashlead/plugins/jquery/jquery.min.js')); ?>"></script>
        <!-- Bootstrap js-->
        <script src="<?php echo e(asset('public/dashlead/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
        <!-- Rating js-->
        <script src="<?php echo e(asset('public/dashlead/plugins/rating/jquery.rating-stars.js')); ?>">  </script>
        <script src="<?php echo e(asset('public/dashlead/plugins/sweetalert/dist/sweetalert.min.js')); ?>"></script>
        <!-- Jquery.mCustomScrollbar js-->
        <script src="<?php echo e(asset('public/dashlead/plugins/jquery.mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js')); ?>"></script>
        <!-- Sidebar js-->
        <script src="<?php echo e(asset('public/dashlead/plugins/sidebar/sidebar.js')); ?>"></script>
        <!-- Perfect-scrollbar js-->
        <script src="<?php echo e(asset('public/dashlead/plugins/perfect-scrollbar/perfect-scrollbar.min.js')); ?>"></script>
        <!-- Sticky js-->
        <script src="<?php echo e(asset('public/dashlead/js/sticky.js')); ?>"></script>
        <!-- Custom js-->
        <script src="<?php echo e(asset('public/dashlead/js/custom.js')); ?>"></script>

        <?php echo $__env->yieldContent('js'); ?>
      
        <script type="text/javascript">
            var project_name= "/sircse";
            var vuri = window.location.origin + '/sircse';

            $(document).ready(function () {
                <?php echo $__env->yieldContent('script'); ?>
            });
        </script>
    </body>
</html><?php /**PATH C:\AppServ\apps\sircse\resources\views/layouts/backend.blade.php ENDPATH**/ ?>