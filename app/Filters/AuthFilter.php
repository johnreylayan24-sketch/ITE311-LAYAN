<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            // Store the intended URL for redirecting after login
            session()->set('redirect_url', current_url());
            
            return redirect()->route('login')
                ->with('error', 'Please login to access this page.');
        }
        
        // Email verification is not required
        // All logged-in users can access the application
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after the request
    }
}
