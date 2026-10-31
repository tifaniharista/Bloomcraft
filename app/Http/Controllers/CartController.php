<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $products = Product::whereIn('id', array_map('intval', array_keys($cart)))->get()->keyBy('id');
        $normalized = [];
        $removedUnavailable = false;

        foreach ($cart as $id => $item) {
            $product = $products->get((int) $id);
            if (!$product || $product->status !== 'active') {
                $removedUnavailable = true;
                continue;
            }

            $quantity = max(1, (int) ($item['quantity'] ?? 1));
            $images = $product->image;
            if (!is_array($images)) {
                $images = $images ? (json_decode($images, true) ?: [$images]) : [];
            }

            $normalized[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $this->currentPrice($product),
                'image' => $images,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $normalized);
        if ($removedUnavailable) {
            session()->flash('error', 'Produk yang sudah tidak tersedia dihapus dari keranjang. Periksa kembali isi keranjang.');
        }

        return view('cart.index', ['cart' => $normalized]);
    }

    public function add(Request $request, $id)
    {
        $product = Product::where('status', 'active')->findOrFail($id);
        if ((int) $product->stock < 1) {
            return redirect()->route('cart.index')->with('error', 'Produk sedang habis.');
        }

        $cart = session()->get('cart', []);
        $currentQuantity = (int) ($cart[$id]['quantity'] ?? 0);
        if ($currentQuantity + 1 > (int) $product->stock) {
            return redirect()->route('cart.index')->with('error', 'Jumlah di keranjang sudah mencapai stok yang tersedia.');
        }

        $images = $product->image;
        if (!is_array($images)) {
            $images = $images ? (json_decode($images, true) ?: [$images]) : [];
        }

        $cart[$id] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $this->currentPrice($product),
            'image' => $images,
            'quantity' => $currentQuantity + 1,
        ];
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $cart = session()->get('cart', []);
        if (!isset($cart[$id])) {
            return redirect()->route('cart.index')->with('error', 'Produk tidak ditemukan di keranjang.');
        }

        $product = Product::where('status', 'active')->find($id);
        if (!$product) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('error', 'Produk sudah tidak tersedia dan dihapus dari keranjang.');
        }

        if ((int) $validated['quantity'] > (int) $product->stock) {
            return redirect()->route('cart.index')->with('error', 'Jumlah melebihi stok tersedia: ' . (int) $product->stock . '.');
        }

        $images = $product->image;
        if (!is_array($images)) {
            $images = $images ? (json_decode($images, true) ?: [$images]) : [];
        }

        $cart[$id] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $this->currentPrice($product),
            'image' => $images,
            'quantity' => (int) $validated['quantity'],
        ];
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Jumlah produk berhasil diperbarui.');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil dikosongkan.');
    }

    private function currentPrice(Product $product): int
    {
        $regular = (int) round((float) $product->price);
        $sale = $product->sale_price !== null ? (int) round((float) $product->sale_price) : null;
        return $sale !== null && $sale > 0 && $sale < $regular ? $sale : $regular;
    }
}
