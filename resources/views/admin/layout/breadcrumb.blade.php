@if(isset($breadcrumbs))
    <div class="breadcrumb">
        <a href="/admin"><i class="fa-solid fa-house-chimney fa-sm"></i> Home</a>
        
        @foreach($breadcrumbs as $breadcrumb)
            > <a href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['title'] }}</a>
        @endforeach
        
        > {{ $title }}
    </div>
@endif

<h1>{{ $title }}</h1>