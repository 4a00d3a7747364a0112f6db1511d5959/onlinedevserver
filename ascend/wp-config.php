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
define('DB_NAME', 'unitetoh_ascend');

/** MySQL database username */
define('DB_USER', 'unitetoh_ascend');

/** MySQL database password */
define('DB_PASSWORD', 'ascend');

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
define('AUTH_KEY',         ']G4U54:~F6},.NGTilvG/J75%B`5-|uM?JB!GXV%&t$ZX0OIi$X8*M*Bvjtzqi9v');
define('SECURE_AUTH_KEY',  '#tQ}kd8L2?#r3QlhJ]y2QG4GM|cWxB.:H$.~Wziv%oR4_iVG(v7b#ghp!o+z{@~u');
define('LOGGED_IN_KEY',    'I<O:ZvZ8}&${+~<I}$uhv*],LxwcLK_e0w1^#--SsYT@~W=Da,[B7_cLKP-N6h5h');
define('NONCE_KEY',        '0<O6x~w2=6Rw)s7t{ag_rz`@/0:+liua{~Hcfq4Rg(|_*6rg Og)(?wSm!T$Of`2');
define('AUTH_SALT',        'm%N3PxNnlKEBOw~-dj)K9)2*?L;.M1IHo)1#Sc!R.wjhE#;`uO6AgEM-%b}U@ bD');
define('SECURE_AUTH_SALT', '4r3t2?#9D|47zsBG&w;|Xh{QIb6q<Q--Z$>YOP3]V06v:Mf0N-<p5Ag:)S?[6*s}');
define('LOGGED_IN_SALT',   'o?|CLs?:4HT6p *^ nL7t?XZ(:}y/(=.R/`$X}F{!(h,WZu)IJE]9fUlx4DE+E`,');
define('NONCE_SALT',       'R8!G^=EwaMfl*LCK]l&58w{p<NTE,9SzC*U ?h~Sh5K9!@tMhPEpa{_fS#61k<e*');
define('FS_METHOD', 'direct');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'ascendwp_';

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

