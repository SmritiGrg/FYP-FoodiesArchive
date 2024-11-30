<?php

use App\Models\Restaurants;

test('restaurant list can be rendered', function () {
    Restaurants::factory()->count(10)->create();

    $this->get(route('restaurant.index'))
        ->assertStatus(200);
});

test('restaurant create page can be rendered', function () {
    $this->get(route('restaurant.create'))
        ->assertStatus(200);
});

test('restaurant can be created', function () {
    $restaurantData = [
        'name' => 'Test Cafe',
        'phone_number' => '9887656781',
        'email' => 'testcafe@gmail.com',
        'website_link' => 'https://www.testweb.com',
        'city' => 'Pokhara',
        'longitude' => 78.4540,
        'latitude' => 21.5552,
        'image' => 'test.jpg',
        'map' => '<iframe src="https://maps.google.com/?q=85.3240,27.7172"></iframe>',
        'open_time' => '08:00:00',
        'close_time' => '22:00:00',
    ];

    $this->post(route('restaurant.store'), $restaurantData)
        ->assertRedirect(route('restaurant.index'))
        ->assertDatabaseHas('restaurants', $restaurantData);
});

test('the edit page for a restaurant loads successfully', function () {
    $restaurant = Restaurants::factory()->create();

    $this->post(route('restaurant.store'), $restaurant)
        ->assertStatus(200)
        ->assertSee('Edit Restaurant')
        ->assertSee($restaurant->title);
});

test('a restaurant info can be updated', function () {
    $restaurant = Restaurants::factory()->create();

    // defining the updated data
    $updatedData = [
        'name' => 'Updated Test Cafe',
        'phone_number' => '9877765432',
        'email' => 'updatedcafe@gmail.com',
        'website_link' => 'https://www.updatedwebsite.com',
        'city' => 'Pokhara',
        'longitude' => 22.4280,
        'latitude' => 89.8765,
        'image' => 'updated.jpg',
        'map' => '<iframe src="https://maps.google.com/?q=85.3240,27.7172"></iframe>',
        'open_time' => '07:00:00',
        'close_time' => '19:00:00',
    ];

    $this->put(route('restaurant.update', $restaurant->id), $updatedData)
        ->assertRedirect(route('restaurant.index'));

    expect(Restaurants::find($restaurant->id))
        ->name->toEqual('Updated Test Cafe')
        ->phone_number->toEqual('9877765432')
        ->email->toEqual('updatedcafe@gmail.com')
        ->website_link->toEqual('https://www.updatedwebsite.com')
        ->city->toEqual('Pokhara')
        ->longitude->toEqual(22.4280)
        ->latitude->toEqual(89.8765)
        ->image->toEqual('updated.jpg')
        ->map->toEqual('<iframe src="https://maps.google.com/?q=85.3240,27.7172"></iframe>')
        ->open_time->toEqual('07:00:00')
        ->close_time->toEqual('19:00:00');
});

test('a restaurant can be deleted', function () {
    $restaurant = Restaurants::factory()->create();

    $this->delete(
        route('restaurant.destroy', $restaurant->id)
    )
        ->assertRedirect(route('restaurant.index'))
        ->assertDatabaseMissing('restaurants', [
            'id' => $restaurant->id,
        ]);
});
