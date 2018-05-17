<?php
/* Define Wordpress Cache Variables */
define('WP_CACHE', true);
/* Assign Database Connections */
define('DB_NAME', 'MKT_base_site_dev' );
define('DB_USER', 'MKT-WP-dev' );
define('DB_PASSWORD', 'ViUz56wZGnR8' );
define('DB_HOST', '172.28.244.67' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');
$table_prefix = 'wp_';
/* Block Core Updates */
define('WP_AUTO_UPDATE_CORE', false );
/* Proxy Information */
define('WP_PROXY_HOST', 'ots-webproxy.outreach.psu.edu');
define('WP_PROXY_PORT', '8080');
define('WP_PROXY_BYPASS_HOSTS','*.psu.edu');
/* Disable Internal WP Cron */
define('DISABLE_WP_CRON', true);
/* Random Key Hashes */
define('AUTH_KEY',         'GUjDY]7RX~i+{hW#%#rhyt-fC(|<|XvBg#83q5_Sz2-G2Ar,N|ZAG*xL$[ Z[>-*');
define('SECURE_AUTH_KEY',  '%rVNndAw:hTpFp~W-Xov~0&x~J-K{u{bYRKFc:t8pOZ(++7+_44kz`<*Uf_J(o;S');
define('LOGGED_IN_KEY',    'S|r:6$eI`)NwF3rqD4|ajk8/y0OYZ;t+0G(o]tA6P<!Y|9VrFr]e#}f{[QbV6||H');
define('NONCE_KEY',        '|ZMs(MFVaf >{--}-@:s6GZxhtOM4O!J`=b_x3ko~y@_y*|&xIhl{kC-*ji&#f&r');
define('AUTH_SALT',        '#-/sz@h=+By=}oQ!sp|fZSxoJ|.Z>@&&|KFh*F{!h@2UehpeJXH B!]U-)pgo+C0');
define('SECURE_AUTH_SALT', '(8h{`tl_x=:{}V!-wK}k%cOB(fmGjrUo-qQ+@+50)?_NjyGD4Udl(= q#Z-84& Z');
define('LOGGED_IN_SALT',   'XLKbkX@>@mb5-,E:`t(q?RAypR5[J<+Bim7$5V>ggD0RYwID%Wn2%{z4=wi`C|}n');
define('NONCE_SALT',       'SE`(2ctxa~f@pWAuN{:|td^=X@3Fc@IlB#u/JhMt-_Q-H$f7 KG9<VS7D]!8zd/<');
/* Define Wordpress Lanaguage */
define('WPLANG', '');
/* Turn Wordpress Debugging on/off */
define('WP_DEBUG', false);
/* Disallow Direct Theme / Plugin Modification */
define('DISALLOW_FILE_EDIT',true);
define('DISALLOW_FILE_MODS',true);
/* Force Admin and Login to use SSL */
define( 'FORCE_SSL_ADMIN', true );
/* Absolute Path to Wordpress Directory -- DO NOT EDIT PAST HERE */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
/* Setup Wordpress Variables and includes files */
require_once(ABSPATH . 'wp-settings.php');
