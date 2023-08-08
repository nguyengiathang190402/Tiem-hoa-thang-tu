@extends('Backend.pages.master')
@section('breadcrumb')
<h4 class="m-0">Users Management</h4>
@endsection
@section('content')


<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h2 class="card-title">Users Management</h2>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive">
      @can('user-create')
      <a href="{{ route('users.create') }}" class="btn btn-success"><i class="fas fa-plus-square"></i> Thêm sản phẩm</a>
    </a>
      {{-- <a class="btn btn-success" href="{{ route('users.create') }}"><i class="fas fa-plus-square"></i> Add User</a> --}}
      @endcan
      <div class="table-responsive">
      <table class="table align-items-center mb-0">
        <thead>
      <tr>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Roles</th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
      </tr>
        </thead>
    
      @foreach ($users as $key => $user)

        <tr>
          <td>{{ ++$key }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td class="text-center">
            @if(!empty($user->getRoleNames()))
              @foreach($user->getRoleNames() as $v)
                <span class="badge bg-success">{{ $v }}</span>
              @endforeach
            @endif
          </td>
          <td class="text-center"> 
            @can('user-edit')
            <a class="btn btn-sm btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
            @endcan            
            @can('user-delete')
            <form method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}">
              @csrf
              @method('DELETE')
              <button type="submit" name="delete" style="display:inline" class="btn btn-sm btn-danger delete_confirm" data-toggle="tooltip" title='Delete' href="{{ route('users.destroy', $user->id) }}">Delete</button>            
            </form>
            {{-- <input class="btn btn-sm btn-danger delete_confirm" name="delete" style="display:inline" href="{{ route('users.destroy', $user->id) }}" type="submit" value="Delete"> --}}
            @endcannot
          </td>
        </tr>

      @endforeach
      </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
      <div class="float-left">
          <div class="dataTables_info">
              Hiển thị {{ $users->firstItem() }} đến {{ $users->lastItem() }} của {{ $users->total() }} mục
          </div>
      </div>
      <div class="float-right">
          {{ $users->links() }}
      </div>
    </div>
  </div>
</div>
  <!-- /.card -->
</div>
@endsection 
