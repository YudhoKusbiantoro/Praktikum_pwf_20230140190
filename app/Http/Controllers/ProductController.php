<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);

        return view('product.index', compact('products'));
    }

    public function store(StoreProductRequest $request)
    {
        Gate::authorize('create', Product::class);

        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        try {
            Product::create($validated);
            return redirect()->route('product.index')->with('success', 'Product created successfully.');
        } catch (QueryException $e) {
            Log::error('Product store database error', [
                'message' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Database error while creating product.');
        } catch (\Throwable $e) {
            Log::error('Product store unexpected error', [
                'message' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Unexpected error occurred.');
        }
    }

    public function create()
    {
        Gate::authorize('create', Product::class);

        // UCP 1 Penjelasan Detail:
        // 1. Category::all() : Memerintahkan model Category untuk melakukan eksekusi perintah SQL "SELECT * FROM categories". Ini akan mengambil seluruh baris data dari tabel kategori di database tanpa filter.
        // 2. $categories =   : Hasil tarikan data dari database tersebut kemudian ditampung dalam bentuk Collection (kumpulan objek) ke dalam variabel $categories.
        $categories = Category::all();
        
        // UCP 1 Penjelasan Detail:
        // 1. compact('categories'): Menyertakan variabel $categories agar dikirim ke halaman view. Hal ini sangat penting agar form produk yang ditampilkan bisa melakukan perulangan (@foreach) data kategori untuk diletakkan di dalam tag <select> (dropdown form).
        return view('product.create', compact('categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('product.view', compact('product'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        Gate::authorize('update', $product);

        $validated = $request->validated();

        // Check if there are any changes
        $product->fill($validated);
        if (!$product->isDirty()) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Tidak ada perubahan data!');
        }

        try {
            $product->save();
            return redirect()->route('product.index')->with('success', 'Product updated successfully.');
        } catch (QueryException $e) {
            Log::error('Product update database error', [
                'message' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Database error while updating product.');
        } catch (\Throwable $e) {
            Log::error('Product update unexpected error', [
                'message' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Unexpected error occurred.');
        }
    }

    public function edit(Product $product)
    {
        Gate::authorize('update', $product);

        return view('product.update', compact('product'));
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        Gate::authorize('delete', $product);

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product berhasil dihapus');
    }
}