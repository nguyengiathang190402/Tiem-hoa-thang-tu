@extends('Backend.pages.master')
@section('title', 'Danh sách người dùng')
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
      <a href="{{ route('users.create') }}" class="btn btn-success"><i class="fas fa-plus-square"></i> Tạo tài khoản</a>
    </a>
      {{-- <a class="btn btn-success" href="{{ route('users.create') }}"><i class="fas fa-plus-square"></i> Add User</a> --}}
      @endcan
      <div class="table-responsive">
      <table class="table align-items-center mb-0">
        <thead>
      <tr>
        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">No.</th>
        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Name</th>
        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Email</th>
        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Roles</th>
        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Status</th>
        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Action</th>
        {{-- <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">manage status</th> --}}
      </tr>
        </thead>
    
      @foreach ($users as $key => $user)

        <tr>
          <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">{{ ++$key }}</td>
          <td class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">{{ $user->name }}</td>
          <td class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">{{ $user->email }}</td>
          <td class="text-center">
            @if(!empty($user->getRoleNames()))
              @foreach($user->getRoleNames() as $v)
                <span class="badge bg-success">{{ $v }}</span>
              @endforeach
            @endif
          </td>
          @can('user-edit')
          <td class="text-center text-uppercase text-secondary text-xs font-weight-bolder form-switch">
            @if ($user->hasRole('Super-Admin'))
            <input class="form-check-input toggle-status" type="checkbox" data-user-id="{{ $user->id }}" {{ $user->status === 1 ? 'checked' : '' }} disabled>
            @else
            <input class="form-check-input toggle-status" type="checkbox" data-user-id="{{ $user->id }}" {{ $user->status === 1 ? 'checked' : '' }}>
            @endif
          </td>
          @endcan
          <td class="text-center"> 
            @can('user-edit')
            <a class="btn btn-sm btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
            @endcan            
            @can('user-show')
            <a class="btn btn-sm btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
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
@section('scripts')
<script>
    $(document).ready(function() {
        $('.toggle-status').change(function() {
            var userId = $(this).data('user-id');
            var newStatus = this.checked ? 1 : 0;

            $.ajax({
                url: "{{ route('users.ajaxChangeStatus') }}",
                method: "POST",
                data: {
                    user_id: userId,
                    status: newStatus,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    toastr.success(response.message); // Hiển thị thông báo thành công
                },
                error: function(response) {
                toastr.error('Không thể thay đổi trạng thái của Super-Admin.'); //
            }
            });
        });
    });
</script>
@endsection