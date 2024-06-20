<?php

declare(strict_types=1);

/**
 * PHP Skeleton app
 * Minimum structure for native PHP web apps development
 * 
 * @copyright Copyright (c) Silevester D. (https://github.com/SilverD3)
 * @link      https://github.com/devacademia/php-skeleton-ap PHP Skeleton App
 * @since     v1.0 (2024)
 */

namespace Core\Database;

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';

use \PDO;
use Core\Configure;

/**
 * This class is used to create and manage connection with DBMS
 */
class ConnectionManager
{
    private string $host;
    private string $username;
    private string $password;
    private string $database;

    private $_connection_error;

    private $_pdo;

    public function __construct()
    {
        $config = (new Configure())->read('DataSource');

        if (empty($config)) {
            $this->_connection_error = "Aucune source de données n'est configurée";
        } else {
            $this->setConfig($config);

            $dsn = "mysql:host=$this->host;dbname=$this->database;charset=utf8mb4";

            try {
                $this->_pdo = new PDO($dsn, $this->username, $this->password);
                $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                $this->_connection_error = $e->getMessage();
            }
        }
    }

    /**
     * Get the connection object
     */
    public function getConnection()
    {
        return $this->_pdo;
    }

    /**
     * Set connection properties
     *
     * @param array $config 
     * @return void
     */
    public function setConfig(array $config)
    {
        if (isset($config['host'])) {
            $this->host = $config['host'];
        }

        if (isset($config['username'])) {
            $this->username = $config['username'];
        }

        if (isset($config['password'])) {
            $this->password = $config['password'];
        }

        if (isset($config['database'])) {
            $this->database = $config['database'];
        }
    }

    public function getDatabase()
    {
        return $this->database;
    }

    public function getError()
    {
        return $this->_connection_error;
    }

    public function closeConnection(): void
    {
        $this->_pdo = null;
    }
}
