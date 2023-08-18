@extends('Backend.pages.master')
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
<div class="card">
  <div class="card-header">
    <h2>Thêm Sản Phẩm</h2>
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
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
            </div>
            <div class="input-group input-group-static mb-4">
              <label for="description">{{ trans('cruds.productCategory.fields.description') }}</label>
              <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
              @if($errors->has('description'))
                  <div class="invalid-feedback">
                      {{ $errors->first('description') }}
                  </div>
              @endif
              <span class="help-block">{{ trans('cruds.product.fields.description_helper') }}</span>
            </div>
          <div class="input-group input-group-static mb-4">
            <label class="required">Giá</label>
            <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01" required>
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.price_helper') }}</span>
          </div>
        <div class="input-group input-group-static mb-4">
          <label class="required" for="categories">{{ trans('cruds.product.fields.category') }}</label>
          {{-- <div style="padding-bottom: 4px">
            <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
            <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
          </div> --}}
        
          {{-- <select class="form-control select2" name="categories" id="categories">
            <option value="">Select a category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
                    @if ($category->parentCategory && $category->parentCategory->parentCategory)
                        {{ $category->parentCategory->parentCategory->name }} /
                    @endif
                    @if ($category->parentCategory)
                        {{ $category->parentCategory->name }} /
                    @endif
                    {{ $category->name }}
                </option>
            @endforeach
        </select> --}}
        <select class="form-control select2" name="categories" id="categories">
          <option value="">Select a category</option>
          @foreach($categories as $category)
              <option value="{{ $category->id }}" {{ in_array($category->id, (array) old('categories', [])) ? 'selected' : '' }}>
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
        {{-- <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple>
          @foreach($categories as $category)
              <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>{{ $category->parentCategory->parentCategory->name }} / {{ $category->parentCategory->name }} / {{ $category->name }}</option>
          @endforeach
      </select> --}}
        @if($errors->has('categories'))
            <div class="invalid-feedback">
                {{ $errors->first('categories') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
        </div>
        <div class="form-group">
          <label class="form-label">{{ trans('cruds.product.fields.tag') }}</label>
          <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
            {{-- <option value="">Select a category</option> --}}
              @foreach($tags as $id => $tag)
                  <option value="{{ $id }}" {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>{{ $tag }}</option>
              @endforeach
          </select>
          @if($errors->has('tags'))
              <div class="invalid-feedback">
                  {{ $errors->first('tags') }}
              </div>
          @endif
          <span class="form-help">{{ trans('cruds.product.fields.tag_helper') }}</span>
      </div>
      &nbsp;
        <div class="file_input_div">
            <div class="file_input">
                {{-- <label for="form-control"></label> --}}
              <label class="image_input_button mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect mdl-button--colored">
                <i class="material-icons">file_upload</i>
                <input name="image" id="file_input_file" class="none" type="file" />
              </label>
            </div>
            <div id="file_input_text_div" class="mdl-textfield mdl-js-textfield textfield-demo">
              <input class="file_input_text mdl-textfield__input" type="text" disabled readonly id="file_input_text" placeholder="Upload image" />
              <label class="mdl-textfield__label" for="file_input_text"></label>
            </div>
          </div>
          
          <div class="input-group input-group-static mb-4">
            <label class="required" for="slug">{{ trans('cruds.product.fields.slug') }}</label>
            <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', '') }}" required>
            @if($errors->has('slug'))
                <div class="invalid-feedback">
                    {{ $errors->first('slug') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.product.fields.slug_helper') }}</span>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
        </div>
    </form>
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
            $.get('{{ route('products.checkSlug') }}', { 'name': $(this).val() },
                function(data) {
                    $('#slug').val(data.slug);
                }
            );
            
        });
    });
</script>
@endsection