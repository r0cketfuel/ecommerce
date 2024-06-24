<ul class="tabs">
    <li class="tab active">Información</li>
    <li class="tab">Reseñas({{ count($item->review) }})</li>
</ul>

<div class="tab-content">
    @if($item->detalle)
        {!! $item->detalle->detalle !!}
    @else
        <p>El artículo no tiene detalle</p>
    @endif
</div>

<div class="tab-content">
    @foreach ($item->review as $review)
        <div class="user-review">
            <div>
                <div class="user-review-picture"><i class="fa-solid fa-user fa-2x"></i></div>
                <div>
                    <div><b>{{ $review->usuario->username }}</b></div>
                    <div>{{ $review->fecha }}</div>
                </div>
            </div>
            <b>{{ $review->titulo }}</b>
            {{ $review->texto }}
        </div>
    @endforeach
</div>
