<?php
// Template Name: Home
?>

<?php get_header(); ?>

<?php
$menu_fav = [
    ['label' => 'Bolonha', 'url' => '#', 'img' => 'bolonha.webp'],
    ['label' => 'Pote', 'url' => '#', 'img' => 'pote.webp'],
    ['label' => 'Nácar', 'url' => '#', 'img' => 'nacar.webp'],
    ['label' => 'Bolonha', 'url' => '#', 'img' => 'bolonha.webp'],
    ['label' => 'Pote', 'url' => '#', 'img' => 'pote.webp'],
    ['label' => 'Nácar', 'url' => '#', 'img' => 'nacar.webp'],
];

$formats = [
    ['label' => 'Curvilíneo', 'url' => '#', 'img' => 'curvilineo.webp'],
    ['label' => 'Redondo', 'url' => '#', 'img' => 'redondo.webp'],
    ['label' => 'Curvilíneo', 'url' => '#', 'img' => 'curvilineo.webp'],
    ['label' => 'Redondo', 'url' => '#', 'img' => 'redondo.webp'],
    ['label' => 'Curvilíneo', 'url' => '#', 'img' => 'curvilineo.webp'],
    ['label' => 'Redondo', 'url' => '#', 'img' => 'redondo.webp'],
];
?>

<main id="pg-home" role="main">
    <section class="main-carousel swiper" aria-label="Carrossel de destaque">
        <div class="swiper-wrapper">
            <?php
            $args = array(
                'post_type' => 'carrossel',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'order' => 'DESC',
            );
            $the_query = new WP_Query($args);

            if ($the_query->have_posts()):
                while ($the_query->have_posts()):
                    $the_query->the_post();

                    $link = get_field('link_da_imagem');
                    $img_desktop = get_field('imagem_-_desktop');
                    $img_mobile = get_field('imagem_-_mobile');
                    $title = get_the_title();

                    $alt_text = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
                    if (!$alt_text) {
                        $alt_text = $title;
                    }
                    ?>
                    <a class="swiper-slide" href="<?php echo esc_url($link); ?>" aria-label="<?php echo esc_attr($title); ?>">
                        <img class="dkp" src="<?php echo esc_url($img_desktop); ?>" alt="<?php echo esc_attr($alt_text); ?>"
                            loading="lazy" width="1200" height="auto">
                        <img class="mbl" src="<?php echo esc_url($img_mobile); ?>" alt="<?php echo esc_attr($alt_text); ?>"
                            loading="lazy" width="600" height="auto">
                    </a>
                <?php endwhile;
                wp_reset_postdata();
            else: ?>
                <p><?php _e('Desculpe, nenhum slide encontrado.', 'textdomain'); ?></p>
            <?php endif; ?>
        </div>

        <div class="swiper-pagination" aria-hidden="true"></div>
    </section>

    <section class="cat-carousel swiper" role="region" aria-label="Galeria de categorias de produtos favoritos">
        <div class="container">
            <h2 class="title-section">
                Favoritos
            </h2>
        </div>

        <div class="swiper-wrapper">
            <?php foreach ($menu_fav as $item):
                $img_url = get_stylesheet_directory_uri() . '/img/' . $item['img'];
                $label = esc_html($item['label']);
                ?>

                <a class="swiper-slide" href="<?php echo esc_url($item['url']); ?>"
                    aria-label="Ver produto <?php echo esc_attr($label); ?>">
                    <h3><?php echo esc_html($label); ?></h3>
                    <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($label); ?>" loading="lazy"
                        width="400" height="auto">
                    <p class="btn-cat">
                        <span>Ver mais</span>
                        <svg width="4" height="8" viewBox="0 0 4 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M3.65855 4.35581L0.830047 7.18431L0.123047 6.47731L2.59805 4.00231L0.123047 1.52731L0.830047 0.820312L3.65855 3.64881C3.75228 3.74258 3.80494 3.86973 3.80494 4.00231C3.80494 4.13489 3.75228 4.26205 3.65855 4.35581Z"
                                fill="black" />
                        </svg>
                    </p>
                </a>

            <?php endforeach; ?>
        </div>

        <div class="swiper-pagination black" aria-hidden="true"></div>
    </section>

    <section class="section-about">
        <div class="container">
            <h2 class="title-section">
                <span>Sobre</span>
                <span>a</span>
                <span>experiência</span>
                <span>V&C</span>
            </h2>

            <div class="about-main">
                <p>Pioneira na fabricação de vasos em fibra de vidro de alto padrão, a Vaso & Cor é uma indústria
                    nacional com peças produzidas artesanalmente. Com design exclusivo, os produtos em fibra de vidro
                    oferecem leveza e sofisticação para diversos ambientes.
                    <strong>A Vaso & Cor conta com uma ampla linha que atende:</strong>
                </p>

                <ul>
                    <li>Casas e apartamentos</li>
                    <li>Projetos</li>
                    <li>Empreendimentos</li>
                    <li>Lojas e escritórios</li>
                </ul>
            </div>

            <p>Realizamos entregas para todo o Brasil. Com mais de 90 modelos, quatro acabamentos e uma equipe
                especializada, a Vaso & Cor proporciona uma experiência de compra completa, personalizada e exclusiva,
                alinhada aos seus objetivos.</p>
        </div>
    </section>

    <section class="format-carousel swiper">
        <div class="swiper-wrapper">
            <?php foreach ($formats as $index => $format): ?>
                <div class="swiper-slide">
                    <?php if ($index === 0): ?>
                        <div class="main-carousel swiper">
                            <div class="format-infos">
                                <h3>Todos os formatos</h3>
                                <div class="swiper-pagination"></div>
                            </div>
                            <div class="swiper-wrapper"> <?php foreach ($formats as $f): ?>
                                    <div class="swiper-slide">
                                        <a href="<?php echo esc_url($f['url']); ?>">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/' . esc_attr($f['img']); ?>"
                                                alt="Formato <?php echo esc_attr($f['label']); ?>">
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    <?php else: ?>
                        <a class="swiper-slide" href="<?php echo esc_url($format['url']); ?>">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/' . esc_attr($format['img']); ?>"
                                alt="Formato <?php echo esc_attr($format['label']); ?>">
                            <div class="format-infos">
                                <h3><?php echo esc_html($format['label']); ?></h3>
                                <span class="btn">Ver mais</span>
                            </div>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="all-main-carousel">
            <div class="swiper-wrapper">
                <?php foreach ($formats as $format): ?>
                    <div class="swiper-slide">
                        <a href="<?php echo esc_url($format['url']); ?>">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/' . esc_attr($format['img']); ?>"
                                alt="Formato <?php echo esc_attr($format['label']); ?>">
                            <div class="format-infos">
                                <h3><?php echo esc_html($format['label']); ?></h3>
                                <span class="btn">Ver mais</span>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>