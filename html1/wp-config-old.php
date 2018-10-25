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
define('DB_NAME', 'aytos_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'aytos@123$');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/** FTP Direct Access**/
define('FS_METHOD','direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'M/&ktyEl=y:;bZC$XiGR:3:C$FpP7l!)vB&R{1EbIXq^07JDmeqKhcXA$YnBKe$g');
define('SECURE_AUTH_KEY',  'd1r0*uX.ex=eMC2{`kHN>%Pua`WTIuTyQ*q1,|wmZ1+U3yTd[1m%@.0cu_;e#DLm');
define('LOGGED_IN_KEY',    '@q-uqD.3Nr{f)XRUK)bn(&Mgsp#Xl.bR!Dho$h?C7O[VoEuAy^vlvZ&o>F9vAsoF');
define('NONCE_KEY',        ';#G4)~BuaIA+yhG?gC.j3*@#):~D`(R{K//*)yZU~kdZ&AP%e<26`zd&[{h_639#');
define('AUTH_SALT',        'h6u3`s[[9O0fU?JK3|cn71UN3`SN)f4Vy4p8v&HYEDgA}c{dlonXwr;NV `M77J2');
define('SECURE_AUTH_SALT', 'IPid&HTA=^Wt<s(K%=X;hXPb>klu;nKm.Gs|A06A19xfw?A*gdd4B{~Iy^)Q9&Np');
define('LOGGED_IN_SALT',   ']}TM1eWS<$qeq8c6-dor[;Cqh)G;G++L =s+L~z<bmyPt.M.}<RDHlmm.[> %pkS');
define('NONCE_SALT',       '4hP0L}=nbE~It]/R_`^B;Cf+>v:{sDY~9t3A7:gi3c^T*TXCeCqJtOL#Z2P1I]E7');

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
define('WP_MEMORY_LIMIT','256M');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
