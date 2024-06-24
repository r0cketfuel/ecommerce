@if(session('infoComercio.whatsapp'))
    <div class="chat">
        <a href="https://wa.me/{{ session('infoComercio.whatsapp') }}" target="_blank">
            <div class="chat-bubble chat-bubble-whatsapp">
                <i class="chat-icon fa-brands fa-whatsapp"></i>
            </div>
        </a>
    </div>
@endif