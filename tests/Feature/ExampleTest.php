<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    public function test_TransactionFailsWithInsufficientBalance()
    {
        $sender = User::factory()->create(['balance' => 100]);
        $receiver = User::factory()->create(['balance' => 100]);

        $response = $this->postJson('/api/transaction', [
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'amount' => 200 // Insufficient balance
        ]);

       

        // Ensure balances remain the same
        $this->assertDatabaseHas('users', ['id' => $sender->id, 'balance' => 100]);
        $this->assertDatabaseHas('users', ['id' => $receiver->id, 'balance' => 100]);
    }
}
