<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;


class UserDisabledException extends Exception
{
    private Request $request;

    public function __construct(Request $request, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code);
        $this->request = $request;
    }

    public function render(): RedirectResponse
    {
        return redirect()->route('login')->with('status', trans('auth_blocked'));
    }

    public function context(): array
    {
        return ['email' => $this->request->input('email'), 'ip' => $this->request->ip()];
    }
}
