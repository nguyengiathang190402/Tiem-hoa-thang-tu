@extends('Backend.pages.master')
@section('title', ' | List Roles')

@section('content')
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
        <h2 class="card-title">Roles Management</h2>
    @can('role-create')
        <div class="card-tools">
            <a class="btn btn-success" href="{{ route('roles.create') }}"><i class="fas fa-plus-square"></i> New Role</a>
        </div>
    @endcan
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
