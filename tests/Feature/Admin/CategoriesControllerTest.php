<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        // first include all the normal setUp operations
        parent::setUp();

        // now re-register all the roles and permissions (clears cache and reloads relations)
        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
    }

    protected function afterRefreshingDatabase()
    {
        $this->seed();
    }

    public function test_allow_see_categories_with_role_admin()
    {
        $categories = Category::orderByDesc('id')->paginate(5)->pluck('name')->toArray();
        $response = $this->actingAs($this->getUser())->get(route('admin.categories.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.categories.index');
        $response->assertSeeInOrder($categories);
    }

    public function test_do_not_allow_see_categories_with_role_customer()
    {
        $response = $this->actingAs($this->getUser('customer'))->get(route('admin.categories.index'));
        $response->assertStatus(403);
    }

    public function test_create_category_with_valid_data()
    {
        $categoryData = Category::factory()->withParent()->make()->toArray();

        $response = $this->actingAs($this->getUser())
            ->post(route('admin.categories.store'), $categoryData);

        $response->assertStatus(302);
        $response->assertRedirectToRoute('admin.categories.index');
        $this->assertDatabaseHas('categories', [
           'name' => $categoryData['name']
        ]);
    }

    public function test_create_category_with_invalid_data()
    {
        $data = ['name' => 'a'];

        $response = $this->actingAs($this->getUser())
            ->post(route('admin.categories.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
    }

    protected function getUser(string $role = 'admin'): User
    {
        return User::role($role)->first();
    }
}
