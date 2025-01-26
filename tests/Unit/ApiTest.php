<?php

namespace Tests\Unit;

use Illuminate\Http\Response;
use Tests\TestCase;

class ApiTest extends TestCase
{

    public function test_get_category_items()
    {
        $response = $this->get($this->apiRoute('categories/items'));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_get_payment_methods()
    {
        $response = $this->get($this->apiRoute('payment-methods'));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_get_areas()
    {
        $response = $this->get($this->apiRoute('areas'));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_get_store_status()
    {
        $response = $this->get($this->apiRoute('store/status'));
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_success_coupon_code_for_delivery_request()
    {
        $formData = [
            'coupon_code' => "123456",
            'is_delivery' => true
        ];
        $response = $this->post($this->apiRoute('coupon'), $formData);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_failed_coupon_code_for_delivery_request()
    {
        $formData = [
            'coupon_code' => "123456",
            'is_delivery' => false
        ];
        $response = $this->post($this->apiRoute('coupon'), $formData);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_success_coupon_code_pickup_request()
    {
        $formData = [
            'coupon_code' => "654321",
            'is_delivery' => false
        ];
        $response = $this->post($this->apiRoute('coupon'), $formData);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_failed_coupon_code_pickup_request()
    {
        $formData = [
            'coupon_code' => "654321",
            'is_delivery' => true
        ];
        $response = $this->post($this->apiRoute('coupon'), $formData);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_create_new_order_delivery_success()
    {
        $formData = [
            'name' => "Name Test",
            'email' => "test@test",
            'phone' => "+123456789",
            'delivery' => true,
            'payment_method' => 1,
            'comment' => null,
            'area' => 1,
            'street' => "test_street",
            'street_number' => "test_street_number",
            'neighborhood' => "test_neighborhood",
            'complement' => "test_complement",
            'cart' => ['total' => 100, "items" => []],
        ];
        $response = $this->post($this->apiRoute('order'), $formData);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_create_new_order_delivery_failed()
    {
        $formData = [
            'name' => "Name Test",
            'email' => "test@test",
            'phone' => "+123456789",
            'delivery' => true,
            'payment_method' => 1,
            'comment' => null,
            'cart' => ['total' => 100, "items" => []],
        ];
        $response = $this->post($this->apiRoute('order'), $formData);
        $response->assertStatus(Response::HTTP_FOUND);
    }

    public function test_create_new_order_pickup_success()
    {
        $formData = [
            'name' => "Name Test",
            'email' => "test@test",
            'phone' => "+123456789",
            'delivery' => false,
            'payment_method' => 1,
            'comment' => null,
            'cart' => ['total' => 100, "items" => []],
        ];
        $response = $this->post($this->apiRoute('order'), $formData);
        $response->assertStatus(Response::HTTP_OK);
    }

    private function apiRoute(string $value): string
    {
        return "/api/v1/{$value}";
    }
}
