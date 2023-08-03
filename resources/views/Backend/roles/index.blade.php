@extends('Backend.pages.master')
@section('content')
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
        <h2 class="card-title">Roles Management</h2>
        <div class="card-tools">
            <a class="btn btn-success" href="{{ route('roles.create') }}"><i class="fas fa-plus-square"></i> New Role</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive">  
        <table class="table table-striped table-bordered">
            <tr class="bg-blue text-center">
                <th width="50px">No</th>
                <th>Name</th>
                <th width="150px">Action</th>
            </tr>
            @foreach ($roles as $key => $role)
            <tr>
                <td class="text-center">{{ ++$key }}</td>
                <td class="text-center">{{ $role->name }}</td>
                <td class="text-center">
                    
                    @can('role-edit')
                        <a class="btn btn-sm btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                    @endcan
                    @can('role-delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger delete_confirm']) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
            @endforeach
        </table>

        {!! $roles->render() !!}
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        <div class="float-left">
            <div class="dataTables_info">
                Showing {{ $roles->firstItem() }} to {{ $roles->lastItem() }} of {{ $roles->total() }} entries
            </div>
        </div>
        <div class="float-right">
            {{ $roles->links() }}
        </div>
    </div>
  </div>
  <!-- /.card -->
</div>
@endsection 
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
 
  $('.delete_confirm').click(function(event) {
       var form =  $(this).closest("form");
       var name = $(this).data("name");
       event.preventDefault();
       swal({
        title: "Bạn có chắc là bạn muốn xóa bản ghi này?",
            text: "Nếu bạn xóa điều này, nó sẽ biến mất mãi mãi.",
            icon: "warning",
            type: "warning",
            buttons: ["Hủy bỏ","Đúng!"],
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Vâng, xóa nó!'
       })
       .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
       });
   });

</script>
@endsection