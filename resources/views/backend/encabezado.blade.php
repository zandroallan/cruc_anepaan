<div class="md-card">
    <div class="user_heading md-bg-gob2-500">
        <div class="user_heading_avatar">
            <div class="thumbnail">
                <img src="{{asset('public/img2/sircse.png')}}" class="" alt="usuario" width="100%">
            </div>
        </div>
        <div class="user_heading_content">
            <h2 class="heading_b uk-margin-bottom">
                <span class="uk-text-truncate">{{ $datos->razon_social_o_nombre }}</span>
                <span class="sub-heading"></span>
            </h2>
            <ul class="user_stats">
                <li>
                    <span class="uk-margin-right">
                        <i class="fas fa-city"></i>
                        <span class="uk-text-small"></i>@if($datos->id_sujeto==1) CONTRATISTA @else SUPERVISOR @endif </span>
                    </span>
                    <span class="uk-margin-right">
                        <i class="fas fa-people-carry"></i>
                        <span class="uk-text-small">Persona @if($datos->id_tipo_persona==1) física @else moral @endif</span>
                    </span>
                    <span class="uk-margin-right">
                        <i class="fas fa-id-card"></i>
                        <span class="uk-text-small">R.F.C. {{ $datos->rfc }}</span>
                    </span>
                    <span class="uk-margin-right">
                        <i class="fas fa-phone"></i>
                        <span class="uk-text-small">Telefono {{ $datos->telefono }}</span>
                    </span>
                    <span class="uk-margin-right">
                        <i class="far fa-envelope"></i>
                        <span class="uk-text-small">Correo {{ $datos->email }}</span>
                    </span>
                    @if( $datos->id_tipo_persona == 1 )

                    <span class="uk-margin-right">
                        <i class="fas fa-mars-double"></i>
                        <span class="uk-text-small">Sexo @if($datos->sexo==1) Hombre @else Mujer @endif</span>
                    </span>
                    @endif
                </li>
                @if( ($datos->id_d_domicilio_fiscal != null) ||($datos->id_d_domicilio_fiscal != '')    )
                <li>
                    <span class="uk-margin-right">
                        <span class="uk-text-small"></i>
                            Domicilio fiscal {{ $datos->calle_fiscal.' Int. '.$datos->int_fiscal.', Ext. '.$datos->ext_fiscal.', '.$datos->colonia_fiscal }} {{ 'C.P. '.$datos->cp_fiscal }}
                            {{ $datos->municipio_fiscal.', '.$datos->estado_fiscal }}
                        </span>
                    </span>
                </li>                   
                @endif
                <li>
                    <span class="uk-margin-left">
                        <h4>Únicamente se proporcionará información al interesado.</h4>
                    </span>
                </li>
            </ul>
        </div>
    </div>
</div>
