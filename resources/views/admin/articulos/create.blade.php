@extends("admin.layout.master")

@php
    $title = "Nuevo artículo";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}modal.css">
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}layout.css">
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}panel.css">
@endsection

@section("js")
    <script defer src="{{ config('constants.admin_js') }}nuevo.js"></script>
@endsection

@php
    $breadcrumbs = [
        ['link' => '/admin/articulos', 'title' => 'Artículos'],
    ];
@endphp

@section("body")
    @include('admin.articulos.modals.categoria')
    @include('admin.articulos.modals.subcategoria')
    
    <div class="grid grid-cols-12 grid-align-start gap-3">
        <div class="col-span-6 col-span-900p-12">
            <div class="panel">
                <div class="panel-title">Datos del producto</div>
                <div class="panel-content">
                    <fieldset>
                        <legend>Categoría</legend>
                        <div class="flex gap-3">
                            <select form="form" id="categoria_id" name="categoria" value="{{ old('categoria') }}">
                                <option value="" disabled selected>Categoría</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria['id'] }}">{{ $categoria['nombre'] }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn-secondary openModal w50px" id="boton_agregar_categoria"><i class="fa-solid fa-plus"></i></button>
                        </div>

                        <div class="flex gap-3">
                            <select form="form" id="subcategoria_id" name="subcategoria" disabled value="{{ old('subcategoria') }}">
                                <option value="" disabled selected>Subcategoría</option>
                            </select>
                            <button type="button" class="btn-secondary openModal w50px" id="boton_agregar_subcategoria"><i class="fa-solid fa-plus"></i></button>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Datos principales</legend>
                            <label>
                                Codigo
                                <input form="form" type="text" name="codigo" class="{{ $errors->has('codigo') ? 'form-error' : '' }}" value="{{ old('codigo') }}" required>
                            </label>
                            @if ($errors->has('codigo'))
                                <p class="field-validation-msg"><i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first('codigo') }}</p>
                            @endif

                        <div class="flex">
                            <label>
                                Nombre
                                <input form="form" type="text" name="nombre" class="{{ $errors->has('nombre') ? 'form-error' : '' }}" value="{{ old('nombre') }}" required>
                            </label>
                            @if ($errors->has('nombre'))
                                <p class="field-validation-msg"><i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first('nombre') }}</p>
                            @endif
                        </div>
                        <div class="flex">
                            <label>
                                Descripción
                                <input form="form" type="text" name="descripcion" class="{{ $errors->has('descripcion') ? 'form-error' : '' }}" value="{{ old('descripcion') }}" required>
                            </label>
                            @if ($errors->has('descripcion'))
                                <p class="field-validation-msg"><i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first('descripcion') }}</p>
                            @endif
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Datos principales</legend>
                        <div class="flex">
                            <label>
                                Precio
                                <input form="form" type="text" name="precio" class="{{ $errors->has('precio') ? 'form-error' : '' }}" value="{{ old('precio') }}" required>
                            </label>
                            @if ($errors->has('precio'))
                                <p class="field-validation-msg"><i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first('precio') }}</p>
                            @endif
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Atributos</legend>
                        <div id="clone" class="flex gap-3">
                            <select name="talles[]">
                                <option value="" disabled selected>Talles</option>
                                @foreach ($talles as $talle)
                                    <option value="{{ $talle['id'] }}">{{ $talle['talle'] }}</option>
                                @endforeach
                            </select>
                            <input form="form" type="number" name="stock[]" placeholder="Stock" min="1" required>
                            <input form="form" type="color"  name="color[]">
                            <button class="btn-danger" onclick="eliminarAtributo(this.parentNode);" style="width: 70px; display: block"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                        <button form="form" type="button" class="btn-secondary" onclick="agregarAtributo();"><span><i class="fa-solid fa-plus"></i></span>Atributo</button>
                    </fieldset>

                    <script>
                        function agregarAtributo() {
                            const cloneDiv = document.querySelector("#clone");
                            let clone = cloneDiv.cloneNode(true);
                            clone.children[1].value = "";
                            clone.children[2].value = "";
                            clone.removeAttribute("id");
                            cloneDiv.after(clone);
                        }

                        function eliminarAtributo(element) {
                            if (element.id != "clone")
                                element.remove();
                        }
                    </script>

                    <fieldset>
                        <legend>Presentación</legend>
                        <label>
                            Detalle del artículo
                            <textarea id="detalle" name="detalle" form="form">{{ old('detalle') }}</textarea>
                        </label>
                    </fieldset>

                    <button form="form" type="submit" class="btn-primary"><span><i class="fa-solid fa-plus"></i></span>Publicar artículo</button>
                </div>
            </div>
        </div>

        <div class="col-span-6 col-span-900p-12">
            <div class="panel">
                <div class="panel-title">Imágenes</div>
                <div class="panel-content">
                    <legend>Imagen principal</legend>
                    <div class="cropme" id="landscape" style="width: 100%; height: 285px; border: 1px dashed #ddd; background: #f1f1f1;">
                        <a href="javascript:;" id="crop-image" class="d-inline-block mybtn1"><i class="icofont-upload-alt"></i> Upload Image Here</a>
                    </div>
                    <input type="hidden" id="feature_photo" name="photo" value="">
                </div>
            </div>
        </div>
    </div>

    <form id="form" method="post" enctype="multipart/form-data" action="{{ route('articulos.store') }}">@csrf</form>
@endsection
