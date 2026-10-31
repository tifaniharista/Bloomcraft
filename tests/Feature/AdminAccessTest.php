<?php
namespace Tests\Feature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class AdminAccessTest extends TestCase {
    use RefreshDatabase;
    public function test_customer_cannot_access_admin_dashboard(): void {
        $customer=User::factory()->create(['role'=>'customer']);
        $this->actingAs($customer)->get(route('admin.dashboard'))->assertRedirect('/');
    }
    public function test_admin_can_access_admin_dashboard(): void {
        $admin=User::factory()->create(['role'=>'admin']);
        $this->actingAs($admin)->get(route('admin.dashboard'))->assertOk();
    }
}
