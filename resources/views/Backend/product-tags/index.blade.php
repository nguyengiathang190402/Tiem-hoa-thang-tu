@extends('Backend.pages.master')
@section('title', 'Product Tag')
@section('content')
@can('tag-create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("product-tags.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.productTag.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.productTag.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ProductTag">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                            {{ trans('cruds.productTag.fields.id') }}
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                            {{ trans('cruds.productTag.fields.name') }}
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                            {{ trans('cruds.productCategory.fields.action')}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productTags as $key => $productTag)
                        <tr data-entry-id="{{ $productTag->id }}">
                            <td>

                            </td>
                            <td class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                {{ $productTag->id ?? '' }}
                            </td>
                            <td class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
                                {{ $productTag->name ?? '' }}
                            </td>
                            <td class="text-center text-secondary text-s font-weight-bolder">
                                @can('tag-show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('product-tags.show', $productTag->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('tag-edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('product-tags.edit', $productTag->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('tag-delete')
                                    <form action="{{ route('product-tags.destroy', $productTag->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('product_tag_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('product-tags.massDestroy') }}",
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
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-ProductTag:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection