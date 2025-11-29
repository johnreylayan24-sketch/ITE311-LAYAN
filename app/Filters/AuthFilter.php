<?php

namespace App\Filters;

<<<<<<< HEAD
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
=======
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
>>>>>>> 9bc49831b38c627ac5b7e400f2b51d63a4e97daf

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
<<<<<<< HEAD
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            // Store the intended URL for redirecting after login
            session()->set('redirect_url', current_url());
            
            return redirect()->route('login')
                ->with('error', 'Please login to access this page.');
        }
        
        // Email verification is not required
        // All logged-in users can access the application
=======
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Check if user is logged in
        if (!isset($_SESSION['user'])) {
            // Redirect to login page
            return redirect()->to('/login');
        }
        
        // Check for role-based access if arguments are provided
        if ($arguments && is_array($arguments)) {
            $userRole = $_SESSION['user']['role'] ?? 'guest';
            $requiredRole = $arguments[0] ?? null;
            
            if ($requiredRole && $userRole !== $requiredRole) {
                // User doesn't have the required role
                // You can redirect to unauthorized page or show error
                return redirect()->to('/dashboard')->with('error', 'Unauthorized access');
            }
        }
        
        return null;
>>>>>>> 9bc49831b38c627ac5b7e400f2b51d63a4e97daf
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
<<<<<<< HEAD
        // No action needed after the request
=======
        // Do nothing here
>>>>>>> 9bc49831b38c627ac5b7e400f2b51d63a4e97daf
    }
}
