<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if user is logged in using both session methods for compatibility
        $isLoggedIn = session()->get('isLoggedIn') || isset($_SESSION['user']);
        
        if (!$isLoggedIn) {
            // Store the intended URL for redirecting after login
            $redirectUrl = current_url();
            if ($redirectUrl !== base_url('login') && $redirectUrl !== base_url('auth/login')) {
                session()->set('redirect_url', $redirectUrl);
            }
            
            return redirect()->to('/login')
                ->with('error', 'Please login to access this page.');
        }
        
        // Check for role-based access if arguments are provided
        if ($arguments && !empty($arguments)) {
            $userRole = session()->get('role') ?? $_SESSION['user']['role'] ?? 'guest';
            $requiredRole = $arguments[0] ?? null;
            
            if ($requiredRole && $userRole !== $requiredRole) {
                // User doesn't have the required role
                return redirect()->to('/unauthorized')
                    ->with('error', 'You do not have permission to access this page.');
            }
        }
        
        // If we get here, the user is authorized
        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after the request
    }
}
