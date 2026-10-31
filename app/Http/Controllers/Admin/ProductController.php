<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Menampilkan semua produk.
     */
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Form tambah produk.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Simpan produk baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'category_id'   => 'required|exists:categories,id',
            'price'         => 'required|numeric|min:0',
            'stock'         => 'required|integer|min:0',
            'description'   => 'nullable|string|max:5000',
            'images'        => 'required|array|min:1|max:5',
            'images.*'      => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $images = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('products', 'public');
            }
        }

        Product::create([
            'name'          => $request->name,
            'slug'          => Str::slug($request->name) . '-' . time(),
            'category_id'   => $request->category_id,
            'price'         => $request->price,
            'stock'         => $request->stock,
            'description'   => $request->description,
            'status'        => 'active',
            'image'         => $images,
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Detail produk.
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Form edit produk.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view(
            'admin.products.edit',
            compact('product', 'categories')
        );
    }

    /**
     * Update produk.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'          => 'required',
            'category_id'   => 'required|exists:categories,id',
            'price'         => 'required|numeric|min:0',
            'stock'         => 'required|integer|min:0',
            'description'   => 'nullable|string|max:5000',
            'images'        => 'sometimes|array|max:5',
            'images.*'      => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'name'          => $request->name,
            'category_id'   => $request->category_id,
            'price'         => $request->price,
            'stock'         => $request->stock,
            'description'   => $request->description,
        ];

        /*
        |--------------------------------------------------------------------------
        | Upload Foto Tambahan
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('images')) {
            $oldImages = [];

            // Ambil foto lama.
            if ($product->image) {
                if (is_array($product->image)) {
                    $oldImages = $product->image;
                } else {
                    $oldImages = json_decode($product->image, true) ?? [];
                }
            }

            $newImages = [];

            // Simpan foto baru.
            foreach ($request->file('images') as $image) {
                $newImages[] = $image->store('products', 'public');
            }

            // Gabungkan foto lama dan baru.
            $allImages = array_merge($oldImages, $newImages);

            // Batasi maksimal 5 foto.
            $allImages = array_slice($allImages, 0, 5);

            // Simpan sebagai array/JSON sesuai cast pada model Product.
            $data['image'] = $allImages;
        }

        $product->update($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Hapus satu foto produk.
     */
    public function deleteImage(Product $product, $index)
    {
        $images = [];

        /*
        |--------------------------------------------------------------------------
        | Ambil data gambar lama
        |--------------------------------------------------------------------------
        */

        if ($product->image) {
            if (is_array($product->image)) {
                $images = $product->image;
            } else {
                $images = json_decode($product->image, true) ?? [];
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Cek gambar berdasarkan index
        |--------------------------------------------------------------------------
        */

        if (isset($images[$index])) {
            // Hapus file fisik dari storage.
            Storage::disk('public')->delete($images[$index]);

            // Hapus gambar dari array.
            unset($images[$index]);

            // Rapikan index array.
            $images = array_values($images);

            // Update data gambar di database.
            $product->update([
                'image' => $images,
            ]);
        }

        return back()->with('success', 'Foto produk berhasil dihapus');
    }

    /**
     * Hapus produk.
     */
    public function destroy(Product $product)
    {
        /*
        |--------------------------------------------------------------------------
        | 1. Periksa riwayat pesanan
        |--------------------------------------------------------------------------
        */

        if ($product->orderDetails()->exists()) {
            return redirect()
                ->route('admin.products.index')
                ->with(
                    'error',
                    'Produk memiliki riwayat pesanan dan tidak dapat dihapus. Nonaktifkan produk agar riwayat transaksi tetap tersimpan.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | 2. Periksa reservasi aktif
        |--------------------------------------------------------------------------
        */

        if (
            $product->inventoryReservations()
                ->where('status', 'reserved')
                ->exists()
        ) {
            return redirect()
                ->route('admin.products.index')
                ->with(
                    'error',
                    'Produk sedang direservasi oleh pesanan. Coba lagi setelah reservasi berakhir.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | 3. Ambil daftar foto produk
        |--------------------------------------------------------------------------
        */

        $images = $product->image;

        if (is_string($images)) {
            $images = json_decode($images, true) ?? [];
        }

        if (!is_array($images)) {
            $images = $images ? [$images] : [];
        }

        /*
        |--------------------------------------------------------------------------
        | 4. Hapus data produk dari database
        |--------------------------------------------------------------------------
        |
        | Data produk dihapus setelah pemeriksaan relasi berhasil.
        | File gambar kemudian dibersihkan dari public storage.
        */

        $product->delete();

        /*
        |--------------------------------------------------------------------------
        | 5. Hapus file foto dari storage
        |--------------------------------------------------------------------------
        */

        foreach ($images as $image) {
            if (!empty($image)) {
                Storage::disk('public')->delete($image);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | 6. Kembali ke halaman daftar produk
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk dan foto berhasil dihapus');
    }
}
