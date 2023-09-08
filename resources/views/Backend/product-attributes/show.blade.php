@extends('Backend.pages.master')

@section('title', 'Chi tiết thuộc tính')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ $productAttribute->name }}</h4>
                    <p class="card-category">{{ $productAttribute->type }}</p>
                </div>
                <div class="card-body">
                    <div class="font-weight-bold">Giá trị:</div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Giá trị</th>
                                <th>Số lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productAttribute->attributeValues as $attributeValue)
                                <tr>
                                    <td>{{ $attributeValue->value }}</td>
                                    <td>{{ $attributeValue->quantity }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="font-weight-bold">Tổng số lượng</td>
                                <td class="font-weight-bold">{{ $productAttribute->attributeValues->sum('quantity') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="{{ route('product-attributes.index') }}" class="btn btn-secondary">Trở về danh sách thuộc tính</a>
                </div>
            </div>
        </div>
    </div>
@endsection
