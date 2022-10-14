<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_success_response_products_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_not_found()
    {
        $response = $this->get('/rewrewrewrewr');

        $response->assertStatus(404);
    }

    public function test_products_api()
    {
        $post_response = $this->post('/api/v1/products');
        $response = $this->get('/api/v1/products');
        $filter_response = $this->get('/api/v1/products/?filters%5Bsearch%5D=%D0%9B%D0%BE%D0%B6%D0%BA%D0%B0&filters%5Bcategory%5D=3&filters%5Bmaterial%5D=%D0%A1%D1%82%D0%B0%D0%BB%D1%8C');

        $post_response->assertStatus(405);
        $response->assertStatus(200);
        $this->assertJson($response->content());
        $this->assertEquals(100, $response->json()['total']);
        $this->assertEquals('Сталь', $filter_response->json()['data'][0]['material']);
        $this->assertEquals('Столовые приборы', $filter_response->json()['data'][0]['category']['name']);
        $this->assertEquals('Ложка стальная', $filter_response->json()['data'][0]['name']);
    }
}
