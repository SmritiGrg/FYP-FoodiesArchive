<?php

use App\Models\FoodPost;
use App\Models\FoodPosts;
use App\Models\User;

test('a user info can be updated', function () {
    $user = User::factory()->create();

    $updatedData = [
        'full_name' => 'Updated Full Name',
        'username' => 'Updated Username',
        'email' => 'updatedemail@gmail.com',
        'image' => 'updatedImage.png',
    ];
    $this->actingAs($user)
        ->put(route('profile.update', $user->id), $updatedData)
        ->assertRedirect(route('profile'));

    expect(User::find($user->id))
        ->full_name->toEqual('Updated Full Cafe')
        ->username->toEqual('Updated Username')
        ->email->toEqual('updatedemail@gmail.com')
        ->image->toEqual('updateImage');
});

test('a user can be deleted', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->delete(
        route('profile.destroy', $user->id)
    )
        ->assertRedirect(route('profile'))
        ->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
});

test('user can bookmark a food post', function () {
    $user = User::factory()->create();
    $foodPost = FoodPosts::factory()->create();

    $this->actingAs($user)->post(route('food_post.bookmark', $foodPost->id))
        ->assertDatabaseHas('bookmarks', [
            'user_id' => $user->id,
            'food_post_id' => $foodPost->id,
        ]);
});
