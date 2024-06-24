@if(isset($breadcrumbs))
    <div class="breadcrumb">
        <a href="/shop"><i class="fa-solid fa-house-chimney fa-xs"></i> Home</a>

        @foreach($breadcrumbs as $breadcrumb)
            <i class="fa-solid fa-chevron-right fa-xs"></i> <a href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['title'] }}</a>
        @endforeach

        <i class="fa-solid fa-chevron-right fa-xs"></i> {{ $title }}
    </div>
@endif

<h1>{{ $title }}</h1>
