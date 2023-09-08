@extends('Backend.pages.master')

@section('content')
<div class="container">
    <h2 style="font-weight: bold; color: red">{{ $product->name }}</h2>
    <a href="{{ route('products.index') }}" class="btn btn-primary">Quay về danh sách sản phẩm</a>

    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>Mô tả:</th>
            <td>{!! strip_tags($product->description) !!}</td>
        </tr>
        <tr>
            <th>Giá:</th>
            <td>
                <span style="">{{ number_format($product->price, 0, ',', '.') }}</span>
                <span style="text-decoration: underline; color: red;">đ</span>
            </td>
        </tr>
        <tr>
            <th>Ảnh sản phẩm:</th>
            <td>
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 50px;">
                @else
                   <span class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7"> Không có hình ảnh</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Số lượng:</th>
            <td>{{ number_format($product->quantity) }}</td>
        </tr>
        <tr>
            <th>Nội dung:</th>
            <td>
                @if ($product->content)
                    {!! $product->content !!}
                @else
                <span class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7"> Không có thông tin</span>
                @endif
            </td>
        </tr>        
        <tr>
            <th>Slug:</th>
            <td>{{ $product->slug }}</td>
        </tr>
        <tr>
            <th>Người tạo:</th>
            <td>
                @if ($product->createdBy)
                    {{ $product->createdBy->name }}
                @else
                    Không có thông tin người tạo
                @endif
            </td>
        </tr>        
        <tr>
            <th>Người sửa:</th>
            <td>
                @if ($product->updatedBy)
                    {{ $product->updatedBy->name }}
                @else
                    Không có thông tin người sửa
                @endif
            </td>
        </tr>        
        <tr>
            <th>Thời gian tạo:</th>
            <td>{{ $product->created_at->format('H:i:s d/m/Y') }}</td>
        </tr>
        <tr>
            <th>Thời gian cập nhật:</th>
            <td>{{ $product->updated_at->format('H:i:s d/m/Y') }}</td>
        </tr>
        <tr>
            <th>Danh mục:</th>
            <td>
                @if ($product->categories->isNotEmpty())
                    @foreach ($product->categories as $category)
                        @if ($category->parentCategory)
                            {{ $category->parentCategory->name }} /
                        @endif
                        {{ $category->name }}
                    @endforeach
                @else
                    Không có dữ liệu
                @endif
            </td>
        </tr>
        <tr>
            <th>Thẻ sản phẩm:</th>
            <td>
                @if ($product->tags->isNotEmpty())
                    @foreach ($product->tags as $tag)
                        <span class="badge bg-gradient-info">{{ $tag->name }}</span>
                    @endforeach
                @else
                    Không có dữ liệu
                @endif
            </td>
        </tr>
        @php
            $printedAttributes = [];
        @endphp

        <tr>
            <th>Thuộc tính:</th>
            <td>
                @foreach ($selectedAttributes as $attribute)
                    @if (!in_array($attribute->name, $printedAttributes))
                        <strong>{{ $attribute->name }}:</strong>
                        <ul>
                            @foreach ($selectedAttributeValues[$attribute->id] as $valueId)
                                <?php
                                    $attributeValue = App\Models\AttributeValue::find($valueId);
                                ?>
                                <li>{{ $attributeValue->value }}</li>
                            @endforeach
                        </ul>
                        @php
                            $printedAttributes[] = $attribute->name;
                        @endphp
                    @endif
                @endforeach
            </td>
        </tr>
    </table>
</div>
@endsection
