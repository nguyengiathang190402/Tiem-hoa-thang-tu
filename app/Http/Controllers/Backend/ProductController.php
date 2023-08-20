<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

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
        $categories = ProductCategory::with('parentCategory.parentCategory')
            // ->whereHas('parentCategory.parentCategory')
            ->get();

        $tags = ProductTag::all()->pluck('name', 'id');
        // dd($categories);
        return view('Backend.products.create', compact('categories', 'tags'));
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
            'description' => 'required',
            'user_id' => 'nullable|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'nullable|unique:products,slug',
            'categories' => 'nullable', // Make sure 'categories' is an array
            'tags' => 'array', // Make sure 'tags' is an array
        ]);
    
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::with('parentCategory.parentCategory')
            // ->whereHas('parentCategory.parentCategory')
            ->get();

        $tags = ProductTag::all()->pluck('name', 'id');

        $product->load('categories', 'tags');

        return view('Backend.products.edit', compact('categories', 'tags', 'product'));
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
        'description' => 'required',
        'user_id' => 'nullable|exists:users,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'slug' => 'nullable|unique:products,slug,' . $product->id,
        'categories' => 'nullable', // Make sure 'categories' is an array
        'tags' => 'array', // Make sure 'tags' is an array
    ]);

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
}
