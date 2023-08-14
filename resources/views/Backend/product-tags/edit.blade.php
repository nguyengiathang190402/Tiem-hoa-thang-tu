@extends('Backend.pages.master')
@section('content')

<div class="card">
    <div class="card-header">
            <h5 class="card-title">Edit Tag</h5>
            <div class="card-tools">
                <a class="btn btn-success" href="{{ route('product-tags.index') }}"><i class="fas fa-angle-double-left"></i> Về danh mục tag</a>
            </div>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("product-tags.update", [$productTag->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="input-group input-group-static mb-4">
                <label class="required" for="name">Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $productTag->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productTag.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection