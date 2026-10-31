<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BloomcraftCheckoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_checkout_creates_order_with_free_shipping_and_manual_payment(): void
    {
        $user = User::factory()->create(['role' => 'customer']);
        $category = Category::create(['name' => 'Buket', 'slug' => 'buket']);
        $product = Product::create([
            'name' => 'Buket Mawar', 'slug' => 'buket-mawar', 'category_id' => $category->id,
            'price' => 150000, 'stock' => 5, 'description' => 'Buket segar', 'status' => 'active', 'image' => [],
        ]);

        $response = $this->actingAs($user)->withSession(['cart' => [$product->id => ['quantity' => 2]]])
            ->post(route('checkout.store'), [
                'name' => 'Pelanggan Uji', 'email' => $user->email,
                'phone' => '08123456789', 'address' => 'Jl. Mawar No. 1',
            ]);

        $response->assertRedirect(route('orders.index'));
        $order = Order::firstOrFail();
        $this->assertSame(300000.0, (float) $order->total);
        $this->assertSame(0.0, (float) $order->shipping_cost);
        $this->assertSame('awaiting_proof', $order->payment_status);
        $this->assertDatabaseHas('payments', ['order_id' => $order->id, 'amount' => 300000, 'status' => 'awaiting_proof']);
        $this->assertDatabaseHas('order_details', ['order_id' => $order->id, 'product_name' => 'Buket Mawar', 'quantity' => 2, 'line_total' => 300000]);
        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 3]);
    }

    public function test_customer_cannot_upload_payment_proof_for_another_customers_order(): void
    {
        $owner = User::factory()->create(['role' => 'customer']);
        $other = User::factory()->create(['role' => 'customer']);
        $order = Order::create([
            'order_number' => 'BC-TEST-001', 'user_id' => $owner->id, 'name' => 'Owner', 'email' => $owner->email,
            'phone' => '08123456789', 'address' => 'Alamat', 'subtotal' => 10000, 'shipping_cost' => 0,
            'discount_amount' => 0, 'total' => 10000, 'status' => 'pending', 'payment_status' => 'awaiting_proof', 'order_status' => 'awaiting_payment',
        ]);
        Payment::create(['order_id' => $order->id, 'amount' => 10000, 'status' => 'awaiting_proof']);

        $this->actingAs($other)->post(route('orders.payment-proof', $order), [])->assertForbidden();
    }
}
