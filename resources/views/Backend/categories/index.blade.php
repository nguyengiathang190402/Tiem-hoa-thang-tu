@extends('Backend.pages.master')
@section('title', 'Category')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.productCategory.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                @can('category-create')
                    <a class="btn btn-success" href="{{ route("product-categories.create") }}">
                        {{ trans('global.add') }} {{ trans('cruds.productCategory.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ProductCategory">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th class="text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                            {{ trans('cruds.productCategory.fields.id') }}
                        </th>
                        <th class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                            {{ trans('cruds.productCategory.fields.name') }}
                        </th>
                        <th class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                            {{ trans('cruds.productCategory.fields.description') }}
                        </th>
                        <th class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                            {{ trans('cruds.productCategory.fields.photo') }}
                        </th>
                        <th class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                            {{ trans('cruds.productCategory.fields.category') }}
                        </th>
                        <th class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                            {{ trans('cruds.productCategory.fields.slug') }}
                        </th>
                        <th class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                            {{trans('cruds.productCategory.fields.action')}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productCategories as $key => $productCategory)
                        @include('Backend.categories.indexRow', compact('productCategory'))

                        @foreach($productCategory->childCategories as $childCategory)
                            @include('Backend.categories.indexRow', ['productCategory' => $childCategory, 'prefix' => '--'])

                            @foreach($childCategory->childCategories as $childCategory)
                                @include('Backend.categories.indexRow', ['productCategory' => $childCategory, 'prefix' => '----'])
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('script')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('product_category_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('product-categories.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    // order: [[ 1, 'desc' ]],
    bSort: false,
    pageLength: 100,
  });
  $('.datatable-ProductCategory:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
