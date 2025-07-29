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
                <p>Pioneiros na fabricação de vasos em fibra de vidro de alto padrão, a Vaso e Cor é uma indústria com
                    peças feitas por mãos brasileiras. Com design exclusivo, o produto em fibra de vidro agrega leveza e
                    estética aos ambientes.
                    <strong>A Vaso e Cor tem uma ampla gama de produtos que atende:</strong>
                </p>

                <ul>
                    <li>Casas e apartamentos</li>
                    <li>Projetos</li>
                    <li>Empreendimentos</li>
                    <li>Lojas e escritórios</li>
                </ul>
            </div>

            <p>Entregamos para todo o território nacional. Com mais de 90 produtos, 4 acabamentos e um time de
                especialistas prontos para te atender de acordo com seus objetivos, na Vaso e Cor você vive uma
                experiência de compra completa e exclusiva.</p>
        </div>
    </section>

</main>

<?php get_footer(); ?>