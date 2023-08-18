<tr data-entry-id="{{ $productCategory->id }}">
    <td>

    </td>
    <td class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
        {{ $productCategory->id ?? '' }}
    </td>
    <td class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
        {{ $prefix ?? '' }} {{ $productCategory->name ?? '' }}
    </td>
    <td class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
        {{ $productCategory->description ?? '' }}
    </td>
    <td class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
        @if($productCategory->photo)
            <a href="{{ $productCategory->photo->getUrl() }}" target="_blank">
                <img src="{{ $productCategory->photo->getUrl('thumb') }}" width="50px" height="50px">
            </a>
        @endif
    </td>
    <td class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
        {{ $productCategory->parentCategory->name ?? '' }}
    </td>
    <td class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">
        {{ $productCategory->slug ?? '' }}
    </td>
    <td class="text-center text-uppercase text-secondary text-s font-weight-bolder">
        @can('product-show')
            <a class="btn btn-xs btn-primary" href="{{ route('product-categories.show', $productCategory->id) }}">
                {{ trans('global.view') }}
            </a>
        @endcan

        @can('product-edit')
            <a class="btn btn-xs btn-info" href="{{ route('product-categories.edit', $productCategory->id) }}">
                {{ trans('global.edit') }}
            </a>
        @endcan

        @can('product-delete')
            <form action="{{ route('product-categories.destroy', $productCategory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
            </form>
        @endcan

    </td>

</tr>
