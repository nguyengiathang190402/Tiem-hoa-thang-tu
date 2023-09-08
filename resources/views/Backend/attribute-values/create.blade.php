@extends('Backend.pages.master')

@section('content')
    <h1>Thêm Giá trị cho "{{ $productAttribute->name }}"</h1>
    <a class="btn btn-secondary" href="{{ route('attribute-values.index', ['productAttribute' => $productAttribute->id]) }}">Trở về</a>        
    <form action="{{ route('attribute-values.store', $productAttribute->id) }}" method="POST">
        @csrf
        <div class="input-group input-group-static mb-4">
            <label class="required">Giá trị</label>
            <input class="form-control" type="text" name="value" id="value" value="{{ old('value') }}">
            @error('value')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="input-group input-group-static mb-4">
            <label class="required">Số lượng</label>
            <input class="form-control" type="number" name="quantity" id="quantity" value="{{ old('quantity') }}">
            @error('quantity')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Thêm Giá trị</button>
    </form>
@endsection
