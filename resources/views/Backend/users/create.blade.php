@extends('Backend.pages.master')
@section('breadcrumb')
<h4 class="m-0">Create New User</h4>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
@endsection
@section('content')
<!-- general form elements -->
<div class="col-md-12">
    <div class="card card-default">
        <div class="card-header">
        <h2 class="card-title">Create New User</h2>
            <div class="card-tools">
                <a class="btn btn-success" href="{{ route('users.index') }}"><i class="fa fa-angle-double-left"></i> Back To User List</a>
            </div>
        </div>

        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{ route('users.store') }}">
          @csrf
            <div class="input-group input-group-outline my-3">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" name="name" value="{{ old("name")}}">
              <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>
            <div class="input-group input-group-outline my-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email" value="{{ old("email")}}">
              <span class="text-danger">{{ $errors->first('email') }}</span>
            </div>
            <div class="input-group input-group-outline my-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="password" value="{{ old("password")}}">
              <span class="text-danger">{{ $errors->first('password') }}</span>
            </div>
            <div class="input-group input-group-outline my-3">
              <label class="form-label">Confirm Password</label>
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
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>        
          </div>
        </form>
    </div>
    <!-- /.card -->
</div>

@endsection
