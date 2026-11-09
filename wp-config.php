<?php
define( 'WP_CACHE', true );

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
define( 'DB_NAME', 'wp_literasi' );

/** Database username */
define( 'DB_USER', 'wp_user' );

/** Database password */
define( 'DB_PASSWORD', 'jeki14' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'vCe/+Q*>5==k<KI2Px_Z+(CHnn&&adUfvPGwN;uy$PZ;{p1jsRX7&@{1&`JR:=V5' );
define( 'SECURE_AUTH_KEY',  '37KadpNCPH-SiL$vuYId|0!p+(q.vAkf+&Rm2Z;`Cyug9B`TWG3TZS2C.K!l@kRt' );
define( 'LOGGED_IN_KEY',    '_%b[5,PJb@sK+lCo92(wGExj|$YT~ {3T5u8q+Z/AP7hiaM/Q$NXbr?$^s$dXFL9' );
define( 'NONCE_KEY',        '1xUDcHClK5=VE()5wzH0m JD o;dn #+p!P6t?tjMlOQUDBW<~+22D@`d!-9L/(*' );
define( 'AUTH_SALT',        '0j.<0J/fZTVA^B%*`WB<JId:A*|^Vn#TB!~((AUYzBy}>5=.WH3]F5]rod?E)<s,' );
define( 'SECURE_AUTH_SALT', 'D3/?-)i~US(R;y=*!48jT865sFyL_aeG}C!1p.2Xi}{;}7^62Z(<KY&9~!,8PfYB' );
define( 'LOGGED_IN_SALT',   'sE&81fSrBLEPM}2oMQP{Ex: 16BE_6kG9-/.et|)i_@3WQ(<5UMOW<z4:2:Jufb9' );
define( 'NONCE_SALT',       '-QiAN`,Qg=uOiMj|$)=p24*^Y*UT@pGz7&`DeQFuY=7]2e?&t6fJe|^!c0S0}[XE' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
