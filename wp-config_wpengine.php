<?php
# Database Configuration
define( 'DB_NAME', 'wp_devbfplny' );
define( 'DB_USER', 'devbfplny' );
define( 'DB_PASSWORD', 'tCbBLD8rm10F1NAdg6O9' );
define( 'DB_HOST', '127.0.0.1' );
define( 'DB_HOST_SLAVE', '127.0.0.1' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         '&={}C-K|Ve/z`:G+Tk(u3qdLWmRK$,<T^LcQA>dOF,Ad5dhksKK_Y-+BsYOopDzi');
define('SECURE_AUTH_KEY',  'JCAp|(-dZu7S1FwKY_<u@=|a.<<|=0tgzlFO%|-|$HTSi%{2%zycx7h$5+lw:#[L');
define('LOGGED_IN_KEY',    '&l+#_gX|ri~6BwW@h?94^K7q!o*B_:++mnPO O,bZ*(BUeAL5bZv[2-7flC4xk@D');
define('NONCE_KEY',        '*Rfda^UT~_|zs>q|IX$}Y{;+C-_-Y?~pE|Wk[7ss=:Mk<v86|tX):-,:j],9:441');
define('AUTH_SALT',        'NP9cj&,QpS18BoY3G>V}pvpZ$!(51W)XqS*0Gj-|}kTzH`kVeKC}9+KoSE(}OQb-');
define('SECURE_AUTH_SALT', 'OH0ew~sx0DnT^6)PHTV!kTP$gSPQ|?/51i&b6eHmgQQ6-Gf|RO_C`C|L9M$5TU(1');
define('LOGGED_IN_SALT',   'j|2vQ3 lp*sDg#+#k@*7GN0~5UY%|{a^R[/8%~9ut+.REiRDz]3l7s7&a0$y*Ks[');
define('NONCE_SALT',       'n1Xh_o!a<`_&;hG7.{dR[mQ6P5l2xIG3N9};;-T(YIW&--^_bP8KUNmOQrArdC?u');


# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'devbfplny' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'PWP_ROOT_DIR', '/nas/wp' );

define( 'WPE_APIKEY', 'db1a36487659c465d0bd434fa4c9192cae832e8e' );

define( 'WPE_CLUSTER_ID', '120224' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_LBMASTER_IP', '' );

define( 'WPE_CDN_DISABLE_ALLOWED', true );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISALLOW_FILE_EDIT', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'devbfplny.wpengine.com', );

$wpe_varnish_servers=array ( 0 => 'pod-120224', );

$wpe_special_ips=array ( 0 => '104.197.69.251', );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( );
define('WPLANG','');

# WP Engine ID


# WP Engine Settings






# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');

$_wpe_preamble_path = null; if(false){}
