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
define('DB_NAME', 'unitetoh_demo_wppluginlock');

/** MySQL database username */
define('DB_USER', 'unitetoh_demou');

/** MySQL database password */
define('DB_PASSWORD', '{Q}HCrM1@Pq~');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '2V1[d4f*B;#l^O#aYD!:)$0qOMsK}AJ[5wkQK{EuiL-QvrKN})EOY]!&T6:HvI1C');
define('SECURE_AUTH_KEY',  'mq%X=,sgY/-fE|a^AJs</-DDBnDk!FwbDy1|VvYa81I`%eXh[-CQh#/Uhe93TvTC');
define('LOGGED_IN_KEY',    't[A1CJ=<]!@9t27*nX:U&:2sx$^1dF)hT:l.%vj#vWdq<W48dQ8*9OTiMgG#TEi1');
define('NONCE_KEY',        'yqmV c`bo4d,gy=v|^x8{-8EK@!-Ie/A=e}n7: 8E?I9>f2`0Jann-nB5+m}6(pJ');
define('AUTH_SALT',        'Xj.WX~: (yHv-}cy:/}+9Vg}J%>7-]Fx&72x809`[97L$wb!tiicdqwP2*bNM/jE');
define('SECURE_AUTH_SALT', '5jWKQlVEAKsmqS94r+^uLLZDkZ6C&r<Z`PLOm>B8r^_Ib0r/<~FXF@}AX%&uov^~');
define('LOGGED_IN_SALT',   'DLapb|jNJJ(,q~Cd][*i}-!:rHx_,JcAyP7n(cFw:XelQFF660zN9q$i[4 0b#tc');
define('NONCE_SALT',       '9ex{,[#O>NU~l]{ >:O8ddsb(JQs%h&8!<%]%(9tH8`Pup[9%VXAi7].Il`7:g}5');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
