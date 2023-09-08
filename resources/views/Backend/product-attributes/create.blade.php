@extends('Backend.pages.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Thêm thuộc tính mới cho sản phẩm</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('product-attributes.store') }}" method="POST">
                        @csrf
                        <div class="input-group input-group-static mb-4">
                            <label class="required">Name</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name') }}" required>
                            @if($errors->has('name'))
                                <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="input-group input-group-static mb-4">
                            <label class="required" for="type">Type</label>
                            <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="slug" value="{{ old('type') }}">
                            @if($errors->has('type'))
                                <span class="invalid-feedback">{{ $errors->first('type') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="{{ route('product-attributes.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Ajax request to generate slug
        $('#name').change(function(e) {
            $.get('{{ route('attributes.checkSlug') }}', { 'name': $(this).val() },
                function(data) {
                    $('#slug').val(data.slug);
                }
            );
        });
    </script>
@endsection
