@extends('Backend.pages.master')

@section('content')
<h1>Danh sách sản phẩm</h1>
@can('role-create')
<a href="{{ route('products.create') }}" class="btn btn-primary">Thêm sản phẩm</a>
@endcan
<div class="card">
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">ID</th>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Tên</th>
                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Mô tả</th>
                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Giá</th>
                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Danh mục</th>
                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Hình ảnh</th>
                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Thời gian tạo</th>
                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Thời gian cập nhật</th>
                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ $product->id }}</td>
                    <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">{{ $product->name }}</td>
                    <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">{{ $product->description }}</td>
                    <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">{{ $product->price }}</td>
                    <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">{{ $product->category->name ?? 'Không rõ' }}</td>
                    <td>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 80px;">
                        @else
                           <span class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7"> Không có hình ảnh</span>
                        @endif
                    </td>
                    <td class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">{{ $product->created_at->format('H:m:s d/m/Y')}}</td>
                    <td class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">{{ $product->updated_at->format('H:m:s d/m/Y') }}</td>
                    @can('role-edit')
                    <td class="text-center">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary text-xxs">Sửa</a>
                    @endcan
                    @can('role-delete')
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger text-xxs" onclick="return confirm('Bạn có chắc chắn muốn xoá sản phẩm này?')">Xoá</button>
                        </form>
                    </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <div class="card-footer clearfix">
        <div class="float-left">
            <div class="dataTables_info">
                Hiển thị {{ $products->firstItem() }} đến {{ $products->lastItem() }} của {{ $products->total() }} mục
            </div>
        </div>
        <div class="float-right">
            {{ $products->links() }}
        </div>
      </div>
</div>
@endsection