<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Session;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();

        return view('admin.pages.products.index', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Product_categories = ProductCategory::orderBy('name')->get();
        if (count($Product_categories) > 0){

            return view('admin.pages.products.create', compact('Product_categories'));
        }

        Session::flash('error','Category Create First!');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => ['required', 'unique:products,title', 'max:255'],
            'category_id' => ['required'],

        ]);

        $products = new Product();
        $products->title = $request->title;
        $products->category_id = $request->category_id;
        $products->slug = Str::slug($request['title']);
        $products->description = $request->description;
        $products->price = $request->price;
        $products->quantity = $request->quantity;
        $image = $request->image;
        if ($image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path(Product::IMAGE_UPLOAD_PATH), $imageName);
//            $image_path = public_path(Products::IMAGE_UPLOAD_PATH).$imageName;
//            Image::make($image_path)
//                ->resize(300, 20)
//                ->save(Products::THUMBNAIL_UPLOAD_PATH.'/'.$imageName,100);
            $products->image = $imageName;
        } else {
            $products->image = $request->old_image;
        }

        /*summernote image uploads*/
        $message = $request->input('description');
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . "<div>$message</div>");

        $container = $dom->getElementsByTagName('div')->item(0);
        $container = $container->parentNode->removeChild($container);

        while ($dom->firstChild) {
            $dom->removeChild($dom->firstChild);
        }

        while ($container->firstChild) {
            $dom->appendChild($container->firstChild);
        }

        $images = $dom->getElementsByTagName('img');

        $products->description = $dom->saveHTML();
        $products->save();

        foreach ($images as $img) {
            $src = $img->getAttribute('src');

            if (preg_match('/data:image/', $src)) {
                $this->mime_type_image_save($src,$img,$products);
            } // <!--endif
        } // <!-

        $products->description = $dom->saveHTML();
        $products->update();

        return redirect()->route('products.index')->with(['success' => 'Product added successfully']);

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products =Product::find($id);

        return view('admin.pages.products.show', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products =Product::find($id);
        $Product_categories = ProductCategory::all();
//        return view('admin.pages.products.edit', compact('products' 'products'));
        return view('admin.pages.products.edit', compact('products', 'Product_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $products =Product::find($id);
        $validatedData = $request->validate([
            'title' => ['required', 'unique:products,title,' . $products->id, 'max:255'],
            'category_id' => ['required'],
        ]);
        $products->title = $request->title;
        $products->category_id = $request->category_id;
        $products->slug = Str::slug($request['title']);
        $products->description = $request->description;
        $products->price = $request->price;
        $products->quantity = $request->quantity;

        /*summernote image upload*/
        $message = $request->input('description');

        $dom = new \DomDocument();
        libxml_use_internal_errors(true);

        $dom->loadHTML('<?xml encoding="utf-8" ?>' . "<div>$message</div>");

        $container = $dom->getElementsByTagName('div')->item(0);

        $container = $container->parentNode->removeChild($container);

        while ($dom->firstChild) {
            $dom->removeChild($dom->firstChild);
        }

        while ($container->firstChild) {
            $dom->appendChild($container->firstChild);
        }

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');

            if (preg_match('/data:image/', $src)) {
                $this->mime_type_image_save($src,$img, $products);
            }
        }

        $products->description = $dom->saveHTML();

        $image = $request->image;
        if ($image) {
            unlink(Product::IMAGE_UPLOAD_PATH.$products->image);
//            unlink(Products::THUMBNAIL_UPLOAD_PATH.$products->image);
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path(Product::IMAGE_UPLOAD_PATH), $imageName);
//            $image_path = public_path(Products::IMAGE_UPLOAD_PATH).$imageName;
//            Image::make($image_path)
//                ->resize(300, 200)
//                ->save(Products::THUMBNAIL_UPLOAD_PATH.'/'.$imageName,100);
            $products->image = $imageName;
        } else {
            $products->image = $request->old_image;
        }

        $products->update();

        return redirect()->route('products.index')->with(['success' => 'Product updated successfully']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product =Product::find($id);
        if ($product->delete()) {
            return back()->with(['success' => 'Category deleted successfully']);
        } else {
            return back()->with(['fail' => 'Something went wrong!!! Please try again']);
        }
    }
}
