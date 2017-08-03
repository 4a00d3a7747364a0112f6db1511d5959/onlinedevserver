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
define('DB_NAME', 'lav');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '6xl=Fi [k%I$+-#b7R]Y-hZfHpn;aHW{ct7@ToSh@W4]NO+/c7<v#lnDH%fySkx,');
define('SECURE_AUTH_KEY',  'o(h>B$eDm*nQ)iDKC[RYd9CZIae=$(0|Y5%y1nn=0YK)RF#w~u+tL,8gP|ntWHd.');
define('LOGGED_IN_KEY',    'p),^u#5E$ftE6BeU+crF0<vP1!5b/ [(Q6HN-Fc^{,;n}[jgc68Tmj1ITa__#VRr');
define('NONCE_KEY',        '{E8=,`5YZ]phg/8gZiBE@o9bPBi^^!``Q9`(RZyIz7LHUy;6<*;%H:%AoD{[S:==');
define('AUTH_SALT',        'rZe ci=/d,VuP@.AIY0{p?HbtRmoXHo^]pzYD,;w5SoPK1T=Rvpbuv99g5d.(x2u');
define('SECURE_AUTH_SALT', 'e?$6;1x 82<^S~]n1b]:-Q]Pcem$+bsQ0(z?s>#unh0P/rAoWg%7EClg Vb?bzo4');
define('LOGGED_IN_SALT',   'EvP}JlSepz%>xZm72BcuXZTL=by*D5g3kaVhS5JVj:E@WJ&c^TDbp_wjZ:};I1Qw');
define('NONCE_SALT',       'aj/4Ii!^[H=4(&1IkZ hk~r4l-kroqd[8&cLkb7QY<1kJ({m;Ex6Q,r?Y~X }*5~');

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

