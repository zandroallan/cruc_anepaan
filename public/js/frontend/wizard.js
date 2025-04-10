"use strict";

// Class Definition
var KTLogin = function() {
	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';

	var _handleFormSignup = function() {
		// Base elements
		var wizardEl = KTUtil.getById('kt_login');
		var form = KTUtil.getById('kt_login_signup_form');
		var wizardObj;
		var validations = [];

		if (!form) {
			return;
		}

		// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
		// Step 1
		validations.push(FormValidation.formValidation(
			form,
			{
				fields: {
					nombre: {
						validators: {
							callback: {
					            message: 'El nombre es requerido',
					            callback: function(input) {
					              // Verifica qué radio está seleccionado
					              const tipoPersona = form.querySelector('[name="id_tipo_persona"]:checked').value;

					              // Si es "fisica", valida el campo nombre
					              if (tipoPersona === '1') {
					                return input.value.trim() !== '';  // El nombre no puede estar vacío
					              }

					              // Si es "moral", no valida el campo nombre
					              return true; 
					            }
					        }
						}
					},
					ap_paterno: {
						validators: {
							callback: {
					            message: 'El apellido es requerido',
					            callback: function(input) {
					              // Verifica qué radio está seleccionado
					              const tipoPersona = form.querySelector('[name="id_tipo_persona"]:checked').value;

					              // Si es "fisica", valida el campo nombre
					              if (tipoPersona === '1') {
					                return input.value.trim() !== '';  // El nombre no puede estar vacío
					              }

					              // Si es "moral", no valida el campo nombre
					              return true; 
					            }
					        }
						}
					},
					ap_materno: {
						validators: {
							callback: {
					            message: 'El apellido es requerido',
					            callback: function(input) {
					              // Verifica qué radio está seleccionado
					              const tipoPersona = form.querySelector('[name="id_tipo_persona"]:checked').value;

					              // Si es "fisica", valida el campo nombre
					              if (tipoPersona === '1') {
					                return input.value.trim() !== '';  // El nombre no puede estar vacío
					              }

					              // Si es "moral", no valida el campo nombre
					              return true; 
					            }
					        }
						}
					},
					curp: {
						validators: {
							callback: {
					            message: 'La curp es requerido',
					            callback: function(input) {
					              // Verifica qué radio está seleccionado
					              const tipoPersona = form.querySelector('[name="id_tipo_persona"]:checked').value;

					              // Si es "fisica", valida el campo nombre
					              if (tipoPersona === '1') {
					                return input.value.trim() !== '';  // El nombre no puede estar vacío
					              }

					              // Si es "moral", no valida el campo nombre
					              return true; 
					            }
					        }
						}
					},
					rfc: {
						validators: {
							notEmpty: {
								message: 'El rfc es requerido'
							}
						}
					},
					id_nacionalidad: {
						validators: {
							callback: {
					            message: 'La nacionalidad es requerido',
					            callback: function(input) {
					              // Verifica qué radio está seleccionado
					              const tipoPersona = form.querySelector('[name="id_tipo_persona"]:checked').value;

					              // Si es "fisica", valida el campo nombre
					              if (tipoPersona === '1') {
					                return input.value.trim() !== '';  // El nombre no puede estar vacío
					              }

					              // Si es "moral", no valida el campo nombre
					              return true; 
					            }
					        }
						}
					},

					razon_social_o_nombre: {
						validators: {
							callback: {
					            message: 'La razon social es requerido',
					            callback: function(input) {
					              // Verifica qué radio está seleccionado
					              const tipoPersona = form.querySelector('[name="id_tipo_persona"]:checked').value;

					              // Si es "Moral", valida el campo nombre
					              if (tipoPersona === '2') {
					                return input.value.trim() !== '';  // El nombre no puede estar vacío
					              }

					              // Si es "fisica", no valida el campo nombre
					              return true; 
					            }
					        }
						}
					},
					
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap({
						//eleInvalidClass: '',
						eleValidClass: '',
					})
				}
			}
		));

		// Step 2
		validations.push(FormValidation.formValidation(
			form,
			{
				fields: {
					telefono: {
						validators: {
							notEmpty: {
								message: 'El teléfono es requerido'
							}
						}
					},
					correo: {
						validators: {
							notEmpty: {
								message: 'El correo es requerido'
							}
						}
					},
					id_tipo_identificacion: {
						validators: {
							notEmpty: {
								message: 'La identificación es requerido'
							}
						}
					},
					numero_identificacion: {
						validators: {
							notEmpty: {
								message: 'El número de identificación es requirido'
							}
						}
					},
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap({
						//eleInvalidClass: '',
						eleValidClass: '',
					})
				}
			}
		));

		// Step 3
		validations.push(FormValidation.formValidation(
			form,
			{
				fields: {
					nickname: {
						validators: {
							notEmpty: {
								message: 'El nombre de usuario es requerido'
							}
						}
					},
					password: {
						validators: {
							notEmpty: {
								message: 'El password es requerido'
							}
						}
					},
					password_confirmation: {
						validators: {
							notEmpty: {
								message: 'La confirmación es requerido'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap({
						//eleInvalidClass: '',
						eleValidClass: '',
					})
				}
			}
		));
		
		// Initialize form wizard
		wizardObj = new KTWizard(wizardEl, {
			startStep: 1, // initial active step number
			clickableSteps: false  // allow step clicking
		});

		// Validation before going to next page
		wizardObj.on('change', function (wizard) {
			if (wizard.getStep() > wizard.getNewStep()) {
				return; // Skip if stepped back
			}

			// Validate form before change wizard step
			var validator = validations[wizard.getStep() - 1]; // get validator for currnt step

			if (validator) {
				validator.validate().then(function (status) {
					if (status == 'Valid') {
						wizard.goTo(wizard.getNewStep());

						KTUtil.scrollTop();
					} else {
						Swal.fire({
							text: "Lo sentimos, parece que se detectaron algunos errores, por favor inténtalo de nuevo..",
							icon: "error",
							buttonsStyling: false,
							confirmButtonText: "Aceptar ",
							customClass: {
								confirmButton: "btn font-weight-bold btn-light"
							}
						}).then(function () {
							KTUtil.scrollTop();
						});
					}
				});
			}

			return false;  // Do not change wizard step, further action will be handled by he validator
		});

		// Change event
		wizardObj.on('changed', function (wizard) {
			KTUtil.scrollTop();
		});

		// Submit event
		wizardObj.on('submit', function (wizard) {
			Swal.fire({
				text: "Estas seguro de crear tu cuenta.",
				icon: "warning",
				showCancelButton: true,
				buttonsStyling: false,
				confirmButtonText: "Si, estoy seguro",
				cancelButtonText: "No, estoy seguro",
				customClass: {
					confirmButton: "btn font-weight-bold btn-primary",
					cancelButton: "btn font-weight-bold btn-default"
				}
			}).then(function (result) {

				if (result.value) {					
					
				    var str_errors;
				    $.ajax({
				        type: "POST",
				        url: vuri + '/crear-cuenta/registro',
				        data: new FormData(form),
				        headers: {
	                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                    },
					    processData: false,
				        contentType: false,
				        success: function(json) {
				            messages_validation(json.data, false);

				            Swal.fire({
								text: json.msg,
								icon: "success",
								buttonsStyling: false,
								confirmButtonText: "Aceptar",
								customClass: {
									confirmButton: "btn font-weight-bold btn-primary",
								}
							});

				            setTimeout(function() { 
						        if (json.route_redirect != "") {
				                	window.location = json.route_redirect;
				            	}
						    }, 4000);				            
				        },
				        error: function(json) {
				            var jsonString = json.responseJSON;
				            if (json.status === 422) {
				                messages_validation(null, false);
				                str_errors = 'Hay campos pendientes o que han sido llenados con información incorrecta. <br> Por favor verifique la información.';
				                messages_validation(jsonString.errors, true);
				            }
				            if (json.status === 409) {
				                str_errors = jsonString.msg;
				            }

				            Swal.fire({
								text: str_errors,
								icon: "danger",
								buttonsStyling: false,
								confirmButtonText: "Aceptar",
								customClass: {
									confirmButton: "btn font-weight-bold btn-primary",
								}
							});
				        }
				    });
				



				} else if (result.dismiss === 'cancel') {
					Swal.fire({
						text: "Usted ha cancelado la creacion de la cuenta.",
						icon: "error",
						buttonsStyling: false,
						confirmButtonText: "Aceptar",
						customClass: {
							confirmButton: "btn font-weight-bold btn-primary",
						}
					});
				}
			});
		});
    }

    // Public Functions
    return {
        init: function() {
			_handleFormSignup();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLogin.init();
});


function messages_validation(fields, show) {
    if (show == true) {
        //alert(2);
        $.each(fields, function(key, value) {
            $('#el-' + key).html(value);
            $('#' + key).addClass('is-invalid');
        });
    } else {
        $('.lbl-error').html("");
        $('.lbl-error').removeClass('is-invalid');
        $('.form-control').removeClass('is-invalid');
    }
}