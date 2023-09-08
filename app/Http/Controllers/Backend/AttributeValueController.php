<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Models\AttributeValue;
use Illuminate\Support\Facades\DB;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductAttribute $productAttribute)
    {
        return view('Backend.attribute-values.index', compact('productAttribute'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ProductAttribute $productAttribute)
    {
        return view('Backend.attribute-values.create', compact('productAttribute'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ProductAttribute $productAttribute)
    {
        $data = $request->validate([
            'value' => 'required',
            'quantity' => 'required|integer|min:0',
        ]);

        $productAttribute->attributeValues()->create($data);

        return redirect()->route('product-attributes.manage-values', $productAttribute->id)
                        ->with('success', 'Giá trị đã được thêm thành công.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($productAttribute, $attributeValue)
    {
        // Lấy thông tin giá trị thuộc tính từ $productAttribute và $attributeValue
        $productAttribute = ProductAttribute::find($productAttribute);
        $attributeValue = AttributeValue::find($attributeValue);

        // Trả về view và truyền dữ liệu cho view
        return view('Backend.attribute-values.show', compact('productAttribute', 'attributeValue'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductAttribute $productAttribute, AttributeValue $attributeValue)
    {
        return view('Backend.attribute-values.edit', compact('productAttribute', 'attributeValue'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductAttribute $productAttribute, AttributeValue $attributeValue)
    {
        $data = $request->validate([
            'value' => 'required',
            'quantity' => 'required|integer|min:0',
        ]);

        $attributeValue->update($data);

        return redirect()->route('product-attributes.manage-values', $productAttribute->id)
                        ->with('success', 'Giá trị đã được cập nhật thành công.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductAttribute $productAttribute, AttributeValue $attributeValue)
    {
        // if ($attributeValue->isUsedInProducts()) {
        //     return redirect()->route('product-attributes.manage-values', $productAttribute->id)
        //         ->with('warning', 'Giá trị thuộc tính này đang được sử dụng trong sản phẩm và không thể xoá.');
        // }
        $attributeValue->products()->detach();
        // Nếu không có sản phẩm nào sử dụng giá trị thuộc tính, tiến hành xóa
        $attributeValue->delete();

        return redirect()->route('product-attributes.manage-values', $productAttribute->id)
                        ->with('success', 'Giá trị đã được xoá thành công.');
    }

    public function isUsedInProducts(AttributeValue $attributeValue)
    {
        return $attributeValue->products()->exists();
    }

    public function getValues(Attribute $attribute)
    {
        $values = $attribute->values;

        return response()->json($values);
    }

}
