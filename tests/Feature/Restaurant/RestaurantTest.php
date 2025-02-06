<?php

use App\Models\Restaurants;

test('restaurant list can be rendered', function () {
    Restaurants::factory()->count(10)->create();

    $this->get(route('restaurant.index'))
        ->assertStatus(200);
});

test('restaurant can be created', function () {
    $restaurantData = [
        'name' => 'Test Cafe',
        'longitude' => 78.4540,
        'latitude' => 21.5552,
        'added_by_user_id' => 4,
        'status'=> 'approved'
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
        'longitude' => 22.4280,
        'latitude' => 89.8765,
        'added_by_user_id' => 4,
        'status'=> 'approved'
    ];

    $this->put(route('restaurant.update', $restaurant->id), $updatedData)
        ->assertRedirect(route('restaurant.index'));

    expect(Restaurants::find($restaurant->id))
        ->name->toEqual('Updated Test Cafe')
        ->longitude->toEqual(22.4280)
        ->latitude->toEqual(89.8765)
        ->added_by_user_id->toEqual(4)
        ->status->toEqual('approved');
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
