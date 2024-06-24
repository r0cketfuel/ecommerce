<div class="products-list-container">
    @if (count($items))
        <ul class="product-list">
            @each('shop.products.product-card', $items, 'item')
        </ul>
    @else
        <p class="text-center mt40">{{ __('messages.emptyProductList') }}</p>
    @endif
</div>