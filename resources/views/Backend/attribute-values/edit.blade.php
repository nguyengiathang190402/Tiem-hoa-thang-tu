@extends('Backend.pages.master') <!-- Đảm bảo bạn đang sử dụng layout của dự án bạn -->
@section('title', 'Sửa giá trị')
@section('content')
    <div class="container">
        <h1>Chỉnh sửa giá trị thuộc tính của "{{ $productAttribute->name }}"</h1>
        <a class="btn btn-secondary" href="{{ route('attribute-values.index', ['productAttribute' => $productAttribute->id]) }}">Trở về</a>        
        <form action="{{ route('attribute-values.update', ['productAttribute' => $productAttribute->id, 'attributeValue' => $attributeValue->id]) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Hiển thị các trường chỉnh sửa giá trị thuộc tính -->
            <div class="input-group input-group-static mb-4">
                <label class="required">Giá trị</label>
                <input class="form-control" type="text" name="value" id="value" value="{{ $attributeValue->value }}">
                @error('value')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            
            <div class="input-group input-group-static mb-4">
                <label class="required">Số lượng</label>
                <input class="form-control" type="number" name="quantity" id="quantity" value="{{ $attributeValue->quantity }}">
                @error('quantity')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            
            <!-- Nút để cập nhật giá trị thuộc tính -->
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            
        </form>
    </div>
@endsection
