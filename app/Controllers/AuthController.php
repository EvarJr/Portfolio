<?php

namespace App\Controllers;

use App\Models\AdminUserModel;

/**
 * AuthController — app/Controllers/AuthController.php
 */
class AuthController extends BaseController
{
    public function index(): string
    {
        if ($this->isLoggedIn()) {
            return redirect()->to(base_url('admin'))->send() ?: '';
        }
        return view('auth/login', ['error' => '']);
    }

    public function login()
    {
        $username = trim($this->request->getPost('username') ?? '');
        $password = $this->request->getPost('password') ?? '';

        $model = new AdminUserModel();
        $user  = $model->findByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'admin_logged_in' => true,
                'admin_id'        => $user['id'],
                'admin_username'  => $user['username'],
            ]);
            return redirect()->to(base_url('admin'));
        }

        return view('auth/login', [
            'error' => 'Invalid username or password. Please try again.',
        ]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}