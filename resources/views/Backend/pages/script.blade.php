
  <script src="{{ asset('admin/assets/js/core/popper.min.js')}}"></script>
  <script src="{{ asset('admin/assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{ asset('admin/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{ asset('admin/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script src="{{ asset('admin/assets/js/plugins/chartjs.min.js')}}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  //moi
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.min.js" defer></script>
  <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
  <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
  <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
  <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
  <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
  <script src="{{ asset('admin/assets/js/main.js') }}"></script>
  
  <script>
    $('.select2').select2()

    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["M", "T", "W", "T", "F", "S", "S"],
        datasets: [{
          label: "Sales",
          tension: 0.4,
          borderWidth: 0,
          borderRadius: 4,
          borderSkipped: false,
          backgroundColor: "rgba(255, 255, 255, .8)",
          data: [50, 20, 10, 22, 50, 10, 40],
          maxBarThickness: 6
        }, ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 500,
              beginAtZero: true,
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
              color: "#fff"
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });


    var ctx2 = document.getElementById("chart-line").getContext("2d");

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Mobile apps",
          tension: 0,
          borderWidth: 0,
          pointRadius: 5,
          pointBackgroundColor: "rgba(255, 255, 255, .8)",
          pointBorderColor: "transparent",
          borderColor: "rgba(255, 255, 255, .8)",
          borderColor: "rgba(255, 255, 255, .8)",
          borderWidth: 4,
          backgroundColor: "transparent",
          fill: true,
          data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });

    var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

    new Chart(ctx3, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Mobile apps",
          tension: 0,
          borderWidth: 0,
          pointRadius: 5,
          pointBackgroundColor: "rgba(255, 255, 255, .8)",
          pointBorderColor: "transparent",
          borderColor: "rgba(255, 255, 255, .8)",
          borderWidth: 4,
          backgroundColor: "transparent",
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#f8f9fa',
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script>
    $(document).ready(function(){
        
        var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
           removeItemButton: true,
           maxItemCount:5,
           searchResultLimit:5,
           renderChoiceLimit:5
         }); 
        
        
    });
  </script>
  
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

  {{-- Modall --}}
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
  <script>
    var fileInputTextDiv = document.getElementById('file_input_text_div');
    var fileInput = document.getElementById('file_input_file');
    var fileInputText = document.getElementById('file_input_text');
    fileInput.addEventListener('change', changeInputText);
    fileInput.addEventListener('change', changeState);

    function changeInputText() {
      var str = fileInput.value;
      var i;
      if (str.lastIndexOf('\\')) {
        i = str.lastIndexOf('\\') + 1;
      } else if (str.lastIndexOf('/')) {
        i = str.lastIndexOf('/') + 1;
      }
      fileInputText.value = str.slice(i, str.length);
    }

    function changeState() {
      if (fileInputText.value.length != 0) {
        if (!fileInputTextDiv.classList.contains("is-focused")) {
          fileInputTextDiv.classList.add('is-focused');
        }
      } else {
        if (fileInputTextDiv.classList.contains("is-focused")) {
          fileInputTextDiv.classList.remove('is-focused');
        }
      }
    }
  </script>
  <script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('product-categories.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($productCategory) && $productCategory->photo)
      var file = {!! json_encode($productCategory->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $productCategory->photo->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

$('#name').change(function(e) {
    $.get('{{ route('product-categories.checkSlug') }}',
        { 'name': $(this).val() },
        function( data ) {
            $('#slug').val(data.slug);
        }
    );
});
</script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('admin/assets/js/material-dashboard.min.js?v=3.1.0')}}"></script>