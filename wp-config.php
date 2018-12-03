<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'granvivienda');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', '');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'ZL;hrRbim(ZQc]605/zh?3/FX|U4Ft!T1,s`5X uhg_>GEEt=Xz8$PE7]l.Ly#;S');
define('SECURE_AUTH_KEY', 'f6REa `}fSzzM)m^Fz=[H<p#.MJ0hYri2--GNVNW_tBh{l<N2},iMO^fyiBWz{i=');
define('LOGGED_IN_KEY', '#Rh9fEm<`omvJU$DLJWpgW!M*Pkd`V<-7KP*DLDZaQ3#YmT,]gDi%`UP za[s/kx');
define('NONCE_KEY', 'h&wT6I8j8u6-gM8!A2n[EW:2/PT?YxXy59m%.rJ/AK$^hjE-8/E<6,FU~!gcEJd4');
define('AUTH_SALT', 'On$N@5Bio3Z)[iO^{js~5K@h9-+`bf,5#zX$C4<Ft2E2-uOAKy(j#C1VU9M?JNb{');
define('SECURE_AUTH_SALT', 'G-g6Art`gZmaX^T1|CAPQ_i+D6R&5GdO)mdSJQXRq<)uS8^[C-~ lc4Pcvyxc9z)');
define('LOGGED_IN_SALT', 'ctF>?:7WnZZwAlZvZH}c[)CmwqmA;tO^R-ZFiH4Njl20T$j3Ox` QXo-C*[d.T:q');
define('NONCE_SALT', '1-w|CK ,.>ZReoFA_}&K+}hS7`?e0tG?^fhr@lj@i0kQ> iZ&AehC1ZxZ%A([Z/H');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

