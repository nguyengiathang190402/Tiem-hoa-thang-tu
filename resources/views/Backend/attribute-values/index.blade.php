@extends('Backend.pages.master')
@section('title', 'Quản lý giá trị thuộc tính')
@section('content')
    <h1>Quản lý Giá trị theo thuộc tính "{{ $productAttribute->name }}"</h1>
    <a href="{{ route('product-attributes.index') }}" class="btn btn-secondary">Trở về màn hình quản lý thuộc tính</a>
    @can('value-create')
    <a href="{{ route('attribute-values.create', ['productAttribute' => $productAttribute->id]) }}" class="btn btn-primary">Thêm giá trị</a>
    @endcan

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Giá trị</th>
                <th>Số lượng</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productAttribute->attributeValues as $attributeValue)
                <tr>
                    <td>{{ $attributeValue->id }}</td>
                    <td>{{ $attributeValue->value }}</td>
                    <td>{{ $attributeValue->quantity }}</td>
                    <td>
                        @can('value-edit')
                        <a href="{{ route('attribute-values.edit', ['productAttribute' => $productAttribute->id, 'attributeValue' => $attributeValue->id]) }}" class="btn btn-primary">Sửa</a>
                        @endcan
                        @can('value-show')
                        <a href="{{ route('attribute-values.show', ['productAttribute' => $productAttribute->id, 'attributeValue' => $attributeValue->id]) }}" class="btn btn-info">Xem</a>
                        @endcan
                        @can('value-delete')
                        <button class="btn btn-danger" onclick="openModal('{{ $attributeValue->id }}')">Delete</button>
                        @endcan
                    </td>
                </tr>
                <div id="deleteModal_{{ $attributeValue->id }}" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Attribute Value</h5>
                                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                            </div>
                            <div class="modal-body">
                                @if ($attributeValue->isUsedInProducts())
                                    <div class="alert alert-warning">
                                        Giá trị thuộc tính này hiện đang được sử dụng trong các sản phẩm.Bạn có chắc chắn muốn xóa nó?
                                    </div>
                                @else
                                    <div class="alert alert-success">
                                        Giá trị thuộc tính này không được sử dụng trong bất kỳ sản phẩm nào.
                                    </div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ route('attribute-values.destroy', ['productAttribute' => $productAttribute->id, 'attributeValue' => $attributeValue->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Xoá</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- Modal -->
        </tbody>
    </table>
@endsection
@section('scripts')
<script>
    function openModal(attributeValueId) {
        const targetModalId = '#deleteModal_' + attributeValueId;
        $(targetModalId).modal('show');
    }
    // Lấy tất cả các nút "Delete" và gán cho chúng sự kiện khi được nhấn
    document.querySelectorAll('.open-modal').forEach(function(button) {
        button.addEventListener('click', function() {
            const targetModalId = this.getAttribute('data-target');
            $(targetModalId).modal('show');
        });
    });
</script>
@endsection
