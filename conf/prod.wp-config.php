<?php
/* Define Wordpress Cache Variables */
define('WP_CACHE', true);
/* Assign Database Connections */
define('DB_NAME', 'MKT_base_site_prod' );
define('DB_USER', 'MKT-WP-prod' );
define('DB_PASSWORD', '7kS3LSKDP4Un' );
define('DB_HOST', '172.28.244.47' );
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
define('AUTH_KEY',         '+2.W+jr>x^I2~.d#End{1c-!`bPXtPC{o9-CShQ8sM9f4XQ(UK#xdW3Jz73GH$b6');
define('SECURE_AUTH_KEY',  'N*r4r<9:5r[!`s=-JR2$J?7}2QLe7)gjL0(*4`-v`5x,t}+|1t~-t |Bi#Yr@`=d');
define('LOGGED_IN_KEY',    '.b4:s5~XZzK^1mbpWs3}o~Pm+-tM^da(NqL8AJ)*KpSy%+a1z%fw)*Pbk<+M~A6g');
define('NONCE_KEY',        '*J*fZU^Vy!b!%{*OEBs+_5&]+-&qEDmux4n3y];vcPtBP67E<+|P*M%@]}|H,Zf+');
define('AUTH_SALT',        'Zc2gV|&{`K3Lz2&HmKGcmlL^zQgAqe@T&ib]nA+|=u1lkpujv{-c+2;(<z{pJ!GX');
define('SECURE_AUTH_SALT', '~JI{H|TA8mB(+ar>]sA]`E_ja2y=rVwAlZj9Iq(!Ct *-??V.Azm!oN:2I-resu[');
define('LOGGED_IN_SALT',   'uD&ZFK)S TYNKj1Z6|^D^&l^!RII@pF%M@J!,c|P?A+u]LKlyfCsp8$*OlDlyP+K');
define('NONCE_SALT',       'mS1Uh`-iGx||lrK&WtRMvR%PU8tD~,y2`[,.m0mo?R@t%6NufghqIqrqOB::~m`^');
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
