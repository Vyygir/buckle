<?php
/**
 * Setup the application configuration state
 * 
 * @package buckle
 * @since 1.0.0
 */
$webroot = $root = dirname(__DIR__);

// Expose the global environment function (oscarotero/env)
Env::init();

// Configure Dotenv to load the environment variables from our .env file
$dotenv = new Dotenv\Dotenv($root);

if (file_exists($root . '/.env')) {
    $dotenv->load();
    $dotenv->required(['DB_NAME', 'DB_USER', 'DB_PASSWORD', 'WP_HOME', 'WP_SITEURL']);
}

// Configure the current WordPress environment
define('WP_ENV', env('WP_ENV') ?: 'development');

$config = __DIR__ . '/environments/' . WP_ENV . '.php';

if (file_exists($config)) {
    require_once $config;
}

// Define the site-wide constants
define('WP_HOME', env('WP_HOME'));
define('WP_SITEURL', env('WP_SITEURL'));

define('CONTENT_DIR', '/app');
define('WP_CONTENT_DIR', $webroot . CONTENT_DIR);
define('WP_CONTENT_URL', WP_HOME . CONTENT_DIR);

define('DB_NAME', env('DB_NAME'));
define('DB_USER', env('DB_USER'));
define('DB_PASSWORD', env('DB_PASSWORD'));
define('DB_HOST', env('DB_HOST') ? : 'localhost');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

$table_prefix = env('DB_PREFIX') ? : 'wp_';

define('AUTH_KEY', env('AUTH_KEY'));
define('SECURE_AUTH_KEY', env('SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY', env('LOGGED_IN_KEY'));
define('NONCE_KEY', env('NONCE_KEY'));
define('AUTH_SALT', env('AUTH_SALT'));
define('SECURE_AUTH_SALT', env('SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT', env('LOGGED_IN_SALT'));
define('NONCE_SALT', env('NONCE_SALT'));

define('AUTOMATIC_UPDATER_DISABLED', env('AUTOMATIC_UPDATER_DISABLED') ? : false);
define('DISABLE_WP_CRON', env('DISABLE_WP_CRON') ? : false);
define('DISALLOW_FILE_EDIT', true);

// Initialise WordPress' ABSPATH
if (!defined('ABSPATH')) {
    define('ABSPATH', $webroot . '/cms/');
}
