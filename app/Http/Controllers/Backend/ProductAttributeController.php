<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productAttributes = ProductAttribute::all();
        return view('Backend.product-attributes.index', compact('productAttributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.product-attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        ProductAttribute::create($data);

        return redirect()->route('product-attributes.index')->with('success', 'Thuộc tính sản phẩm đã được thêm mới');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productAttribute = ProductAttribute::with('attributeValues')->find($id);
        return view('backend.product-attributes.show', compact('productAttribute'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productAttribute = ProductAttribute::findOrFail($id);
        return view('Backend.product-attributes.edit', compact('productAttribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        $productAttribute = ProductAttribute::findOrFail($id);
        $productAttribute->update($data);

        return redirect()->route('product-attributes.index')->with('success', 'Thuộc tính sản phẩm đã được cập nhật');
    }

    public function destroy($id)
    {
        $productAttribute = ProductAttribute::findOrFail($id);

        // Kiểm tra xem thuộc tính này có được sử dụng trong bất kỳ sản phẩm nào không
        if ($productAttribute->products()->count() > 0) {
            return redirect()->route('product-attributes.index')->with('error', 'Không thể xóa thuộc tính này vì nó đang được sử dụng trong sản phẩm.');
        }

        // Sau đó bạn có thể xóa thuộc tính sản phẩm
        $productAttribute->delete();

        return redirect()->route('product-attributes.index')->with('success', 'Thuộc tính sản phẩm đã được xóa.');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(ProductCategory::class, 'slug', $request->name);

        return response()->json(['slug' => $slug]);

    }

    public function manageValues(ProductAttribute $productAttribute)
    {
        $attributeValues = $productAttribute->attributeValues;
        return view('Backend.attribute-values.index', compact('productAttribute', 'attributeValues'));
    }
    public function getValues($attributeId)
    {
        try {
            $attribute = ProductAttribute::findOrFail($attributeId);
            $values = $attribute->attributeValues;

            return response()->json($values);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching data'], 500);
        }
    }

}

