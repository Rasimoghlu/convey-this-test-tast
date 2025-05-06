<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    ) {
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();

        return view('users', compact('users'));
    }
}
