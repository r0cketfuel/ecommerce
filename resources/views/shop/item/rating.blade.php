<div class="product-rating">
    <div class="product-stars">
        @for($i=1;$i<=(int)($ratings->promedio);$i++)
            <span><i class='fa-solid fa-star'></i></span>
        @endfor
        @for($i=(int)($ratings->promedio+1);$i<=5;$i++)
            <span><i class='fa-regular fa-star'></i></span>
        @endfor
        <div class="product-average">{{ _number($ratings->promedio) }} / {{ _number(5) }}</div>
    </div>
    <div class="product-votes">{{ $ratings->puntuaciones }} {{ __('general.votes') }}</div>
</div>