<?php

namespace Tests\Unit;

use App\Models\Product;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ProductTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */


    public function setUp(): void
    {
        parent::setUp();
        // ProductFactoryを使用してproductを100レコード用意する
        for ($i = 0; $i < 10; $i++) {
            factory(Product::class)->create();
        }
    }

    public function testStore()
    {
        $item = Product::where('state', Product::STATE_SELLING)->first();
        $item->store();
        $this->assertNotNull($item);
        $item->assertEquals($item->state, Product::STATE_SELLING);
    }
}
