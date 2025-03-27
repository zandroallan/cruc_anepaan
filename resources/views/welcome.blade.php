@extends('layouts.frontend')

@section('content')
<section class="section" id="sect-features">
        <div class="uk-container uk-container-center">
            <div class="uk-grid">
                <div class="uk-width-large-3-5 uk-container-center uk-text-center">
                    <h2 class="heading_b">
                        {!! HTML::image('img/sircs.png', 'SHyFP', array( 'height' => '25px' )) !!}
                        
                    </h2>
                </div>
            </div>
            <div class="uk-grid uk-grid-width-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-5 animate" >
                <div class="uk-margin-top uk-scrollspy-init-inview uk-scrollspy-inview uk-animation-slide-bottom animated">
                    <div class="uk-text-center uk-margin-bottom">
                        <i class="material-icons icon_large icon_dark"></i>
                    </div>
                    <h3 class="heading_c uk-text-center">Heading</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, odio.</p>
                </div>
                <div class="uk-margin-top uk-scrollspy-inview uk-animation-slide-bottom animated">
                    <div class="uk-text-center uk-margin-bottom">
                        <i class="material-icons icon_large icon_dark"></i>
                    </div>
                    <h3 class="heading_c uk-text-center">Heading</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, odio.</p>
                </div>
                <div class="uk-margin-top uk-scrollspy-inview uk-animation-slide-bottom animated">
                    <div class="uk-text-center uk-margin-bottom">
                        <i class="material-icons icon_large icon_dark"></i>
                    </div>
                    <h3 class="heading_c uk-text-center">Heading</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, odio.</p>
                </div>
                <div class="uk-margin-top uk-scrollspy-inview uk-animation-slide-bottom animated">
                    <div class="uk-text-center uk-margin-bottom">
                        <i class="material-icons icon_large icon_dark md-color-red-500"></i>
                    </div>
                    <h3 class="heading_c uk-text-center">Heading</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, odio.</p>
                </div>
                <div class="uk-margin-top uk-scrollspy-inview uk-animation-slide-bottom animated">
                    <div class="uk-text-center uk-margin-bottom">
                        <i class="material-icons icon_large icon_dark"></i>
                    </div>
                    <h3 class="heading_c uk-text-center">Heading</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, odio.</p>
                </div>
            </div>
        </div>
</section> 
@endsection