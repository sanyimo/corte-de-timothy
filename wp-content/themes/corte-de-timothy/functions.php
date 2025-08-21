<?php
ob_start();

add_action('template_redirect', function () {
  if (!is_user_logged_in()) return;

  $user = wp_get_current_user();

  if (in_array('administrator', $user->roles)) return;

  $is_verified = get_user_meta($user->ID, 'email_verified', true);
  if (!$is_verified) {
    wp_logout();
    wp_redirect(home_url('/'));
    exit;
  }

  $paginas_publicas = [
    'inicio',
    'retratos',
    'servicios',
    'contacto',
    'cronicas-del-reino',
    'quienes-somos',
    'registro',
    'login',
    'politica-privacidad',
    'politica-cookies',
    'aviso-legal',
    'resetear-clave',
    'logout',
    'perfil-usuario',
    'olvide-mi-contrasena',
    'cronica-banos-aromaticos',
    'cronica-corte-imperial',
    'cronica-galletas-de-la-reina',
    'cronica-accesorios-para-la-realeza',
  ];

  if (is_page() && !is_page($paginas_publicas)) {
    wp_redirect(home_url('/'));
    exit;
  }
});

function timothy_theme_setup()
{
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  register_nav_menus([
    'menu-principal' => 'Menú Principal',
    'footer_menu' => 'Footer Menu'
  ]);
}
add_action('after_setup_theme', 'timothy_theme_setup');

function timothy_assets()
{
  wp_enqueue_style(
    'timothy-style',
    get_template_directory_uri() . '/assets/scss/main.css',
    [],
    filemtime(get_template_directory() . '/assets/scss/main.css')
  );
}
add_action('wp_enqueue_scripts', 'timothy_assets');

function timothy_preload_styles($hints, $relation_type)
{
  if ('preload' === $relation_type) {
    $hints[] = get_template_directory_uri() . '/assets/scss/main.css';
  }
  return $hints;
}
add_filter('wp_resource_hints', 'timothy_preload_styles', 10, 2);

// Enqueue la fuente de Google Fonts
function corte_timothy_fonts_completo()
{
  // Preconnect (siempre útil)
  add_action('wp_head', function () {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
  });

  // Cargar la fuente de forma no bloqueante
  add_action('wp_head', function () {
    echo "<link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;700&family=Lato:wght@400;700&display=swap' media='print' onload=\"this.media='all'\">";
    echo '<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;700&family=Lato:wght@400;700&display=swap"></noscript>';
  }, 1); // prioridad baja para que esté al principio
}
add_action('wp_enqueue_scripts', 'corte_timothy_fonts_completo');

add_action('after_setup_theme', function () {
  if (!current_user_can('administrator') && !is_admin()) {
    show_admin_bar(false);
  }
});

