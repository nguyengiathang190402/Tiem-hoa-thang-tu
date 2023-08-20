<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductCategoryRequest;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Models\ProductCategory;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductCategoryController extends Controller
{
    public function index()
    {

        $productCategories = ProductCategory::whereNull('category_id')
            ->with('childCategories.childCategories')
            ->get();

        return view('Backend.categories.index', compact('productCategories'));
    }

    public function create()
    {

        $categories = ProductCategory::whereNull('category_id')
            ->with('childCategories')
            ->get();

        return view('Backend.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $productCategory = ProductCategory::create($request->all());

        if ($request->input('photo', false)) {
            $productCategory->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $productCategory->id]);
        }
        toastr()->success('Danh mục đã thêm thành công');
        return redirect()->route('product-categories.index');

    }
    public function edit(ProductCategory $productCategory)
    {

        $categories = ProductCategory::whereNull('category_id')
            ->with('childCategories')
            ->get();

        $productCategory->load('parentCategory');

        return view('Backend.categories.edit', compact('categories', 'productCategory'));
    }
    public function update(Request $request, ProductCategory $productCategory)
    {
        $productCategory->update($request->all());

        if ($request->input('photo', false)) {
            if (!$productCategory->photo || $request->input('photo') !== $productCategory->photo->file_name) {
                $productCategory->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }

        } elseif ($productCategory->photo) {
            $productCategory->photo->delete();
        }

        toastr()->success('Danh mục đã thêm thành công');

        return redirect()->route('product-categories.index');

    }

    public function show(ProductCategory $productCategory)
    {

        $productCategory->load('parentCategory');

        return view('Backend.categories.show', compact('productCategory'));
    }

    public function destroy(ProductCategory $productCategory)
    {

        $productCategory->delete();
        toastr()->success('Danh mục sản phẩm đã xóa thành công');

        return back();

    }

    // Other methods...

    public function storeCKEditorImages(Request $request)
    {

        $model         = new ProductCategory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(ProductCategory::class, 'slug', $request->name);

        return response()->json(['slug' => $slug]);

    }

}
