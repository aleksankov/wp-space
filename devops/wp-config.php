<?php
define( 'WP_CACHE', true ); // Added by WP Rocket

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
define( 'AUTH_KEY',         'c%I:kN=ZO?{CB;cBVRWOigix^(tEY}<*hf,*&C+LaMn@Zz!{c_>.^z6|jIK yHpZ' );
define( 'SECURE_AUTH_KEY',  '+~2GJ8kf%}MEHiFaHa|r>j~XHLr)gz7=p;@im![dhba!uGIbGE5deZ]Ss_5_H?XL' );
define( 'LOGGED_IN_KEY',    'iJcroFKgPr?5gYvEhr7{T-K8gno#B]rEJ|0]czHUJ:taN77|H/w,F7O_Ha0xS:o*' );
define( 'NONCE_KEY',        '@<Fu8Su9+JLkel$k_4/o<eUJaG:.9Pd;$cv+3=6}]k#mc*?G%uSJ>?S~~#5slX}y' );
define( 'AUTH_SALT',        'EW0DMqTk>zHJBuA7RDxee1BB:TAZ$1!sL<Yox#u(CV#:S=(ot=BB2#yY|V4i9JNr' );
define( 'SECURE_AUTH_SALT', 'RQ]uN~AP<!%hU$C(8>.-mzIR-dggqTkL8_Q;>_m6bt#8eKs+6rm6VqGLR@@hg/Wg' );
define( 'LOGGED_IN_SALT',   'k1{K>>+`<=8J[`l&bYu(%om0Fw;&a*p<prNHSeDYaXr`D$CYE~>[Go69RMN7ylsX' );
define( 'NONCE_SALT',       'R8~M nd{&Igj7W@ ]#hpisa!.]So!B@K?% wDNfc@>([o7GmA/]SH6f4lY^`bIGe' );

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
define( 'WP_ENVIRONMENT_TYPE', 'development' );
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_DISPLAY', false );
define( 'WP_DEBUG_LOG', true );
define( 'SCRIPT_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname(__FILE__) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
