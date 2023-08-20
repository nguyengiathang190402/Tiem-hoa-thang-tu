@extends('Backend.pages.master')
@section('title', 'Xem chi tiết người dùng')
@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="card-title">Xem chi tiết User</h5>
        <div class="card-tools">
            <a class="btn btn-success" href="{{ route('users.index') }}"><i class="fas fa-angle-double-left"></i> Về danh sách User</a>
        </div>
</div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>{{ trans('cruds.productTag.fields.id') }}</th>
                        <td>{{ $users->id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $users->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $users->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $users->phone ?? 'Không có thông tin' }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $users->address ?? 'Không có thông tin' }}</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>{{ $users->gender == 0 ? 'Nam' : 'Nữ' }}</td>
                    </tr>
                    <tr>
                        <th>Avatar</th>
                        <td>
                            @if ($users->image)
                                <img src="{{ asset('storage/' . $users->image) }}" alt="Avatar" width="80">
                            @else
                                <img src="{{ asset('admin/assets/img/default.jpeg')}}" alt="" width="80"> Default
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="card-tools">
                <a class="btn btn-success" href="{{ route('users.index') }}"><i class="fas fa-angle-double-left"></i> Về danh sách User</a>
            </div>
        </div>
    </div>
</div>



@endsection