<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use Attribute;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','store']]);
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        // $products = Product::all();
        $categories = ProductCategory::with('parentCategory.parentCategory')
            // ->whereHas('parentCategory.parentCategory')
            ->get();
        $products = Product::orderBy('id','ASC')->paginate(5);
        return view('Backend.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributes = ProductAttribute::all();
        $categories = ProductCategory::with('parentCategory.parentCategory')
            // ->whereHas('parentCategory.parentCategory')
            ->get();

        $tags = ProductTag::all()->pluck('name', 'id');
        // dd($categories);
        return view('Backend.products.create', compact('categories', 'tags', 'attributes'));
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
            'price' => 'required|numeric',
            'content' => 'nullable',
            'quantity' => 'numeric',
            'description' => 'required',
            'user_id' => 'nullable|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'nullable|unique:products,slug',
            'categories' => 'nullable', // Make sure 'categories' is an array
            'tags' => 'array', // Make sure 'tags' is an array
        ]);
        $data['user_id'] = auth()->user()->id;

        // Xử lý upload hình ảnh nếu cần thiết
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath;
        }
    
        // Tạo sản phẩm mới và lưu vào database
        $product = Product::create($data);
    
        // Đồng bộ danh mục và thẻ sản phẩm
        $product->categories()->sync($data['categories'] ?? []);
        $product->tags()->sync($data['tags'] ?? []);
        
        // Loop through selected attributes and their values
        $selectedAttributes = $request->input('selected_attributes', []);
        $selectedAttributeValues = $request->input('selected_attribute_values', []);

        foreach ($selectedAttributes as $attributeId) {
            $valueIds = $selectedAttributeValues[$attributeId] ?? [];
            
            foreach ($valueIds as $valueId) {
                $dataToAttach = [
                    'attribute_value_id' => $valueId
                ];
                $product->attributes()->attach($attributeId, $dataToAttach);
            }
        }
        toastr()->success('Thêm sản phẩm thành công.');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        $selectedAttributes = $product->attributes;

        // Tạo mảng để lưu danh sách ID giá trị thuộc tính theo ID của thuộc tính
        $selectedAttributeValues = [];

        $printedAttributes = []; // Đảm bảo khởi tạo biến $printedAttributes

        foreach ($selectedAttributes as $selectedAttribute) {
            $attributeId = $selectedAttribute->id;

            // Lấy danh sách ID giá trị thuộc tính cho thuộc tính cụ thể của sản phẩm
            $valueIds = DB::table('product_product_attribute')
                ->where('product_id', $product->id)
                ->where('product_attribute_id', $attributeId)
                ->pluck('attribute_value_id')
                ->toArray();

            $selectedAttributeValues[$attributeId] = $valueIds;
        }

        return view('Backend.products.show', compact('product', 'selectedAttributes', 'selectedAttributeValues', 'printedAttributes'));
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::with('parentCategory.parentCategory')->get();
        $attributes = ProductAttribute::with('attributeValues')->get();
        $tags = ProductTag::all()->pluck('name', 'id');

        $product->load('categories', 'tags');

        // Lấy thông tin thuộc tính và giá trị của chúng từ bảng trung gian
        $selectedAttributes = $product->attributes;

        // Lấy thông tin thuộc tính và giá trị của chúng từ bảng trung gian
        $productAttributes = ProductAttribute::with('attributeValues')
            ->whereIn('id', $selectedAttributes->pluck('id'))
            ->get();
            
       // Tạo mảng để lưu danh sách ID giá trị thuộc tính theo ID của thuộc tính
        $selectedAttributeValues = [];

        foreach ($selectedAttributes as $selectedAttribute) {
            $attributeId = $selectedAttribute->id;

            // Lấy danh sách ID giá trị thuộc tính cho thuộc tính cụ thể của sản phẩm
            $valueIds = DB::table('product_product_attribute')
                ->where('product_id', $product->id)
                ->where('product_attribute_id', $attributeId)
                ->pluck('attribute_value_id')
                ->toArray();

            $selectedAttributeValues[$attributeId] = $valueIds;
        }

        // Logic để nhóm giá trị thuộc tính theo từng thuộc tính
        $attributeValues = AttributeValue::all()->groupBy('product_attribute_id');

        return view('Backend.products.edit', compact('categories', 'tags', 'product', 'attributes', 'productAttributes', 'selectedAttributes', 'selectedAttributeValues', 'attributeValues'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'content' => 'nullable',
            'quantity' => 'numeric',
            'description' => 'required',
            'user_id' => 'nullable|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'nullable|unique:products,slug,' . $product->id, // Ensure slug uniqueness excluding the current product
            'categories' => 'nullable', // Make sure 'categories' is an array
            'tags' => 'array', // Make sure 'tags' is an array
            'updated_by' => 'nullable|exists:users,id',
        ]);
        $data['updated_by'] = auth()->user()->id;

        // Xử lý upload hình ảnh nếu cần thiết
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath;
        }

        // Cập nhật thông tin sản phẩm
        $product->update($data);

        // Đồng bộ danh mục và thẻ sản phẩm
        $product->categories()->sync($data['categories'] ?? []);
        $product->tags()->sync($data['tags'] ?? []);

        // Xóa các thuộc tính cũ và thêm thuộc tính mới
        $selectedAttributes = $request->input('selected_attributes', []);
        $selectedAttributeValues = $request->input('selected_attribute_values', []);

        $product->attributes()->detach(); // Xóa tất cả các thuộc tính hiện tại của sản phẩm

        foreach ($selectedAttributes as $attributeId) {
            $valueIds = $selectedAttributeValues[$attributeId] ?? [];

            foreach ($valueIds as $valueId) {
                $dataToAttach = [
                    'attribute_value_id' => $valueId
                ];
                $product->attributes()->attach($attributeId, $dataToAttach);
            }
        }

        toastr()->success('Cập nhật sản phẩm thành công.');
        return redirect()->route('products.index');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        toastr()->success('Sản phẩm đã được xoá thành công!');
        return redirect()->route('products.index');
    }
    public function massDestroy(MassDestroyProductRequest $request)
    {
        Product::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function storeCKEditorImages(Request $request)
    {

        $model         = new Product();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);

    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->name);

        return response()->json(['slug' => $slug]);

    }

    public function getAttributeData()
    {
        $attributes = ProductAttribute::all();

        $attributeData = $attributes->map(function ($attribute) {
            return [
                'id' => $attribute->id,
                'name' => $attribute->name,
            ];
        });

        return response()->json($attributeData);
    }

    
}
