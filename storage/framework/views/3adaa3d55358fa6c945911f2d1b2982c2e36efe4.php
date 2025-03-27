<?php $__env->startSection('content'); ?>
    <br>
	<div class="container">
		<div class="row">
		    <div class="col-md-12 text-center" id="logo"><img src="img2/sircse.png" width="220px"></div>
		    <!-- <div class="col-md-12 text-center" id="texto"><h1>Bienvenidos</h1></div> -->
		</div>	
	</div>	

    <br />
    <div class="login login-v1">
        <!-- begin login-container -->
        <div class="login-container">
                                            
            <!-- begin login-body -->
            <div class="login-body">
                <!-- begin login-content -->
                <div class="login-content">
                    <div class="row">
                        <div class="col-md-12 text-center" id="texto"><h1>Bienvenidos</h1></div>
                    </div>
                    <p>Por favor ingresa tu nombre de usuario y contraseña:</p>                    
                    <?php echo Form::open(['url' => 'login', 'method' => 'POST', 'class'=>'margin-bottom-0']); ?>

                        <div class="form-group m-b-20">
                            <!--<input id="nickname" placeholder="Usuario" required="true" class="form-control form-control-lg inverse-mode" name="nickname" type="text"> -->
                            <?php echo Form::text('nickname', old('nickname'),['id'=>'nickname', 'placeholder'=>'Usuario', 'required'=>'true', 'class'=>'form-control form-control-lg inverse-mode']); ?>

                        </div>
                        <div class="form-group m-b-20">
                            <!--<input id="password" placeholder="Contraseña" required="true" class="form-control form-control-lg inverse-mode" name="password" type="password" value=""> -->
                            <?php echo Form::password('password', ['id'=>'password', 'placeholder'=>'Contraseña', 'required'=>'true', 'class'=>'form-control form-control-lg inverse-mode']); ?>                                   
                        </div>
                        <div class="login-buttons">
                            <button type="submit" class="btn btn-info btn-block btn-lg">Ingresar</button>
                        </div>
                    <?php echo Form::close(); ?>

                    <div class="m-t-20">
					
                        <p class="r-d-10">¿ Olvidaste tu usuario y/o contraseña ? Haz click
                            <a href="#modal-alert" class="g-color-white-opacity-0_9 g-text-underline--hover" data-toggle="modal">
                                <b>aqu&iacute;</b>
                            </a>
                        </p>
					
                    </div>
					<br />
                    <div class="m-t-20">
                        
                        <!-- <h4>&#191; Aun no tienes <b>Cuenta</b> &#63;</h4>                            
                        <div class="login-buttons">
                            <a class="btn btn-light btn-block btn-lg" href="crear-cuenta/registro" role="button">Crea tu cuenta</a>
                        </div> -->
						
                        
						<br />
						<p style="text-align: center">Coordinación de Verificación de la Supervisión Externa de la Obra Pública Estatal</p>
						<p style="text-align: center">Teléfono (961) 61-87-530, Ext. 22022 y 22232.</p>
                    </div>
                    
                </div>
                <!-- end login-content -->
            </div>
            <!-- end login-body -->	
        </div>
        <!-- end login-container -->
    </div>

    <div class="modal fade" id="modal-alert">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #621132; color: #f1f2f1;">
                    <h4 class="modal-title">Restablecer  contraseña</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row m-b-15">
                        <div class="alert alert-muted">
                            <code><b>Nota:</b></code> Los datos requeridos son obligatorios porque a traves de ellos se realizara la busqueda en el padron, de no ser asi se omitira.
                        </div>
                    </div>

                    <form id="frmRecuperarPass" name="frmRecuperarPass" class="frmRecuperarPass">
                        <?php echo csrf_field(); ?>  
                        <div class="form-group" id="vpassword">
                        <div class="form-group row m-b-15">
                            <label for="txtRfc" class="col-form-label col-md-3">RFC*</label>
                            <div class="col-md-9">
                                <input type="text" id="txtRfc" name="txtRfc" class="form-control m-b-5"  placeholder="Ingresa el RFC" />
                                <div id="el-txtRfc" class="invalid-feedback lbl-error"></div>
                            </div>
                        </div>

                        <div class="form-group row m-b-15">
                            <label for="txtCorreo" class="col-form-label col-md-3">Correo*</label>
                            <div class="col-md-9">
                                <input type="email" id="txtCorreo" name="txtCorreo"  class="form-control m-b-5"  placeholder="Ingresa el correo" />
                                <small class="f-s-12 text-grey-darker">Poner la direccion completa del correo.</small>
                                <div id="el-txtCorreo" class="invalid-feedback lbl-error"></div>
                            </div>
                        </div>                        
                    </form>

                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Salir</a>
                    <button type="button" onclick="recuperarPass()" id="btnAceptPass" class="btn btn-info">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('content-original'); ?>

            <div class="login login-v1">
                <!-- begin login-container -->
                <div class="login-container">
                    <div class="login-header">
                        <div class="brand">
							<?php echo Html::image('img/sircs.png', 'alt', ['height'=>'150']); ?><br />
                            <b>Portal</b> del Contratista
                            <small>Bienvenid@ a tu portal, </small>
                        </div>
                        <div class="icon">
                            <i class="fa fa-lock"></i>
                        </div>
                    </div>
                    <!-- begin login-body -->
                    <div class="login-body">
                        <!-- begin login-content -->
                        <div class="login-content">
                            <p>Por favor ingresa tu nombre de usuario y contraseña:</p>
                            <?php echo Form::open(['url' => 'login', 'method' => 'POST', 'class'=>'margin-bottom-0']); ?>

                                <div class="form-group m-b-20">
                                    <?php echo Form::text('nickname', old('nickname'),['id'=>'nickname', 'placeholder'=>'Usuario', 'required'=>'true', 'class'=>'form-control form-control-lg inverse-mode']); ?>

                                </div>
                                <div class="form-group m-b-20">
                                    <?php echo Form::password('password', ['id'=>'password', 'placeholder'=>'Contraseña', 'required'=>'true', 'class'=>'form-control form-control-lg inverse-mode']); ?>

                                    
                                </div>
                                <div class="login-buttons">
                                    <button type="submit" class="btn btn-success btn-block btn-lg">Ingresar</button>
                                </div>                                
                            <?php echo Form::close(); ?>

                            <div class="m-t-20">
                                ¿ Olvidaste tu usuario y/o contraseña ? Haz click <a href="javascript:;">aqui</a>
					        </div>
							<div class="m-t-20 text-justify">
								A continuación se presenta un listado con los navegadores soportados, para el optimo funcionamiento del sistema, utilizar la versión mas actualizada.
								<br>
								<img src="<?php echo e(asset('img/iconos/chrome.png')); ?>"> Google Chrome <img src="<?php echo e(asset('img/iconos/mozilla.png')); ?>"> Mozilla Firefox
							</div>
                        </div>
                        <!-- end login-content -->
                    </div>
                </div>
            </div>  
            <div class="container">
                <div class="note note-default ">								
                    <div class="note-content">
                        <h4><b>Avisoo de privacidad</b></h4>
                        <p>
                            Los datos recabados en este formato, serán protegidos, incorporados y tratados en los términos establecidos en la Ley de Protección de Datos Personales en Posesión de Sujetos Obligados del Estado de Chiapas (LPDPPSOCHIS), así como en los Lineamientos Generales para la Custodia y Protección de Datos Personales e Información Reservada y Confidencial en posesión de los Sujetos Obligados del Estado de Chiapas y demas normatividad aplicable. Para mayor información puede consultar nuestro aviso de privacidad en la página: https://www.shyfpchiapas.gob.mx/
                        </p>
                    </div>
				</div> 
            </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/cores/c-sircse/resources/views/auth/login.blade.php ENDPATH**/ ?>