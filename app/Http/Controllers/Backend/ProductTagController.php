<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductTag\CreateProductTagRequest;
use App\Http\Requests\ProductTag\UpdateProductTagRequest;
use App\Models\ProductTag;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;

class ProductTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $productTags = ProductTag::all();

        return view('Backend.product-tags.index', compact('productTags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Backend.product-tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductTagRequest $request)
    {
        $productTag = ProductTag::create($request->all());

        toastr()->success('thẻ sản phẩm đã được thêm mới thành công');
        return redirect()->route('product-tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProductTag $productTag)
    {

        return view('Backend.product-tags.show', compact('productTag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductTag $productTag)
    {

        return view('Backend.product-tags.edit', compact('productTag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductTagRequest $request, ProductTag $productTag)
    {
        $productTag->update($request->all());
        toastr()->success('Thẻ sản phẩm đã được cập nhật thành công');

        return redirect()->route('product-tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductTag $productTag)
    {

        $productTag->delete();
        toastr()->success(__('Thẻ sản phẩm đã xóa thành công'));

        return back();
    }
    public function massDestroy(Request $request)
    {
        ProductTag::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
