<div class="modal" id="modal-add">
    <div class="modal-container" style="width: 600px">
        <div class="modal-header">
            <div class="modal-title">
                <h1>{{ __('general.additemtocart') }}</h1>
            </div>
            <span class="modal-close" onclick="closeModal(this.parentElement.parentElement.parentElement.id)">X</span>
        </div>

        <div class="modal-addItem" style="padding-top: 50px;">
            <div class="modal-addItem-leftPanel">
                <img id="image" src="{{ config('constants.product_images') . '/no-image.png' }}" alt="imagen">
            </div>
            <div class="modal-additem-rightPanel">
                <!-- Precio -->
                <div class="flex justify-content-between align-items-center">
                    <div>{{ __('general.price') }}:</div>
                    <div id="precio">-</div>
                </div>
                <!-- /Precio -->

                <!-- Atributo Tamaño -->
                <div class="flex justify-content-between align-items-center">
                    <div>{{ __('general.sizes') }}:</div>
                    <div class="flex">
                        <select id="sizes">
                            <option value="" disabled selected>{{ __('general.select_option') }}</option>
                        </select>
                    </div>
                </div>
                <!-- /Atributo Tamaño -->
                
                <!-- Atributo Color -->
                <div class="flex justify-content-between align-items-center">
                    <div>{{ __('general.colors') }}:</div>
                    <div class="flex">
                        <select id="colors">
                            <option value="" disabled selected>{{ __('general.select_option') }}</option>
                        </select>
                    </div>
                </div>
                <!-- /Atributo Color -->

                <!-- Stock disponible -->
                <div class="flex justify-content-between align-items-center">
                    <div>{{ __('general.stock_available') }}:</div>
                    <div id="stock">-</div>
                </div>                         
                <!-- /Stock disponible -->

                <!-- Cantidad -->
                <div id="qtyControl" class="flex justify-content-between align-items-center">
                    <div>{{ __('general.quantity') }}:</div>
                    <div class="flex" style="max-width: 120px">
                        <button id="minusButton" class="minusButton"><i class="fa-solid fa-minus"></i></button>
                        <input 	id="addToCartQty" class="addToCartQty" type="number">
                        <button id="plusButton" class="plusButton"><i class="fa-solid fa-plus"></i></button>
                    </div>
                </div>

                <!-- subtotal -->
                <div class="flex justify-content-between align-items-center">
                    <div>{{ __('general.subtotal') }}:</div>
                    <div id="subtotal">-</div>
                </div>

                <button id="button_addToCart" class="btn-primary"><span><i class="fa-solid fa-cart-plus"></i></span>{{ __('buttons.addToCart') }}</button>
            </div>

        </div>
    </div>
</div>