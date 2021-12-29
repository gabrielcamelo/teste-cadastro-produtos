<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Tag;
use App\Http\Requests\ProductFormRequest;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    private $product;
    private $tag;

    public function __construct(Product $product, Tag $tag)
    {
        $this->middleware('auth');
        $this->product = $product;
        $this->tag     = $tag;
    }

    // ============================================================================

    public function index()
    {
        $products  = Product::all();
        $tags      = Tag::all();
        return view('products.index', compact('products', 'tags'));
    }

    // ============================================================================

    public function filtroTag($id)
    {
        $products = Product::whereHas('tags', function($query) use($id) {
            $query->whereIn('tag_id', [$id]);
        })->get();

        $tags      = Tag::all();
        return view('products.filtro', compact('products', 'tags'));
    }

    // ============================================================================

    public function create()
    {
        $tags = Tag::all();
        return view('products.create-edit', compact('tags'));
    }

    // ============================================================================

    public function store(ProductFormRequest $product)
    {

        $dataFormProduct   = $product->all();

        if ($product->image->isValid()) {
            $image = $product->image->store('public/products');
            $image = str_replace('public/','',$image);
            $dataFormProduct['image'] = $image;
        }

        $insert  = Product::create($dataFormProduct);

        //TAGS
        $insert->tags()->attach($product->get('tags'));

        if ($insert) {
            return redirect ()->route('products.index');
        } else {
            return redirect ()->route('products.create');
        }
    }

    // ============================================================================

    public function show($id)
    {
        //
    }

    // ============================================================================

    public function edit($id)
    {
        $product = Product::find($id);
        $tags    = Tag::all();
        return view('products.create-edit', compact('product', 'tags'));
    }

    // ============================================================================

    public function update(ProductFormRequest $product, $id)
    {
        $dataForm = $product->all();
        $productFind  = Product::find($id);

        if ($product->image->isValid()) {
            $image = $product->image->store('public/products');
            $image = str_replace('public/','',$image);
            $dataForm['image'] = $image;
        }
        
        Storage::delete("public/{$productFind->image}");
        $update   = $productFind->update($dataForm);

        //TAGS
        $productFind->tags()->sync($product->get('tags'));

        if ($update) {
            return redirect()->route('products.index');
        } else {
            return redirect()->route('products.edit')->with(['errors' => 'Falha ao editar']);
        }
    }

    // ============================================================================

    public function destroy($id)
    {
        $product = Product::find($id);

        $delete = $product->delete();

        if ($delete) {
            Storage::delete("public/{$product->image}");
            return redirect()->route('products.index');
        } else {
            return redirect()->route('products.index')->with(['errors' => 'Falha ao deletar']);
        }
    }
}
