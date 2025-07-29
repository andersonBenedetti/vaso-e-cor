<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">
    <title>
        <?php if (is_front_page() || is_home()) {
            echo get_bloginfo('name');
        } else {
            echo wp_title('');
        } ?>
    </title>
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <script src="<?php echo get_template_directory_uri(); ?>/js/vue.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/swiper-bundle.min.css" />
    <?php wp_head(); ?>
</head>

<body>
    <div id="app">

        <?php
        $menu_items = [
            ['label' => 'Produtos', 'url' => '/loja'],
            ['label' => 'Novidades', 'url' => '#'],
            ['label' => 'Seja Parceiro', 'url' => '#'],
            ['label' => 'Downloads', 'url' => '#'],
            ['label' => 'Fale Conosco', 'url' => '#'],
        ];
        ?>

        <header id="header" role="banner">
            <div class="container">
                <div class="content">
                    <a href="/" class="logo" aria-label="Ir para a página inicial">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.svg"
                            alt="Vaso & Cor - Voltar para página inicial" loading="lazy">
                    </a>

                    <div class="menu-items">
                        <div class="menu-header" :class="{ active: activeMenu }" role="navigation"
                            aria-label="Menu principal">
                            <button class="btn-menu" @click="activeMenu = !activeMenu"
                                :aria-expanded="activeMenu ? 'true' : 'false'" aria-controls="menu"
                                aria-label="Abrir ou fechar menu de navegação">
                                <span></span>
                            </button>
                            <ul class="menu-list" id="menu">
                                <?php
                        foreach ($menu_items as $item) {
                            echo '<li><a href="' . esc_url($item['url']) . '" aria-label="' . esc_html($item['label']) . '">' . esc_html($item['label']) . '</a></li>';
                        }
                        ?>
                            </ul>
                        </div>
                        <div role="search">
                            <?php echo do_shortcode('[fibosearch]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </header>