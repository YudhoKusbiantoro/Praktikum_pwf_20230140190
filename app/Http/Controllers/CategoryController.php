<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // UCP 1 Penjelasan Detail:
        // 1. \App\Models\Category:: : Memanggil model Category untuk berinteraksi dengan tabel categories.
        // 2. withCount('products') : Menggunakan fungsi Eloquent untuk secara otomatis menghitung jumlah baris data dari tabel 'products' yang terhubung dengan setiap kategori. Hasil hitungan otomatis disimpan dalam atribut bernama 'products_count'.
        // 3. paginate(10)          : Mengambil data tersebut, lalu membaginya menjadi beberapa halaman (pagination), di mana setiap halaman maksimal berisi 10 data.
        // 4. $categories = ...     : Menyimpan seluruh hasil query tersebut ke dalam variabel $categories.
        $categories = \App\Models\Category::withCount('products')->paginate(10);
        
        // UCP 1 Penjelasan Detail:
        // 1. view('category.index'): Menampilkan file antarmuka (blade) yang berada di folder resources/views/category/index.blade.php.
        // 2. compact('categories') : Membungkus variabel $categories yang berisi data dari database tadi agar bisa diakses dan digunakan di dalam file view tersebut (misalnya untuk ditampilkan dalam tabel).
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        \App\Models\Category::create($validated);

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
