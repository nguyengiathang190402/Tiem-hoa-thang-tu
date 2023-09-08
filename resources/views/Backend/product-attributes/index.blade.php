@extends('Backend.pages.master')
@section('title', 'Attribute')
@section('content')
<div class="card">
<div class="card-header card-header-primary">
    <h4 class="card-title">Quản lý thuộc tính</h4>
    <p class="card-category">Danh sách các thuộc tính</p>
</div>
<div class="card-body">
@can('attribute-create')
<a class="btn btn-primary" href="{{ route('product-attributes.create') }}">Thêm thuộc tính mới</a>
@endcan
    
    <table class="table table-striped table-bordered table-hover">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <thead class="text-primary">
            <tr>
                <th>ID</th>
                <th>Tên thuộc tính</th>
                <th>Loại</th>
                <th>Giá trị</th>
                <th>Số lượng</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productAttributes as $productAttribute)
                <tr>
                    <td>{{ $productAttribute->id }}</td>
                    <td>{{ $productAttribute->name }}</td>
                    <td>{{ $productAttribute->type }}</td>
                    <td>
                        @if ($productAttribute->attributeValues->isEmpty())
                            <span class="text-primary">Chưa thêm giá trị</span>
                        @else
                        @foreach ($productAttribute->attributeValues as $value)
                            {{ $value->value }},
                        @endforeach
                        @endif
                    </td>
                    <td>
                        {{ $productAttribute->attributeValues->sum('quantity') }}
                    </td>
                    <td>
                        @can('attribute-edit')
                            <a class="btn btn-primary" href="{{ route('product-attributes.edit', $productAttribute->id) }}">Sửa</a>
                        @endcan
                        @can('attribute-show')
                            <a class="btn btn-warning" href="{{ route('product-attributes.show', $productAttribute->id) }}">Xem</a>
                        @endcan            
                        <!-- Thêm nút xoá với thuộc tính data để truyền thông tin thuộc tính -->
                        @can('attribute-delete')
                            <button class="btn btn-danger open-modal" data-target="#deleteModal_{{ $productAttribute->id }}">Delete</button>
                        @endcan
                        @can('atrribute-manage')
                            <a class="btn btn-info" href="{{ route('product-attributes.manage-values', $productAttribute->id) }}">Manage</a>  
                        @endcan
                    </td>
                    <!-- Modal xác nhận -->
                    <div id="deleteModal_{{ $productAttribute->id }}" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Attribute Value</h5>
                                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>
                                <div class="modal-body">
                                    @if ($productAttribute->isUsedInProducts())
                                        <div class="alert alert-warning">
                                            Giá trị thuộc tính này hiện đang được sử dụng trong các sản phẩm. Bạn có chắc chắn muốn xóa nó?
                                        </div>
                                    @else
                                        <div class="alert alert-success">
                                            Giá trị thuộc tính này không được sử dụng trong bất kỳ sản phẩm nào.
                                        </div>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancel</button>
                                    {{-- @if (!$productAttribute->isUsedInProducts()) --}}
                                        <form action="{{ route('product-attributes.destroy', $productAttribute->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Xoá</button>
                                        </form>
                                    {{-- @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </tr>
            @endforeach
        </tbody>
    
    </table>
</div>
    </div>
@endsection
@section('scripts')
<script>
    // Lắng nghe sự kiện click vào nút xoá
    $('.open-modal').on('click', function () {
        // Lấy target modal ID từ thuộc tính data
        var targetModalId = $(this).data('target');
        $(targetModalId).modal('show');
    });
</script>

@endsection
