<?php

// tests/Feature/UserTaskTest.php

namespace Tests\Feature;

use App\Models\Tasks;
use App\Models\User;
use Illuminate\Console\View\Components\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserTaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Kullanıcı görev oluşturma işlemini test et.
     *
     * @return void
     */
    public function test_user_can_create_task()
    {
        $user = User::factory()->create();

        $taskData = [
            'title' => 'Test Task',
            'description' => 'Test Description',
        ];


        $response = $this->actingAs($user)->post(route('tasks-store'), $taskData);


        $this->assertDatabaseHas('tasks', [
            'name' => 'Test Task',
            'desc' => 'Test Description',
            'user_id' => $user->id,
        ]);
    }
}
