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
@section('title', 'Thêm người dùng mới')
@section('breadcrumb')
<h4 class="m-0">Create New User</h4>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
@endsection
@section('content')
<!-- general form elements -->
<div class="card">
        <div class="card-header">
        <h2 class="card-title">Create New User</h2>
            <div class="card-tools">
                <a class="btn btn-success" href="{{ route('users.index') }}"><i class="fa fa-angle-double-left"></i> Back To User List</a>
            </div>
        </div>

        <!-- /.card-header -->
        <!-- form start -->
        <div class="card-body">
        <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
          @csrf
            <div class="input-group input-group-static mb-4">
              <label class="required">Name</label>
              <input type="text" class="form-control" name="name" value="{{ old("name")}}">
              <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>
            <div class="input-group input-group-static mb-4">
              <label class="required">Email</label>
              <input type="email" class="form-control" name="email" value="{{ old("email")}}">
              <span class="text-danger">{{ $errors->first('email') }}</span>
            </div>
            <div class="input-group input-group-static mb-4">
              <label class="required">Address</label>
              <textarea type="text" class="form-control" name="address" value="{{ old("address")}}"></textarea>
              <span class="text-danger">{{ $errors->first('address') }}</span>
            </div>
            <div class="input-group input-group-static mb-4">
              <label class="required">Phone</label>
              <input type="number" class="form-control" name="phone" value="{{ old("phone")}}">
              <span class="text-danger">{{ $errors->first('phone') }}</span>
            </div>
            <div class="input-group input-group-static mb-4">
              <label class="required">Password</label>
              <input type="password" class="form-control" name="password" value="{{ old("password")}}">
              <span class="text-danger">{{ $errors->first('password') }}</span>
            </div>
            <div class="input-group input-group-static mb-4">
              <label class="required">Confirm Password</label>
              <input type="password" class="form-control" name="confirm-password" value="{{ old("confirm-password")}}">
              <span class="text-danger">{{ $errors->first('confirm-password') }}</span>
            </div>
            {{-- @dd($roles); --}}
            <label class="input-group input-group-outline my-3">Role</label>
                <div class="col-md-12"> 
                  {!! Form::select('roles[]', $roles,[], array('value' => '{{ old("roles") }}', 'class' => 'form-control','id' => 'choices-multiple-remove-button', 'multiple')) !!}
                  {{-- <select value="{{ old("roles")}}" name="roles[]" id="choices-multiple-remove-button" placeholder="Role" multiple>
                        <option value="">{{ $role }}</option>
                    </select> </div> --}}
            <div class="form-check input-group input-group-static mb-4">
              <div class="form-group">
                  <label>Giới tính</label><br>
                  <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="gender" id="gender_male" value="0" checked>
                      <label class="form-check-label" for="gender_male">Nam</label>
                  </div>
                  <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="gender" id="gender_female" value="1">
                      <label class="form-check-label" for="gender_female">Nữ</label>
                  </div>
              </div>
            </div>
            <div class="file_input_div">
              <div class="file_input">
                  {{-- <label for="form-control"></label> --}}
                <label class="image_input_button mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect mdl-button--colored">
                  <i class="material-icons">file_upload</i>
                  <input name="image" id="file_input_file" class="none" type="file" />
                </label>
              </div>
              <div id="file_input_text_div" class="mdl-textfield mdl-js-textfield textfield-demo">
                <img src="" id="show-image" alt="">
                <input class="file_input_text mdl-textfield__input" type="text" disabled readonly id="file_input_text" placeholder="Upload image" />
                <label class="mdl-textfield__label" for="file_input_text"></label>
              </div>
              
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>        
          </div>
        </form>
    </div>
    <!-- /.card -->
</div>

@endsection
@section('scripts')

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var img = new Image();
                img.src = e.target.result;

                img.onload = function() {
                    var maxWidth = 100; // Kích thước tối đa theo chiều rộng
                    var maxHeight = 100; // Kích thước tối đa theo chiều cao

                    var width = img.width;
                    var height = img.height;

                    // Tính toán kích thước mới sao cho vừa trong giới hạn
                    if (width > height) {
                        if (width > maxWidth) {
                            height *= maxWidth / width;
                            width = maxWidth;
                        }
                    } else {
                        if (height > maxHeight) {
                            width *= maxHeight / height;
                            height = maxHeight;
                        }
                    }

                    // Hiển thị ảnh đã điều chỉnh kích thước
                    $('#show-image').attr('src', e.target.result).css({
                        width: width,
                        height: height
                    });
                };
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#file_input_file").change(function() {
        readURL(this);
    });
});
    </script>
@endsection
