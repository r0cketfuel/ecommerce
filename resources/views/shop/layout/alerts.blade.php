@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert danger">
            {{ $error }}
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        </div>
    @endforeach
@endif

@if (session("success"))
    <div class="alert success">
        {{ session("success") }}
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    </div>
@endif

@if (session("error"))
    <div class="alert danger">
        {{ session("error") }}
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    </div>
@endif