<?php

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $user = \App\Models\User::create([
        'full_name' => 'Test User',
        'username' => 'testuser',
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
        'role' => 'creator',
        'image' => 'test.png',
    ]);

    // Log the user in
    $this->actingAs($user);

    // Run the registration action
    $response = $this->post('/register', [
        'full_name' => 'Test User',
        'username' => 'testuser',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'creator',
        'image' => 'test.png',
    ]);

    // Assert that the user is authenticated and redirected
    $this->assertAuthenticated();
    $response->assertRedirect('/');
});
