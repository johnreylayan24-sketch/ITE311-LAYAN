<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // If no roles specified, allow access
        if (empty($arguments)) {
            return;
        }

        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Please login to access this page.');
        }

        $userRole = session()->get('user_role');
        
        // Check if user has any of the required roles
        if (!in_array($userRole, $arguments)) {
            // Log unauthorized access attempt
            log_message('warning', 'Unauthorized access attempt to ' . current_url() . ' by user ID ' . session()->get('user_id'));
            
            // Show 403 Forbidden
            throw new \CodeIgniter\Exceptions\PageNotFoundException('You do not have permission to access this page.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after the request
    }
}
