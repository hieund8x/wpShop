<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wp_shop');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'i{G9M*csH*wC>@jY#KMSE,b+%6gDX8]8M_uFWs]s3i{>(boOXieVXo>kdo3H65fg');
define('SECURE_AUTH_KEY',  'GcX@UAaS]Q ``XO&MBSQ Is@/-i%z7_`_]`_|%Qq!sX[^Qm .=Y`&C)~Zz7tRib1');
define('LOGGED_IN_KEY',    'Ai:TO/Y)Vz!^kY9;D21kDe]HhA?t~g$u] ,1kJv-n/UjF-ve@c!1?*|Il?Zg53_e');
define('NONCE_KEY',        'GPBzF0fE,w*^|t-Q-lLOj%zL:1y)+$0~SBbb$nv`$ORc^.k-Sx+l#L| L%TvQ8!k');
define('AUTH_SALT',        'ygNe/&q=?4 OQ$>I|Q[gbVy4$ Vh8dzi:%sm|mO4&f-a<tP4xOyQVAQ4wCqv2vEK');
define('SECURE_AUTH_SALT', '/V%Av3gE=eihw|bCj%T|=dN2_><%uBw$cr}>9A4Q72[`v)(HUFL-&]{y!<-w7df~');
define('LOGGED_IN_SALT',   '|nH-I`wzaN@P.@Klx_UUZ4j8~Tt4BO1C{i&ymyT#K{W9DYqE-}1*~aLgrDV4_rI9');
define('NONCE_SALT',       '@aA>|5!X9+5UX0W^hTUsDz-l&BQ,X+W]vZl[(:VE|wSN]>OIy5&e#)Q(CHgyx3ZN');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpshop_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
