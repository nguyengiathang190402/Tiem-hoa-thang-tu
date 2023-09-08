@extends('Backend.pages.master')
@section('title', 'Chi tiết giá trị thuộc tính')
@section('content')
    <div class="container">
        <h1 class="mt-5">Chi tiết Giá trị thuộc tính</h1>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thông tin thuộc tính</h3>
                    </div>
                    <div class="card-body">
                        <p><strong>Tên thuộc tính:</strong> {{ $productAttribute->name }}</p>
                        <p><strong>Loại:</strong> {{ $productAttribute->type }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thông tin giá trị thuộc tính</h3>
                    </div>
                    <div class="card-body">
                        <p><strong>ID:</strong> {{ $attributeValue->id }}</p>
                        <p><strong>Giá trị:</strong> {{ $attributeValue->value }}</p>
                        <p><strong>Số lượng:</strong> {{ $attributeValue->quantity }}</p>
                        <!-- Thêm các thông tin khác về giá trị thuộc tính tại đây nếu cần -->
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <!-- Thêm nút để quay lại trang danh sách giá trị thuộc tính -->
            <a href="{{ route('attribute-values.index', ['productAttribute' => $productAttribute->id]) }}" class="btn btn-secondary">Quay lại danh sách</a>
        </div>
    </div>
@endsection
