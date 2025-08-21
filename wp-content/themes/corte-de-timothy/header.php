<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
  <meta name="author" content="Sandor Benarik">
  <meta name="theme-color" content="#fffdf7">
  <link rel="profile" href="http://gmpg.org/xfn/11">

  <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/site.webmanifest">

  <?php wp_head(); ?>
</head>


<body <?php body_class(); ?> >
  <header class="header">
    <div class="container header-inner">
      <?php get_template_part('parts/logo'); ?>
      <button class="menu-toggle" aria-label="Abrir menú" aria-expanded="false" aria-controls="primary-menu">
        <span class="paw">
          <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 3040.000000 2992.000000"
            preserveAspectRatio="xMidYMid meet">
            <g transform="translate(0.000000,2992.000000) scale(0.100000,-0.100000)"
              fill="currentColor" stroke="none">
              <path d="M10013 29909 c-301 -39 -675 -219 -1008 -485 -144 -114 -462 -434
          -596 -599 -842 -1032 -1433 -2378 -1643 -3745 -61 -394 -85 -684 -93 -1105
          -13 -722 61 -1383 233 -2065 350 -1394 1024 -2570 1910 -3330 250 -215 486
          -374 744 -504 298 -149 562 -230 885 -272 174 -22 508 -22 660 1 949 142 1725
          669 2330 1585 515 779 843 1773 950 2875 49 510 49 1094 0 1615 -186 1975
          -1166 3980 -2550 5219 -575 515 -1021 756 -1500 811 -102 11 -231 11 -322 -1z" />
              <path d="M19980 29855 c-386 -63 -767 -236 -1148 -521 -599 -449 -1266 -1252
          -1754 -2109 -761 -1338 -1143 -2884 -1088 -4406 70 -1942 744 -3530 1872
          -4412 557 -436 1161 -644 1812 -624 933 27 1771 483 2505 1362 799 957 1332
          2349 1480 3865 36 372 47 966 23 1320 -85 1250 -375 2340 -893 3355 -355 696
          -711 1170 -1183 1574 -373 319 -710 502 -1076 582 -125 27 -424 35 -550 14z" />
              <path d="M2040 21330 c-654 -81 -1127 -442 -1491 -1135 -485 -924 -664 -2404
          -464 -3825 281 -1990 1098 -3615 2337 -4651 599 -501 1318 -912 1963 -1123
          458 -149 926 -215 1330 -187 338 24 575 76 793 172 720 318 1270 912 1625
          1755 348 829 448 1822 291 2904 -205 1416 -855 2844 -1783 3915 -47 54 -162
          178 -256 273 -602 618 -1298 1094 -2098 1436 -514 220 -1063 376 -1571 447
          -162 23 -556 33 -676 19z" />
              <path d="M27607 21120 c-293 -23 -681 -109 -1021 -227 -884 -308 -1791 -887
          -2567 -1641 -746 -724 -1428 -1750 -1836 -2762 -399 -990 -562 -2013 -478
          -3003 119 -1394 751 -2478 1740 -2984 337 -172 657 -272 1060 -329 151 -21
          579 -30 731 -15 600 60 1141 269 1747 673 182 121 459 329 631 474 1042 872
          1870 2110 2416 3612 299 821 422 1852 334 2807 -99 1094 -378 1988 -789 2530
          -322 425 -755 712 -1225 814 -216 46 -527 68 -743 51z" />
              <path d="M14965 16660 c-160 -10 -265 -23 -465 -56 -1209 -200 -2250 -827
          -3135 -1889 -336 -403 -686 -909 -1147 -1660 -765 -1246 -869 -1412 -1178
          -1875 -362 -541 -641 -919 -1114 -1509 -454 -567 -711 -865 -1261 -1461 -635
          -687 -903 -1007 -1154 -1380 -138 -205 -200 -309 -282 -471 -311 -622 -374
          -1308 -203 -2215 202 -1073 691 -2126 1321 -2844 507 -578 1146 -968 1892
          -1155 311 -78 524 -105 884 -112 404 -8 643 15 916 88 341 90 614 226 1175
          584 440 280 654 404 964 559 820 410 1626 650 2452 730 333 33 568 39 816 21
          599 -42 1016 -119 1573 -292 710 -220 1643 -671 2415 -1167 291 -187 389 -244
          549 -321 460 -220 1010 -285 1642 -194 945 136 1895 616 2450 1238 395 442
          718 1001 969 1673 291 781 445 1661 407 2325 -39 676 -216 1195 -590 1723
          -175 248 -459 547 -1046 1104 -790 749 -1181 1169 -1621 1741 -437 569 -697
          976 -1349 2115 -566 989 -853 1448 -1223 1955 -794 1090 -1634 1847 -2547
          2295 -494 243 -995 392 -1480 439 -148 15 -482 21 -630 11z" />
            </g>
          </svg>
        </span>
      </button>
      <nav class="nav" id="primary-menu">
        <?php wp_nav_menu([
          'theme_location' => 'menu-principal',
          'menu_class' => 'nav-menu',
          'container'=>false,
        ]);
      ?>
      </nav>
    </div>
  </header>