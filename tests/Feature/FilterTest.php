<?php

namespace Tests\Feature;

use App\Domain\Product\Product;
use Tests\TestCase;

class FilterTest extends TestCase
{
    public function test_a_basic_request()
    {
        $response = $this->get('/');

        $response->assertSuccessful();
    }

    public function test_has_filtered_results()
    {
        $cities = ['moscow', 'rostov', 'krasnodar', 'volgograd'];
        $categories = ['laptops', 'tablets'];

        $product = Product::factory()->withAttributes($cities, $categories)->create();

        $response = $this->get('/?city=moscow&category=none');

        $response->assertSee($product->name);

        $response = $this->get('/?category=laptops');

        $response->assertSee($product->name);

        $response = $this->get('/?city=moscow&city=rostov&category=none');

        $response->assertSee($product->name);
    }

    public function test_doesnt_have_filtered_results()
    {
        $cities = ['moscow', 'rostov', 'krasnodar', 'volgograd'];
        $categories = ['laptops', 'tablets'];

        $product = Product::factory()->withAttributes($cities, $categories)->create();

        $response = $this->get('/city=astrakhan&category=none');

        $response->assertDontSee($product->name);

        $response = $this->get('/category=desktops');

        $response->assertDontSee($product->name);
    }
}
