<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return '用户列表';
    }

    public function profile()
    {
        return '个人信息';
    }
}
