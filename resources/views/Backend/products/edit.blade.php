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
    <h2>Sửa Sản Phẩm</h2>
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
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="input-group input-group-static mb-4">
            <label class="required">Name</label>
            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required>
            @if($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>
        <div class="input-group input-group-static mb-4">
          <label for="description">{{ trans('cruds.productCategory.fields.description') }}</label>
          <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $product->description) }}</textarea>
          @if($errors->has('description'))
              <div class="invalid-feedback">
                  {{ $errors->first('description') }}
              </div>
          @endif
      </div>
        <div class="input-group input-group-static mb-4">
          <label class="required">Giá</label>
          <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" required>
          @if($errors->has('price'))
              <div class="invalid-feedback">
                  {{ $errors->first('price') }}
              </div>
          @endif
        </div>
        <div class="input-group input-group-static mb-4">
          <label class="required" for="categories">{{ trans('cruds.product.fields.category') }}</label>
          <select class="form-control select2" name="categories[]" id="categories" multiple>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
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
          @if($errors->has('categories'))
              <div class="invalid-feedback">
                  {{ $errors->first('categories') }}
              </div>
          @endif
        </div>
        
        
        <div class="form-group">
          <label class="form-label">{{ trans('cruds.product.fields.tag') }}</label>
          <select class="form-control select2" name="tags[]" id="tags" multiple>
              @foreach($tags as $id => $tag)
                  <option value="{{ $id }}" {{ in_array($id, $product->tags->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $tag }}</option>
              @endforeach
          </select>
          @if($errors->has('tags'))
              <div class="invalid-feedback">
                  {{ $errors->first('tags') }}
              </div>
          @endif
      </div>
      &nbsp;
      <div></div>
      &nbsp;

      @foreach ($productAttributes as $attribute)
            <div class="attribute-value-row">
                <label class="text-center text-uppercase text-secondary text-s font-weight-bolder text-danger" for="attributeSelect{{ $attribute->id }}">Chọn thuộc tính:</label>
                <select class="col-4 select2 attribute-select" name="selected_attributes[]" id="attributeSelect{{ $attribute->id }}">
                    <option value="" disabled>-- Chọn thuộc tính --</option>
                    @php
                        $isSelectedAttribute = $selectedAttributes->contains('id', $attribute->id);
                    @endphp
                    <option value="{{ $attribute->id }}" {{ $isSelectedAttribute ? 'selected' : '' }}>
                        {{ $attribute->name }}
                    </option>
                </select>

                <label class="text-center text-uppercase text-secondary text-s font-weight-bolder text-danger" for="valueSelect{{ $attribute->id }}">Chọn giá trị:</label>
                <span class="value-select-container" id="valueSelectContainer{{ $attribute->id }}">
                    <select class="col-4 select2 value-select" name="selected_attribute_values[{{ $attribute->id }}][]" id="valueSelect{{ $attribute->id }}" multiple>
                        @foreach ($attribute->attributeValues as $attributeValue)
                            <option value="{{ $attributeValue->id }}"
                                @if (in_array($attributeValue->id, $selectedAttributeValues[$attribute->id] ?? [])) selected @endif>
                                {{ $attributeValue->value }}
                            </option>
                        @endforeach
                    </select>
                </span>
                <button class="btn btn-secondary add-attribute-value">Thêm</button>
            </div>
        @endforeach
        <div id="attributeValueRows">
            <!-- ... (Existing attribute value rows) ... -->
        </div>
        
        &nbsp;
        <div class="input-group input-group-static mb-4">
            <label class="required">Số lượng</label>
            <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number"
                name="quantity" id="quantity" value="{{ old('quantity', $product->quantity) }}" step="0.01">
            @if ($errors->has('quantity'))
                <div class="invalid-feedback">
                    {{ $errors->first('quantity') }}
                </div>
            @endif
        </div>
        <div class="input-group input-group-static mb-4">
          <label class="required" for="slug">{{ trans('cruds.product.fields.slug') }}</label>
          <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $product->slug) }}" required>
          @if($errors->has('slug'))
              <div class="invalid-feedback">
                  {{ $errors->first('slug') }}
              </div>
          @endif
        </div>
        &nbsp;
        <div class="file_input_div">
            <div class="file_input">
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
        <div>
            <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
        </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('admin/assets/js/product/product-attribute.js') }}"></script>
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

