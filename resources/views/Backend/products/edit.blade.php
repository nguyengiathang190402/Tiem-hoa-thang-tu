@extends('Backend.pages.master')
<style>
    body {
  display: flex;
}

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
<div class="container">
    <h2>Sửa Sản Phẩm</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="input-group input-group-static mb-4">
            <label>Name</label>
            {!! Form::text('name', $product->name, array('class' => 'form-control', 'id' => 'name')) !!}
        </div>
        <div class="input-group input-group-static mb-4">
            <label>Mô tả</label>
            {!! Form::textarea('description', $product->description, array('class' => 'form-control', 'id' => 'description', 'placeholder' => 'Mô tả', 'spellcheck' => "false")) !!}
        </div>
        <div class="input-group input-group-static mb-4">
            <label>Giá</label>
            {!! Form::number('price', $product->price, array('class' => 'form-control', 'id' => 'price')) !!}
        </div>
        <label class="input-group input-group-outline my-3">Danh mục:</label>
            <div class="col-md-6"> 
                <select class="form-control" id="choices-multiple-remove-button" name="category_id">
                    <option value="">Chọn danh mục</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        <hr>
        <div class="file_input_div">
            <div class="file_input">
                {{-- <label for="form-control"></label> --}}
              <label class="image_input_button mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect mdl-button--colored">
                <i class="material-icons">file_upload</i>
                <input name="image" id="file_input_file" class="none" type="file" />
              </label>
            </div>
            <div id="file_input_text_div" class="mdl-textfield mdl-js-textfield textfield-demo">
            @if ($product->image)
                <img src="{{ route('product.image', ['filename' => basename($product->image)]) }}" alt="{{ $product->name }}" width="100">
            @else
                <span>Không có ảnh</span>
            @endif
              <input class="file_input_text mdl-textfield__input" type="text" disabled readonly id="file_input_text" />
              <label class="mdl-textfield__label" for="file_input_text"></label>
            </div>
          </div>
        <button type="submit" class="btn btn-primary">Cập nhật Sản Phẩm</button>
    </form>
</div>
@endsection
