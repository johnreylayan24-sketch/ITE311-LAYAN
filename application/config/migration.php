<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Migrations extends BaseConfig
{
    /**
     * Enable/Disable Migrations
     */
    public $enabled = true;   // CI3: $config['migration_enabled']

    /**
     * Migration Type
     * Options: 'sequential' or 'timestamp'
     */
    public $type = 'timestamp';  // CI3: $config['migration_type']

    /**
     * Migrations Table
     */
    public $table = 'migrations';  // CI3: $config['migration_table']

    
    public $timestampFormat = 'Y-m-d-His_'; 
}
