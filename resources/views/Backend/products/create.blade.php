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
    <h2>Thêm Sản Phẩm</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
            <div class="input-group input-group-outline my-3">
                <label class="form-label">Name</label>
                {!! Form::text('name', null, array('class' => 'form-control', 'id' => 'name')) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group input-group-dynamic">
                {!! Form::textarea('description', null, array('class' => 'form-control', 'id' => 'description', 'placeholder' => 'Mô tả', 'spellcheck' => "false")) !!}
            </div>
        </div>
        <div class="col-md-6">
        <div class="input-group input-group-outline my-3">
            <label class="form-label">Giá</label>
            {!! Form::number('price', null, array('class' => 'form-control', 'id' => 'price')) !!}
          </div>
        </div>
        <label class="input-group input-group-outline my-3">Danh mục:</label>
            <div class="col-md-6"> 
                <select class="form-control" id="choices-multiple-remove-button" name="category_id">
                    <option value="">Chọn danh mục</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
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
              <input class="file_input_text mdl-textfield__input" type="text" disabled readonly id="file_input_text" placeholder="Upload image" />
              <label class="mdl-textfield__label" for="file_input_text"></label>
            </div>
          </div>
        <div>
            <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
        </div>
    </form>
</div>
@endsection
