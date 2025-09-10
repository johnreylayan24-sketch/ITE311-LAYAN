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

            // Debug: Log incoming data
            log_message('debug', 'Registration attempt: ' . json_encode($this->request->getVar()));

            if ($this->validate($rules)) {
                // Debug: Validation passed
                log_message('debug', 'Registration validation passed');
                $userModel = new UserModel();

                $userData = [
                    'name'     => $this->request->getVar('name'),
                    'email'    => $this->request->getVar('email'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'role'     => 'user'
                ];

                // Debug: Log user data before saving
                log_message('debug', 'Saving user data: ' . json_encode($userData));
                
                try {
                    $userModel->save($userData);
                    // Debug: Log successful save
                    log_message('debug', 'User saved successfully');
                    
                    return redirect()
                        ->to(site_url('auth/login'))
                        ->with('success', 'Registration successful! Your account has been created. Please login to continue.');
                } catch (\Exception $e) {
                    // Debug: Log database error
                    log_message('error', 'Database error: ' . $e->getMessage());
                    
                    return redirect()
                        ->to(site_url('auth/register'))
                        ->with('error', 'Database error: ' . $e->getMessage());
                }
            } else {
                // Debug: Log validation errors
                log_message('debug', 'Registration validation failed: ' . json_encode($this->validator->getErrors()));
                
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('validation', $this->validator);
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
