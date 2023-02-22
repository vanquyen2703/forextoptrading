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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'zvn_38ccee' );

/** MySQL database username */
define( 'DB_USER', 'live_38ccee' );

/** MySQL database password */
define( 'DB_PASSWORD', 'd6s2LsBs6!aI' );

/** MySQL hostname */
define( 'DB_HOST', '172.29.180.17' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '$Q_Nda5p+ex/(/1f`-0zuzB/U2& xte{-`cTAN[,pV}v7aR5Z~(@l/*-&<%&2Eox');
define('SECURE_AUTH_KEY',  ')%d !N.L,WH$G|Wz[U#hGt%dqz90Jn6%JL#2S0W!;j) 4ksJD7t$?sDcse-}v*FD');
define('LOGGED_IN_KEY',    'IJYXPJ<F|y.z[|i*q+5@A|bf^rw@zKg:N|u-ucR|&fdScC?|<_?87)OXIROmvv](');
define('NONCE_KEY',        'WqbYr[5`[_9*|VdA)S&c{)7R4^T@[hv1$vgUn#a{7p*_F(%%x|M&TElZYAvgh4#J');
define('AUTH_SALT',        'HfA-.qz{vP+-;RL8QgGGg2au(#HuDZG$vp<EB-k&.QxzKMhdB8Kp91_[4fUw-D:9');
define('SECURE_AUTH_SALT', 'V3F]LIW)p4|{v=.VpB2xWu:WJ_YYe&8GHW$])A+K#8pjB8@?f9.uW}^6Me?J7B8 ');
define('LOGGED_IN_SALT',   '+>fyp=p4Q1Pm%M~F^NFg`0EwTuzy>arMh/S;[o[)PJh~.9]-3;wbWHRVJOoyb*}$');
define('NONCE_SALT',       'M Zc`DXh_Kbi@[+(&0)HfkoK7p5c[7X^`)_/cGsz5b|aD%T]Mi9|?|9:emiOVXEo');


/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


define('FS_METHOD', 'direct');
define('FS_CHMOD_DIR', 0775);
define('FS_CHMOD_FILE', 0664);
define('WP_AUTO_UPDATE_CORE', false);

define('WP_CACHE', true);

/** WordPress Custom Config. **/
define('ZWP_BRAND_KEY', 'zvn');
define('WP_DEBUG', False);
define('ZWP_REGION_NAME', 'tyo1');



/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
