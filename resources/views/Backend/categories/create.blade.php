@extends('Backend.pages.master')
@section('content')

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Thêm danh mục</h2>
            <div class="card-tools">
            <a class="btn btn-success" href="{{ route('product-categories.index') }}"><i class="fas fa-angle-double-left"></i> về danh sách danh mục</a>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("product-categories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="input-group input-group-static mb-4">
                <label class="required" for="name">{{ trans('cruds.productCategory.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productCategory.fields.name_helper') }}</span>
            </div>
            <div class="input-group input-group-static mb-4">
                <label for="description">{{ trans('cruds.productCategory.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productCategory.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo">{{ trans('cruds.productCategory.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                    
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productCategory.fields.photo_helper') }}</span>
            </div>
            <div class="input-group input-group-static mb-4">
                <label for="category_id">{{ trans('cruds.productCategory.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id">
                    <option value="">{{ trans('global.pleaseSelect') }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @foreach($category->childCategories as $childCategory)
                            <option value="{{ $childCategory->id }}" {{ old('category_id') == $childCategory->id ? 'selected' : '' }}>-- {{ $childCategory->name }}</option>
                        @endforeach
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productCategory.fields.category_helper') }}</span>
            </div>
            
            <div class="input-group input-group-static mb-4">
                <label class="required" for="slug">{{ trans('cruds.productCategory.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', '') }}" required>
                @if($errors->has('slug'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productCategory.fields.slug_helper') }}</span>
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

