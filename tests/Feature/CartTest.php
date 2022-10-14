<?php

namespace Tests\Feature;

use Tests\TestCase;

class CartTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_basket()
    {
        $get_response = $this->get('/cart');
        $response = $this->post('/cart', ['cart' => '[{"id":1,"amount":1}]']);

        $get_response->assertStatus(405);
        $response->assertStatus(200);
        $response->assertSeeText('Коробка');
        $response->assertSeeText('– 1 шт');
        $response->assertViewHasAll(['boxes']);
    }
}
