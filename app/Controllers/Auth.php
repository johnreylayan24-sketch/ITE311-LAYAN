<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    // Show registration form + handle registration
    public function register()
    {
        helper(['form']);
        $session = session();

        if ($this->request->getMethod() === 'post') {
            // Validation rules
            $rules = [
                'name'             => 'required|min_length[3]|max_length[100]',
                'email'            => 'required|valid_email|is_unique[users.email]',
                'password'         => 'required|min_length[6]|max_length[255]',
                'password_confirm' => 'required|matches[password]',
            ];

            if ($this->validate($rules)) {
                $userModel = new UserModel();

                $userData = [
                    'name'     => $this->request->getVar('name'),
                    'email'    => $this->request->getVar('email'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'role'     => 'user'
                ];

                $userModel->save($userData);

                // ✅ Auto-login user after registration
                $newUser = $userModel->where('email', $userData['email'])->first();

                $session->set([
                    'user_id'    => $newUser['id'],
                    'user_name'  => $newUser['name'],
                    'user_role'  => $newUser['role'],
                    'isLoggedIn' => true
                ]);

                return redirect()
                    ->to(site_url('auth/dashboard'))
                    ->with('success', 'Welcome, ' . $newUser['name'] . '! You are now logged in.');
            } else {
                return view('auth/register', [
                    'validation' => $this->validator
                ]);
            }
        }

        return view('auth/register');
    }

    // Show login form + handle login
    public function login()
    {
        helper(['form', 'url']);
        $session = session();
        $userModel = new UserModel();

        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            
            $user = $userModel->where('email', $email)->first();

            if ($user && password_verify($password, $user['password'])) {
                $userData = [
                    'user_id'    => $user['id'],
                    'user_name'  => $user['name'],
                    'user_role'  => $user['role'],
                    'isLoggedIn' => true
                ];
                
                $session->set($userData);

                return redirect()->to(site_url('auth/dashboard'));
            } else {
                return redirect()->back()->with('error', 'Invalid login credentials.');
            }
        }

        return view('auth/login');
    }

    // Logout and destroy session
    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()
            ->to(base_url('auth/login'))
            ->with('success', 'You have been logged out.');
    }

    // Protected dashboard
    public function dashboard()
    {
        $session = session();

        if (!$session->has('isLoggedIn') || !$session->get('isLoggedIn')) {
            return redirect()
                ->to(site_url('auth/login'))
                ->with('error', 'You must log in first.');
        }

        $data = [
            'user' => $session->get('user_name'),
            'user_data' => [
                'name' => $session->get('user_name'),
                'role' => $session->get('user_role')
            ]
        ];
        
        return view('auth/dashboard', $data);
    }
}
