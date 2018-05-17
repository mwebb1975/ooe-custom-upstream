<?php
/* Define Wordpress Cache Variables */
define('WP_CACHE', true);
/* Assign Database Connections */
define('DB_NAME', 'MKT_base_site_stage' );
define('DB_USER', 'MKT-WP-stage' );
define('DB_PASSWORD', 'CFuHKzz78yU9' );
define('DB_HOST', '172.28.244.51' );
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
define('AUTH_KEY',         'H[kklQ=  k*X!r&g[)(U&ikz{/ZC k#4ZFVZ%`ePdRkMcqAy}F0oy8FtR+Ua3xC:');
define('SECURE_AUTH_KEY',  '-}7.f*ZWOc8zHv.O@G_|mB%*&PNsz>tn7O9?h/~>^;/8~2zw]3v~ooCHdfU>{+lt');
define('LOGGED_IN_KEY',    '{*iiIX*__F.3-5p/$Hk,zOA;-p}<._IjS.=ZvZjIgi>khy/lBbzO6o~#fWYts40_');
define('NONCE_KEY',        'lHIheB+R]8S#PB+(qjRL.GiJitG|CLJhy2Md:]~<E0--|c]RKE2$xxL?q<aFOaG0');
define('AUTH_SALT',        '_ooj:|(/IS9Uv{,|V}W=Nb^p??<LOzC^|JHHO`s|||ckcmOu0,t(DKa)]=N4EHW[');
define('SECURE_AUTH_SALT', '(k:UQwLEc85pAv299[]T7D{nHQn0# d^$:ldik1FfywYCt(*pw6B9,{q4B(P=Xwg');
define('LOGGED_IN_SALT',   '#%hCT9J+<mLnP2(>@s@YWR_4PX]#{?P}@U+HAG?DaFWf/8+3!yP0(8-Xv74lH!50');
define('NONCE_SALT',       '{CJ -9/1TVP*x[+`{tH7|*Y2btnTn2>K}{Hr1[kaP-~+A]%4rdZqw5--,zIYq#$W');
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
