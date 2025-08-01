<?php
define( 'WP_CACHE', filter_var( getenv('WP_CACHE'), FILTER_VALIDATE_BOOLEAN) ); // Added by WP Rocket

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', getenv('MARIADB_DATABASE'));

/** Database username */
define( 'DB_USER', getenv('MARIADB_USER'));

/** Database password */
define('DB_PASSWORD', getenv('MARIADB_PASSWORD'));

/** Database hostname */
define('DB_HOST', getenv('DB_HOST'));

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         getenv('WP_AUTH_KEY') );
define( 'SECURE_AUTH_KEY',  getenv('WP_SECURE_AUTH_KEY') );
define( 'LOGGED_IN_KEY',    getenv('WP_LOGGED_IN_KEY') );
define( 'NONCE_KEY',        getenv('WP_NONCE_KEY') );
define( 'AUTH_SALT',        getenv('WP_AUTH_SALT') );
define( 'SECURE_AUTH_SALT', getenv('WP_SECURE_AUTH_SALT') );
define( 'LOGGED_IN_SALT',   getenv('WP_LOGGED_IN_SALT') );
define( 'NONCE_SALT',       getenv('WP_NONCE_SALT') );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_ENVIRONMENT_TYPE', getenv('WP_ENVIRONMENT_TYPE') );
define( 'WP_DEBUG', filter_var( getenv('WP_DEBUG'), FILTER_VALIDATE_BOOLEAN) );
define( 'WP_DEBUG_DISPLAY', filter_var( getenv('WP_DEBUG_DISPLAY'), FILTER_VALIDATE_BOOLEAN) );
define( 'WP_DEBUG_LOG', filter_var( getenv('WP_DEBUG_LOG'), FILTER_VALIDATE_BOOLEAN) );
define( 'SCRIPT_DEBUG', filter_var( getenv('WP_SCRIPT_DEBUG'), FILTER_VALIDATE_BOOLEAN) );

/* Add any custom values between this line and the "stop editing" line. */

define( 'WP_MEMORY_LIMIT',getenv('WP_MEMORY_LIMIT') );
define( 'WP_MAX_MEMORY_LIMIT',getenv('WP_MAX_MEMORY_LIMIT') );

define( 'AUTOMATIC_UPDATER_DISABLED', true );
define( 'WP_AUTO_UPDATE_CORE', false );

define( 'WP_ROCKET_CACHE_ROOT_PATH', getenv('WP_ROCKET_CACHE_ROOT_PATH') );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname(__FILE__) . '/' );
}

/* REdis Settings */
define ('WP_REDIS_HOST', getenv('WP_REDIS_HOST') );
define ('WP_REDIS_PORT', getenv("WP_REDIS_PORT") );
define ('WP_REDIS_PREFIX', getenv("WP_REDIS_PREFIX") );

/* Add ssl config */
define('FORCE_SSL_ADMIN', true);
if ($_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS']='on';
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
/** wp option update home https://new.spacevm.ru/ */
/** wp option update siteurl http://192.168.68.101/ */