@extends('Backend.pages.master')
@section('title', 'Xem chi tiết Tag')
@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="card-title">Xem chi tiết Tag</h5>
        <div class="card-tools">
            <a class="btn btn-success" href="{{ route('product-tags.index') }}"><i class="fas fa-angle-double-left"></i> Về danh mục tag</a>
        </div>
</div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('product-tags.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productTag.fields.id') }}
                        </th>
                        <td>
                            {{ $productTag->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productTag.fields.name') }}
                        </th>
                        <td>
                            {{ $productTag->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('product-tags.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection