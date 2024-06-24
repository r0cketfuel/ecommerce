<div class="newsletter">
    <div class="newsletter-container" id="newsletter-container">
        @if (!session("shop.newsletter"))
            <p>{{ __('general.suscription_msg') }}</p>

            <div class="newsletter-suscription-bar" id="newsletter-suscription-bar">
                <input 	form="form-suscribe" type="email" id="suscribe" name="email" placeholder="{{ __('general.email') }}" autocomplete="off">
                <button form="form-suscribe" class="btn-secondary">{{ __('buttons.suscribe') }}</button>
            </div>
            <div id="newsletter-suscription-msg" style="display: none;">
                <p></p>
            </div>
        @endif
        
        @if (session("infoComercio.facebook") || session("infoComercio.twitter") || session("infoComercio.instagram") || session("infoComercio.pinterest"))
            <p>{{ __('general.follow_msg') }}:</p>
            <div class="newsletter-follow">
                @if(session("infoComercio.facebook"))	<div><a href="{{session('infoComercio.facebook') }}"><i class="fa-brands fa-facebook fa-xl"></i></a></div>@endif
                @if(session("infoComercio.twitter")) 	<div><a href="{{session('infoComercio.twitter')  }}"><i class="fa-brands fa-x-twitter fa-xl"></i></a></div>@endif
                @if(session("infoComercio.instagram")) 	<div><a href="{{session('infoComercio.instagram')}}"><i class="fa-brands fa-instagram fa-xl"></i></a></div>@endif
                @if(session("infoComercio.pinterest")) 	<div><a href="{{session('infoComercio.pinterest')}}"><i class="fa-brands fa-pinterest fa-xl"></i></a></div>@endif
				@if(session("infoComercio.tiktok")) 	<div><a href="{{session('infoComercio.tiktok')}}"><i class="fa-brands fa-tiktok fa-xl"></i></a></div>@endif
            </div>
        @endif
    </div>
</div>
<form id="form-suscribe" method="post" action="/suscribe">@csrf</form>
