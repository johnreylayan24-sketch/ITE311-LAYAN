<?php

namespace Config;

use CodeIgniter\Session\Handlers\FileHandler;

class CustomSessionHandler extends FileHandler
{
    public function __construct($config, string $ipAddress)
    {
        // Ensure the session directory exists and is writable
        $sessionPath = WRITEPATH . 'session';
        
        if (!is_dir($sessionPath)) {
            mkdir($sessionPath, 0700, true);
        }
        
        // Set the save path
        $config->savePath = $sessionPath . DIRECTORY_SEPARATOR;
        
        parent::__construct($config, $ipAddress);
    }
}
