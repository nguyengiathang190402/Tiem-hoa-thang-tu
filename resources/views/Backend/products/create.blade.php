@extends('Backend.pages.master')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    /* body {
  display: flex;
} */

    .file_input_div {
        margin: auto;
        width: 250px;
        height: 40px;
    }

    .file_input {
        float: left;
    }

    #file_input_text_div {
        width: 200px;
        margin-top: -8px;
        margin-left: 5px;
    }

    .none {
        display: none;
    }
</style>
@section('content')
@section('title', 'Thêm mới sản phẩm')
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Thêm Sản phẩm</h5>
        <div class="card-tools">
            <a class="btn btn-success" href="{{ route('products.index') }}"><i class="fas fa-angle-double-left"></i> Về
                danh sách sản phẩm</a>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card-body">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group input-group-static mb-4">
                <label class="required">Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                    id="name" value="{{ old('name', '') }}" required>
                @if ($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
            </div>
            <div class="input-group input-group-static mb-4">
                <label for="description">{{ trans('cruds.productCategory.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                    id="description">{{ old('description') }}</textarea>
                @if ($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.description_helper') }}</span>
            </div>
            <div class="input-group input-group-static mb-4">
                <label class="required">Giá</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number"
                    name="price" id="price" value="{{ old('price', '') }}" step="0.01" required>
                @if ($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.price_helper') }}</span>
            </div>
            <div class="input-group input-group-static mb-4">
                <label class="required" for="categories">{{ trans('cruds.product.fields.category') }}</label>
                <select class="form-control select2" name="categories" id="categories">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ in_array($category->id, (array) old('categories', [])) ? 'selected' : '' }}>
                            @if ($category->parentCategory && $category->parentCategory->parentCategory)
                                {{ $category->parentCategory->parentCategory->name }} /
                            @endif
                            @if ($category->parentCategory)
                                {{ $category->parentCategory->name }} /
                            @endif
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('categories'))
                    <div class="invalid-feedback">
                        {{ $errors->first('categories') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="form-label">{{ trans('cruds.product.fields.tag') }}</label>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]"
                    id="tags" multiple>
                    {{-- <option value="">Select a category</option> --}}
                    @foreach ($tags as $id => $tag)
                        <option value="{{ $id }}" {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>
                            {{ $tag }}</option>
                    @endforeach
                </select>
                @if ($errors->has('tags'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tags') }}
                    </div>
                @endif
                <span class="form-help">{{ trans('cruds.product.fields.tag_helper') }}</span>
            </div>
            &nbsp;
            <div></div>
            &nbsp;

            <div class="attribute-value-row">
                <label class="text-center text-uppercase text-secondary text-s font-weight-bolder text-danger"
                    for="attributeSelect">Chọn thuộc tính:</label>
                <select class="col-4 select2 attribute-select" name="selected_attributes[]" id="attributeSelect">
                    <option value="" disabled>-- Chọn thuộc tính --</option>
                    @foreach ($attributes as $attribute)
                        <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                    @endforeach
                </select>

                <label class="text-center text-uppercase text-secondary text-s font-weight-bolder text-danger"
                    for="valueSelect">Chọn giá trị:</label>
                <span class=" value-select-container" id="valueSelectContainer">
                    <!-- Các tùy chọn giá trị sẽ được thêm vào đây -->
                </span>

                <button class="btn btn-secondary add-attribute-value">Thêm</button>
            </div>

            {{-- <input type="hidden" id="selectedAttributeId" name="selected_attribute_id"> --}}
            <div id="attributeValueRows">
                <!-- Các hàng về thuộc tính và giá trị sẽ được thêm ở đây -->
            </div>
            &nbsp;
            <div class="input-group input-group-static mb-4">
                <label class="required">Số lượng</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number"
                    name="quantity" id="quantity" value="{{ old('quantity', '') }}" step="0.01">
                @if ($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
            </div>
            <div class="input-group input-group-static mb-4">
                <label class="required" for="slug">{{ trans('cruds.product.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text"
                    name="slug" id="slug" value="{{ old('slug', '') }}" required>
                @if ($errors->has('slug'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.slug_helper') }}</span>
            </div>
            <div class="file_input_div">
                <div class="file_input">
                    {{-- <label for="form-control"></label> --}}
                    <label
                        class="image_input_button mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect mdl-button--colored">
                        <i class="material-icons">file_upload</i>
                        <input name="image" id="file_input_file" class="none" type="file" />
                    </label>
                </div>
                <div id="file_input_text_div" class="mdl-textfield mdl-js-textfield textfield-demo">
                    <input class="file_input_text mdl-textfield__input" type="text" disabled readonly
                        id="file_input_text" placeholder="Upload image" />
                    <label class="mdl-textfield__label" for="file_input_text"></label>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('admin/assets/js/product/product-attribute.js') }}"></script>
<script>
    var attributesData = {!! json_encode($attributes) !!};
</script>
<script>
    const valueSelect = $('#valueSelect');
    $(document).ready(function() {
        // Initialize Select2 for the category select

        // Dropzone options
        Dropzone.options.photoDropzone = {
            // ... (Dropzone configuration)
        };

        // Ajax request to generate slug
        $('#name').change(function(e) {
            $.get('{{ route('products.checkSlug') }}', {
                    'name': $(this).val()
                },
                function(data) {
                    $('#slug').val(data.slug);
                }
            );

        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"
    integrity="sha512-WFN04846sdKMIP5LKNphMaWzU7YpMyCU245etK3g/2ARYbPK9Ub18eG+ljU96qKRCWh+quCY7yefSmlkQw1ANQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('plugin/ckeditor5-build-classic/ckeditor.js') }}"></script>

<script src="{{ asset('admin/assets/js/product/product.js') }}"></script>

@endsection
