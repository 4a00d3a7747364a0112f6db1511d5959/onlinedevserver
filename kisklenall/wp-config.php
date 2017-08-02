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
define('DB_NAME', 'unitetoh_kisklenall');

/** MySQL database username */
define('DB_USER', 'unitetoh_kisklen');

/** MySQL database password */
define('DB_PASSWORD', '1__#+ZTG6L7q');

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
define('AUTH_KEY',         'e3!Zx,PNIWYy(mW(`OHYH2KV_C`.N$,WYc^IR#c:|N;kwKZy RSrn0_ }=Cyz,3U');
define('SECURE_AUTH_KEY',  'Flf<U`l<,hD2P[.O4C?]-qZ*V2AwQL(<WQ.Lffju/<PO/E8OaO ZlI%t!/3ORcJ%');
define('LOGGED_IN_KEY',    '`l_7v)/e2;kog63:bt^7|O0VE!`_%Pv^i&d@nJ(ksW:d*M/J-KpnOjP33(`?0G{f');
define('NONCE_KEY',        '*^D=e6>/4z<U2p0b6uW?_56Dg/?wJMS}f`I_5kD{;i{<PD4ieeK&@GObWO?~$0x~');
define('AUTH_SALT',        '_Qc9N{#)Sa@S%J6nexu5(|iPNEK<kS^;GMo}=a%O$A@=O}va3dW g3g[=UK(pQd@');
define('SECURE_AUTH_SALT', 'b8B$ =&ToYQDX_o!v4@R}>^}E-Zo2B$bmZbBM^PUxV?^~to4O$]m>;yH]C<q{B4(');
define('LOGGED_IN_SALT',   '>c $~mO,V.HoOl`).l(GKx0ru<n/F8U(*^a,Q|FZRGh)%x1GIlyo(6QWt,2f.0O$');
define('NONCE_SALT',       'z#HH^_ %x?$NM=88(CvoK>kLcJjQP0r#=H9Z%~7Bs&VUMJLq.dzIl^+pET14%@Z;');

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
