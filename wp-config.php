<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '`@=,,ff-=7;#<E|?PGhWa8M t3@,pxn(6rosZ3CyeC[!YFNy16wY#5jmLK=T4vv$' );
define( 'SECURE_AUTH_KEY',   'n3|9oC~%$q,dYSr3VAW3|j1zN>AI|EL`e|!I:Iq-<ltBpiMhe!4wWP~oqg%!^cGO' );
define( 'LOGGED_IN_KEY',     'J}3va.^c&LM=/p8=(d$AZcBct;M!CrCN+##oe~kx/Qp2~g@x&{o%x0n_S>Jzav97' );
define( 'NONCE_KEY',         '}YOxz^3FWkYev_g>E@ 6:XVj9=Cz9/rE4I2.+n2tLxZ+T[=5m@V{%{eT-mG2k%LV' );
define( 'AUTH_SALT',         'S,(pnQ6:#ahaP+g!A8mSR8WGOhD-fZtYK/$v;PgD8;dx,2bZ[k=DG<f|e:[W {CJ' );
define( 'SECURE_AUTH_SALT',  '-bTD3QFqZ1Q_vqn|]^A4OYL</F8^x!)k-a>r<*|qBOFiMGF8Hs&Kfs*k{89a.6s~' );
define( 'LOGGED_IN_SALT',    'M,CT0#<s}=9C~:feCxP+KqT^>/0Pm}T?43DH^TQw_oqE}1Geaslm^SIu;E<_?.0!' );
define( 'NONCE_SALT',        'tX4e4[fjQ6w4Ke9l[!U`oapcdmZY{],p+ZxC~G9sNc,4Yp./hWMO]vm+/WU~+oTJ' );
define( 'WP_CACHE_KEY_SALT', 'M*P!nE5UymUbFo1#wH{[^GKWWg+=~0qOX$>~j7-R{dLY4o3Lq%VX#+F4`~I!eECU' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'tln_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
