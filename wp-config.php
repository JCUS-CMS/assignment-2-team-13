<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wpz' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ' nPM%f{DY?r#x:<=U)BDtJ9iAg!1,pb `@s4TBuUS?PhPJ{rkiiTog88^qUoKl@&' );
define( 'SECURE_AUTH_KEY',  'Jdk~%47:+=JRcc PSqcVkv<1xMfht$51jpKE&2,>f^b87JMl]pLlbu]k-oQK_kdK' );
define( 'LOGGED_IN_KEY',    'HM/`d-k:&?jAL#&wS8d{sdcXp1RFT|ZO~9h^8BNwzccGGz%j-$0G<<UgdM/&px.b' );
define( 'NONCE_KEY',        'LJV/=fPc[Ik8)Y%!s<x-w:*:<a4drS0 eq:L991@r|u2UGPPKJtFE,%YvD<eWTi8' );
define( 'AUTH_SALT',        'LR.@q%dxj|Q/@1[Z9=F?;O~}n5i_.Z+LzDMebXKA<t{rHGO=]}=>)dCc:]:7HUGG' );
define( 'SECURE_AUTH_SALT', '^jcCP%Y;rVoVR$$Hlox fdBJ=cL-<8H(uqXd_Uu 4X*a)(])06],{rvukyU_uD</' );
define( 'LOGGED_IN_SALT',   ')f!M+ p-N]nM;(p3Q4[`QBVCSSvBLewFn,>@WLUI`2Y%*m|``Q5}&e}W8a#[bEx;' );
define( 'NONCE_SALT',       'DfBLZ?b{NWUiEbM$a@Qv=<K%Y9J//mLA cg^ ;^R*pS 3FR`QI V4s*v;(%xS7N6' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
