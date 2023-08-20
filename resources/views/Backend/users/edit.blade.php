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
@section('title', 'Sửa người dùng')
@section('breadcrumb')
<h4 class="m-0">Edit User</h4>
@endsection
@section('content')
<!-- general form elements -->
<div class="col-md-12">
    <div class="card card-default">
        <div class="card-header">
            <h2 class="card-title">Edit User</h2>
            <div class="card-tools">
                <a class="btn btn-success" href="{{ route('users.index') }}"><i class="fa fa-angle-double-left"></i>  Back To User List</a>
            </div>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        {!! Form::model($user, ['method' => 'PATCH', 'enctype' => 'multipart/form-data', 'route' => ['users.update', $user->id]]) !!}
        <div class="card-body">        

                <div class="input-group input-group-static mb-4">
                    <label class="requied">Name:</label>
                    {!! Form::text('name', null, array('value' => '{{ old("name") }}', 'placeholder' => 'Name','class' => 'form-control')) !!}
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                </div>
                <div class="input-group input-group-static mb-4">
                    <label class="requied">Email:</label>
                    {!! Form::text('email', null, array('value' => '{{ old("email") }}', 'placeholder' => 'Email','class' => 'form-control')) !!}
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>
                <div class="input-group input-group-static mb-4">
                        <label class="requied">Phone:</label>
                        {!! Form::number('phone', null, array('value' => '{{ old("phone") }}', 'placeholder' => 'Phone','class' => 'form-control')) !!}
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>
                <div class="input-group input-group-static mb-4">
                        <label class="requied">Address:</label>
                        {!! Form::textarea('address', null, array('value' => '{{ old("address") }}', 'placeholder' => 'Address','class' => 'form-control')) !!}
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>
                    {{-- <div class="input-group input-group-outline my-3">
                        <div class="form-group">
                            <strong>Password:</strong>
                            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        </div>
                    </div>
                    <div class="input-group input-group-outline my-3">
                        <div class="form-group">
                            <strong>Confirm Password:</strong>
                            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                            <span class="text-danger">{{ $errors->first('confirm-password') }}</span>
                        </div>
                    </div> --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Role:</strong>
                        {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control', 'id' => 'choices-multiple-remove-button', 'multiple')) !!}
                        <span class="text-danger">{{ $errors->first('roles') }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label>Giới tính</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender_male" value="0" {{ $user->gender === 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="gender_male">Nam</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender_female" value="1" {{ $user->gender === 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="gender_female">Nữ</label>
                    </div>
                </div>
                <div class="file_input_div">
                    <div class="file_input">
                        <label class="image_input_button mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect mdl-button--colored">
                            <i class="material-icons">file_upload</i>
                            <input name="image" id="file_input_file" class="none" type="file" />
                        </label>
                    </div>
                    <div id="file_input_text_div" class="mdl-textfield mdl-js-textfield textfield-demo">
                        <img src="{{ asset('storage/' . $user->image) }}" id="show-image" alt="">
                        <input class="file_input_text mdl-textfield__input" type="text" disabled readonly id="file_input_text" placeholder="Upload image" />
                        <label class="mdl-textfield__label" for="file_input_text"></label>
                    </div>
                </div>
                  
        <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>        
                </div>
        {!! Form::close() !!}
        </div>
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

    // Lấy URL của ảnh đã có và hiển thị nếu có
    var existingImage = $("#show-image").attr("src");
    if (existingImage) {
        $('#show-image').css('width', '100').css('height', '100').attr('src', existingImage);
    }
});
    </script>
@endsection