function theme_enqueue_scripts()
{
  // Script principal (menu, etc.)
  wp_enqueue_script(
    'menu-toggle',
    get_template_directory_uri() . '/assets/js/main.js',
    [],
    filemtime(get_template_directory() . '/assets/js/main.js'),
    true
  );

  wp_enqueue_script(
    'menu-principal',
    get_template_directory_uri() . '/assets/js/menu-usuario.js',
    [],
    filemtime(get_template_directory() . '/assets/js/menu-usuario.js'),
    true
  );

  // Solo en páginas donde necesita Swiper
  if (is_page('retratos')) {
    // Swiper CSS y JS desde CDN
    wp_enqueue_style(
      'swiper-css',
      'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css',
      [],
      null
    );

    wp_enqueue_script(
      'swiper-js',
      'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js',
      [],
      null,
      true
    );

    // Script de inicialización de sliders
    wp_enqueue_script(
      'swiper-init',
      get_template_directory_uri() . '/assets/js/slider.js',
      ['swiper-js'],
      filemtime(get_template_directory() . '/assets/js/slider.js'),
      true
    );
  }

  wp_enqueue_script(
      'timothy-animaciones',
      get_template_directory_uri() . '/assets/js/animaciones.js',
      [],
      filemtime(get_template_directory() . '/assets/js/animaciones.js'),
      true
  );
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');


function the_acf_image($image, $alt_fallback = '', $class = '', $sizes = '(max-width: 768px) 100vw, 50vw')
{
  if (!$image) return;

  $url = $alt = $mime = $width = $height = $srcset = '';

  // ACF como array
  if (is_array($image) && isset($image['url'])) {
    $url    = esc_url($image['url']);
    $alt    = esc_attr($image['alt'] ?: $alt_fallback);
    $mime   = $image['mime_type'] ?? '';
    $width  = esc_attr($image['width'] ?? '');
    $height = esc_attr($image['height'] ?? '');
    $srcset = wp_get_attachment_image_srcset($image['ID'], 'full') ?: '';
  }

  // ACF como ID
  elseif (is_numeric($image)) {
    $url_info = wp_get_attachment_image_src($image, 'full');
    if ($url_info) {
      $url    = esc_url($url_info[0]);
      $width  = esc_attr($url_info[1]);
      $height = esc_attr($url_info[2]);
    }
    $alt    = esc_attr(get_post_meta($image, '_wp_attachment_image_alt', true) ?: $alt_fallback);
    $mime   = get_post_mime_type($image);
    $srcset = wp_get_attachment_image_srcset($image, 'full') ?: '';
  }

  // ACF como URL
  elseif (is_string($image)) {
    $url = esc_url($image);
    $alt = esc_attr($alt_fallback);
    $mime = pathinfo($url, PATHINFO_EXTENSION); // crude fallback
    $mime = ($mime === 'svg') ? 'image/svg+xml' : 'image/' . $mime;
  }

  $is_svg  = str_contains($mime, 'svg');

  // Construye <img>
  $img_tag = '<img src="' . $url . '"'
    . ($width ? ' width="' . $width . '"' : '')
    . ($height ? ' height="' . $height . '"' : '')
    . ' alt="' . $alt . '" loading="lazy" decoding="async"'
    . ($srcset ? ' srcset="' . esc_attr($srcset) . '"' : '')
    . ($sizes ? ' sizes="' . esc_attr($sizes) . '"' : '')
    . ($class ? ' class="' . esc_attr($class) . '"' : '')
    . '>';

  // SVG → no usar <picture>
  if ($is_svg) {
    echo $img_tag;
    return;
  }

  // Comprobamos si existe la versión .webp en el servidor
  $webp_url = preg_replace('/\.(jpe?g|png)$/i', '.webp', $url);
  $upload_dir = wp_upload_dir();
  $webp_path = str_replace($upload_dir['baseurl'], $upload_dir['basedir'], $webp_url);
  $has_webp = file_exists($webp_path);

  // Si hay versión .webp → usamos <picture>, si no → solo <img>
  if ($has_webp) {
    echo '<picture>';
    echo '<source srcset="' . esc_url($webp_url) . '" type="image/webp">';
    echo $img_tag;
    echo '</picture>';
  } else {
    echo $img_tag;
  }
}

function timothy_preload_head()
{
  // Imagen común: logotipo
  // echo '<link rel="preload" as="image" href="' . get_template_directory_uri() . '/assets/img/logo.svg" fetchpriority="high">' . "\n";

  if (is_front_page()) {
    echo '<link rel="preload" as="image" href="' . get_template_directory_uri() . '/assets/img/Timothy-480.webp" fetchpriority="high">';
  }

  if (is_page('contacto')) {
    echo '<link rel="preload" as="image" href="' . get_template_directory_uri() . '/assets/img/jardin-3500.webp">' . "\n";
  }

  if (is_page('servicios')) {
    echo '<link rel="preload" as="image" href="' . get_template_directory_uri() . '/assets/img/jardin-griego2500.webp">' . "\n";
  }

  if (is_page('quienes-somos')) {
    echo '<link rel="preload" as="image" href="' . get_template_directory_uri() . '/assets/img/interior.webp">' . "\n";
  }
  if (is_page('retratos')) {
    echo '<link rel="preload" as="image" href="' . get_template_directory_uri() . '/assets/img/workshop3500.webp">' . "\n";
  }
  if (is_page('cronicas-delreino')) {
    echo '<link rel="preload" as="image" href="' . get_template_directory_uri() . '/assets/img/.webp">' . "\n";
  }

  // 📜 Crónicas del Reino (Blog)
  // if (is_home()) {
  //   echo '<link rel="preload" as="image" href="' . get_template_directory_uri() . '/assets/img/sello-cronicas.webp">' . "\n";
  // }
}
add_action('wp_head', 'timothy_preload_head');

function agregar_clases_body_personalizadas($classes)
{
  if (is_front_page()) {
    $classes[] = 'bg-home';
  } elseif (is_page('servicios')) {
    $classes[] = 'bg-servicios';
  } elseif (is_page('contacto')) {
    $classes[] = 'bg-contacto';
  } elseif (is_page('quienes-somos')) {
    $classes[] = 'bg-linaje';
  } elseif (is_page('retratos')) {
    $classes[] = 'bg-retratos';
  } elseif (is_page('cronicas-del-reino')) {
    $classes[] = 'bg-cronicas';
  } elseif (is_page('login')) {
    $classes[] = 'login';
  } elseif (is_page('registro')) {
    $classes[] = 'registro';
  } elseif (is_page('verificar-email')) {
    $classes[] = 'verificar-email';
  } elseif (is_page('perfil-usuario')) {
    $classes[] = 'perfil-usuario';
  } elseif (is_404()) {
    $classes[] = 'bg-404';
  }
  return $classes;
}
add_filter('body_class', 'agregar_clases_body_personalizadas');

function redirect_logged_in_users()
{
  if (is_user_logged_in() && (is_page('login') || is_page('registro'))) {
    wp_redirect(home_url('/'));
    exit;
  }
}
add_action('template_redirect', 'redirect_logged_in_users');

function shortcode_password_reset_form()
{
  ob_start();
  include get_template_directory() . '/parts/olvide.php';
  return ob_get_clean();
}
add_shortcode('password_reset_form', 'shortcode_password_reset_form');

function personalizar_menu_usuario($items, $args)
{
  if ($args->theme_location !== 'menu-principal') return $items;

  $usuario_logueado = is_user_logged_in();
  $user = wp_get_current_user();
  $user_name =  $user->user_login;
  $avatar_url = get_avatar_url($user->ID, ['size' => 32]);

  foreach ($items as $key => &$item) {
    $title = strtolower(trim(strip_tags($item->title)));
    $url = untrailingslashit($item->url);

    // Si el usuario está logueado...
    if ($usuario_logueado) {
      // Eliminar login y registro
      if (str_contains($url, '/login') || str_contains($url, '/registro')) {
        unset($items[$key]);
        continue;
      }

      // Detectar ítem cuyo título sea "usuario" (desde admin)
      if ($title === 'usuario') {
        $item->title = sprintf(
          '<span class="user-menu-trigger"><img src="%s" alt="%s" class="menu-avatar" /><span class="username">%s</span><span class="dropdown-icon">▼</span></span>',
          esc_url($avatar_url),
          esc_attr($user_name),
          esc_html($user_name)
        );
        $item->url = '/perfil-usuario';
        $item->classes[] = 'menu-item-has-children';
        $item->classes[] = 'user-menu-item';
      }

      // Reemplazar URL de logout
      if ($title === 'cerrar sesión') {
        $item->url = wp_logout_url(home_url());
      }
    } else {
      $ocultar_si_no_logueado = ['usuario', 'cerrar sesión', 'mi perfil', 'ajustes', 'citas', 'perfil mascota'];
      if (in_array($title, $ocultar_si_no_logueado)) {
        unset($items[$key]);
      }
    }
  }
  return array_values($items);
}
add_filter('wp_nav_menu_objects', 'personalizar_menu_usuario', 10, 2);

// Permitir HTML en el ítem de usuario
add_filter('nav_menu_item_title', function ($title, $item, $args, $depth) {
  if (in_array('user-menu-item', $item->classes ?? [])) {
    return $title;
  }
  return esc_html($title);
}, 10, 4);


function get_custom_page_url_by_slug($slug)
{
  $page = get_page_by_path($slug);
  if ($page) {
    return get_permalink($page->ID);
  }
  return home_url("/$slug");
}
add_filter('login_url', function ($url) {
  return get_custom_page_url_by_slug('login');
});

add_filter('register_url', function ($url) {
  return get_custom_page_url_by_slug('registro');
});


add_action('admin_post_enviar_carta_timothy', 'procesar_carta_timothy');
add_action('admin_post_nopriv_enviar_carta_timothy', 'procesar_carta_timothy');

function procesar_carta_timothy()  {
  if (!isset($_POST['seguridad_carta_timothy']) || !wp_verify_nonce($_POST['seguridad_carta_timothy'], 'enviar_carta_timothy_nonce')) {
    wp_die('Error de seguridad. ¿Eres un agente encubierto de otro reino?');
  }

  $nombre = sanitize_text_field($_POST['nombre'] ?? '');
  $email = sanitize_email($_POST['email'] ?? '');
  $mensaje = sanitize_textarea_field($_POST['mensaje'] ?? '');

  wp_mail(
    'betimothy8@gmail.com',
    'Carta desde la Tierra de los Humanos',
    "Remitente: $nombre\nCorreo: $email\n\nMensaje:\n$mensaje",
    ['Content-Type: text/plain; charset=UTF-8']
  );

  wp_redirect(add_query_arg('enviado', '1', home_url('/contacto/')));
  exit;
}


add_filter('authenticate', function ($user, $username, $password) {
  if (is_a($user, 'WP_User')) {
    // Permitir acceso sin verificar a administradores
    if (in_array('administrator', (array) $user->roles)) {
      return $user;
    }

    $restricted_roles = ['subscriber', 'customer'];

    if (array_intersect($restricted_roles, (array) $user->roles)) {
      $is_verified = get_user_meta($user->ID, 'email_verified', true);
      if (!$is_verified) {
        return new WP_Error('email_not_verified', __('<strong>ERROR:</strong> Debes verificar tu correo antes de iniciar sesión.'));
      }
    }
  }
  return $user;
}, 30, 3);

add_filter('retrieve_password_message', function ($message, $key, $user_login, $user_data) {
  $reset_url = home_url("/resetear-clave/?key=$key&login=" . rawurlencode($user_login));

  // Cambiar el enlace por defecto al nuestro
  $message = "Hola,\n\nHas solicitado restablecer tu contraseña. Para crear una nueva, visita el siguiente enlace:\n\n";
  $message .= $reset_url . "\n\n";
  $message .= "Si no solicitaste este cambio, ignora este correo.\n";

  return $message;
}, 10, 4);

add_action('wp_ajax_actualizar_mi_perfil', 'actualizar_mi_perfil');

function redirect_after_password_reset($user, $new_password)
{
  // Redirige a la página login personalizada con un parámetro de aviso
  wp_redirect(site_url('/login?password_changed=1'));
  exit;
}
add_action('password_reset', 'redirect_after_password_reset', 10, 2);


//si no existe la tabla, la introduce en la base de datos
$meta_keys = ['pet_name', 'pet_breed', 'pet_sex', 'pet_age', 'phone'];
foreach ($meta_keys as $key) {
  if (!metadata_exists('user', $current_user->ID, $key)) {
    add_user_meta($current_user->ID, $key, '');
  }
}
