@extends('Backend.pages.master')

@section('title', ' | List Permissions')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Permission Management</h2>
            {{-- <div class="card-tools">
                <button type="button" class="btn btn-success btn-create" data-toggle="modal" data-target="#PermissionModal">
                <i class="fas fa-plus-square"></i> Add Permission
                </button>
            </div> --}}
            <button type="button" class="btn btn-success btn-create" data-bs-toggle="modal" data-bs-target="#PermissionModal"><i class="fas fa-plus-square"></i> Add Permission</button>
            
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">  
            <table id="permission_table" class="table table-bordered data-table">
                <thead>
                    <tr class="bg-blue">                    
                        <th width="50px">No</th>
                        <th>Name</th>
                        <th width="150px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- Modal UpadateOrCreate Permission -->
<div class="col-md-4">
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card card-plain">
              <div class="card-header pb-0 text-left">
                <h5 class="">Welcome back</h5>
                <p class="mb-0">Enter your email and password to sign in</p>
              </div>
              <div class="card-body">
                <form role="form text-left">
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
                  <div class="form-check form-switch d-flex align-items-center">
                    <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                    <label class="form-check-label mb-0 ms-3" for="rememberMe">Remember me</label>
                  </div>
                  <div class="text-center">
                    <button type="button" class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Sign in</button>
                  </div>
                </form>
              </div>
              <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <p class="mb-4 text-sm mx-auto">
                  Don't have an account?
                  <a href="javascript:;" class="text-info text-gradient font-weight-bold">Sign up</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> 

<div class="modal fade" id="PermissionModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form method="POST" action="" id="permissionForm">        
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Add permission</h4>
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_method" id="permission_method" value="POST">
                <input type="hidden" name="id" id="id" value="">
                <div class="input-group input-group-outline my-3">
                    <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="" required>
                        @error('name')
                            <p class="mt-2 mb-0 error text-danger">{{ $message }}</p>
                        @enderror
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="savedata">Save</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">
    $(function () {
  
      var change = $('#permission_table').DataTable({
              'responsive': true,
              //'fixedHeader': true,
              'autoWidth': false,
              'processing': true,
              'serverside': true,
              "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Show all"]],
              'ajax': {
                  'dataSrc': 'permissions'
              },
              'columns':[   
                  {
                      className:      'dt-control',
                      orderable:      false,
                      data:           null,
                      defaultContent: ''
                  },
                  { data: 'name' },
                  { data: 'id',
                      orderable: false,
                      render: function(data){
                          return '<button class="btn btn-sm btn-info btn-edit mr-1" data-id="'+data+'">Edit</button>'+
                                  '<button class="btn btn-sm btn-danger btn-delete" data-id="'+data+'">Delete</button>';
                      }
                  }
              ],
              order: [[1, 'desc']],
              "columnDefs": [
                  { 'className': 'dt-center','targets': '_all' }
              ]
          });
          
          //Plus detail    
          $('#permission_table tbody').on('click', 'td.dt-control', function () {
              var tr = $(this).closest('tr');
              var row = change.row( tr );
          
              if ( row.child.isShown() ) {
                  row.child.hide();
                  tr.removeClass('shown');
              }
              else {
                  row.child( format(row.data()) ).show();
                  tr.addClass('shown');
              }
          } );
          function format ( rowData ) {
              return '<table class="table table-bordered">'+
                  '<tr style="background: #f9f9f9">'+
                      '<th width="30%">Title</th>'+
                      '<th width="70%">Details</th>'+
                  '</tr>'+
                  '<tr>'+
                      '<td>ID:</td>'+
                      '<td>'+rowData.id+'</td>'+
                  '</tr>'+
                  '<tr>'+
                      '<td>Name:</td>'+
                      '<td>'+rowData.name+'</td>'+
                  '</tr>'+
                  '<tr>'+
                      '<td>Created at:</td>'+
                      '<td>'+Date(rowData.created_at)+'</td>'+
                  '</tr>'+
              '</table>'; 
          };
  
          //create
          $('#permission_table').on('click', '.btn-create', function (e) {
              e.preventDefault;
              var url = '{{ route("permissions.store") }}';
              $('.modal-title').html("Create permission");
              $('#permissionForm').attr('action', url);
              $('#permission_method').attr('value', 'POST');
              $('#id').val('');        
          });
          //edit
          $('#permission_table').on('click', '.btn-edit', function () {
              var permission_id = $(this).data('id');
              var url = '{{ route("permissions.update","") }}' +'/'+ permission_id;
              $.ajax({
                  cache: false,
                  success: function(data){
                      $('#PermissionModal').modal('show');
                      $('.modal-title').html("Edit permission");
                      $.each(data.permissions, function(index, value) {
                          if(value.id === permission_id){
                              $('#id').val(permission_id);
                              $('#name').val(value.name);
                              $('#permissionForm').attr('action', url);
                              $('#permission_method').attr('value', 'PATCH');
                           }
                      });
                  }
              });
          });
          $('#PermissionModal').on('hidden.bs.modal', function () {
              $(this).find('form').trigger('reset');  
              $('.error').html('');
              $('#name').removeClass("is-invalid");
          });
  
          //Delete         
          $('#permission_table').on("click", ".btn-delete", function() { 
              var permission_id = $(this).data('id');
              var url = '{{ route("permissions.destroy","") }}' +'/'+ permission_id;
              Swal.fire({
                  title: 'Are you sure you want to delete this record?',
                  text: "If you delete this, it will be gone forever.",
                  icon: 'warning',
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!',
                  showDenyButton: true,
                  denyButtonText: 'Cancel',
              }).then((result) => {
                  if (result.isConfirmed) {
                      $.ajax({
                          url: url,
                          type: 'DELETE',
                          cache: false,
                          data: {
                              _token:'{{ csrf_token() }}',
                          },
                          success: function (response){
                              Swal.fire(
                                  "Deleted!", 
                                  "Your file has been deleted.", 
                                  "success"
                                  ).then(function(){ 
                                      location.reload();
                                  });                            
                          }
                      });
                  }else if (result.isDenied) {
                      Swal.fire('Your record is safe', '', 'info')
                  }         
                  
              });            
          });
  
          @if(count($errors))
              $('#PermissionModal').modal('show');
          @endif        
  
  });
  </script>
  
@endsection



