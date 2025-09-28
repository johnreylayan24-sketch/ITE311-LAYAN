<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
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
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing here
    }
}
