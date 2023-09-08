@extends('Backend.pages.master')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h1>Sửa thuộc tính cho sản phẩm</h1>
            </div>
            <div class="card-body">
    <form action="{{ route('product-attributes.update', $productAttribute->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="input-group input-group-static mb-4">
            <label class="required">Name</label>
            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ $productAttribute->name }}">
            @if($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
        </div>
        <div class="input-group input-group-static mb-4">
            <label class="required" for="type">Type</label>
            <input class="form-control" type="text" name="type" id="slug" value="{{ $productAttribute->type }}">
            @if($errors->has('type'))
                <div class="invalid-feedback">
                    {{ $errors->first('slug') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.product.fields.slug_helper') }}</span>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
    </div>
    <div class="card-footer">
        <a href="{{ route('product-attributes.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
    </div>
</div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize Select2 for the category select
        $('.select2').select2();

        // Dropzone options
        Dropzone.options.photoDropzone = {
            // ... (Dropzone configuration)
        };

        // Ajax request to generate slug
        $('#name').change(function(e) {
            $.get('{{ route('attributes.checkSlug') }}', { 'name': $(this).val() },
                function(data) {
                    $('#slug').val(data.slug);
                }
                console.log({{ route('products.checkSlug') }});
            );
            
        });
    });
</script>
@endsection
