<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\Concerns\HasUser;
use Tests\TestCase;
use App\Exceptions\UserDisabledException;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
    use HasUser;

    public function test_it_can_render_login_view(): void
    {
        $response = $this->get('/login');

        $response->assertOk();
        $response->assertSeeInOrder([trans('email')]);
    }

    public function test_it_can_login_user(): void
    {
        $user = $this->enabledUser(['email' => 'test@gmail.com']);

        $response = $this->post('/login', ['email' => $user->email(), 'password' => 'password']);

        $response->assertSessionHasNoErrors();
        $this->assertAuthenticated();
    }

    public function test_it_dont_authentication_with_wrong_password(): void
    {
        $user = $this->user(['email' => 'test@gmail.com']);

        $response = $this->post('/login', ['email' => $user->email(), 'password' => 'password1']);

        $response->assertSessionHasErrors('email');
        $this->assertNull(Auth::user());
    }

    public function test_a_disabled_user_cant_login(): void
    {
        $user = $this->disabledUser(['email' => 'test2@gmail.com']);

        $response = $this->post('login', ['email' => $user->email(), 'password' => 'password']);

        $this->assertNull(Auth::user());
        $this->getExpectedException(UserDisabledException::class);
    }
}
