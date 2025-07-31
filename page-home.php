<?php
// Template Name: Home
?>

<?php get_header(); ?>

<?php
$parent_cat = get_term_by('slug', 'formatos', 'product_cat');

$formats = [];

if ($parent_cat) {
    $child_ids = get_term_children($parent_cat->term_id, 'product_cat');

    if (!empty($child_ids)) {
        $categories = get_terms([
            'taxonomy' => 'product_cat',
            'include' => $child_ids,
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false,
        ]);

        foreach ($categories as $cat) {
            $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
            $image_url = wp_get_attachment_url($thumbnail_id);

            $formats[] = [
                'label' => $cat->name,
                'url' => get_term_link($cat),
                'img' => $image_url ?: 'placeholder.jpg',
            ];
        }
    }
}
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

    <section class="cat-carousel swiper" role="region" aria-label="Galeria de produtos favoritos">
        <div class="container">
            <h2 class="title-section">
                Favoritos
            </h2>
        </div>

        <div class="swiper-wrapper">
            <?php
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_visibility',
                        'field' => 'name',
                        'terms' => 'featured',
                        'operator' => 'IN',
                    ),
                ),
            );

            $featured_query = new WP_Query($args);

            if ($featured_query->have_posts()):
                while ($featured_query->have_posts()):
                    $featured_query->the_post();
                    global $product;
                    $product_id = $product->get_id();
                    $label = get_the_title();
                    $permalink = get_permalink();
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
                    ?>
                    <a class="swiper-slide" href="<?php echo esc_url($permalink); ?>"
                        aria-label="Ver produto <?php echo esc_attr($label); ?>">
                        <h3><?php echo esc_html($label); ?></h3>
                        <?php if ($image): ?>
                            <img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_attr($label); ?>" loading="lazy"
                                width="400" height="auto">
                        <?php endif; ?>
                        <p class="btn-cat">
                            <span>Ver mais</span>
                            <svg width="4" height="8" viewBox="0 0 4 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.65855 4.35581L0.830047 7.18431L0.123047 6.47731L2.59805 4.00231L0.123047 1.52731L0.830047 0.820312L3.65855 3.64881C3.75228 3.74258 3.80494 3.86973 3.80494 4.00231C3.80494 4.13489 3.75228 4.26205 3.65855 4.35581Z"
                                    fill="black" />
                            </svg>
                        </p>
                    </a>
                    <?php
                endwhile;
                wp_reset_postdata();
            else:
                echo '<p>Não há produtos em destaque no momento.</p>';
            endif;
            ?>
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
            <div class="swiper-slide">
                <div class="main-carousel swiper">
                    <div class="format-infos">
                        <h3>Todos os formatos</h3>
                        <div class="swiper-pagination"></div>
                    </div>
                    <div class="swiper-wrapper">
                        <?php foreach ($formats as $f): ?>
                            <div class="swiper-slide">
                                <a href="<?php echo esc_url($f['url']); ?>">
                                    <img src="<?php echo esc_url($f['img']); ?>" alt="<?php echo esc_attr($f['label']); ?>">
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <?php foreach ($formats as $format): ?>
                <div class="swiper-slide">
                    <a href="<?php echo esc_url($format['url']); ?>">
                        <img src="<?php echo esc_url($format['img']); ?>" alt="<?php echo esc_attr($format['label']); ?>">
                        <div class="format-infos">
                            <h3><?php echo esc_html($format['label']); ?></h3>
                            <span class="btn">Ver mais</span>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="all-main-carousel">
            <div class="swiper-wrapper">
                <?php foreach ($formats as $format): ?>
                    <div class="swiper-slide">
                        <a href="<?php echo esc_url($format['url']); ?>">
                            <img src="<?php echo esc_url($format['img']); ?>"
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

    <section class="section-icon">
        <svg width="81" height="56" viewBox="0 0 81 56" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M41.5541 3.34334C39.6123 2.28653 37.0048 1.11851 35.7842 0.729159C34.5637 0.339806 31.2904 0.00602168 28.5719 0.00602168C25.5205 -0.0496001 22.4137 0.284134 20.5274 0.840351C18.863 1.34095 15.9781 2.50903 14.2027 3.4546C12.3719 4.45579 9.54246 6.7363 7.71163 8.68306C5.82533 10.6854 3.71712 13.689 2.82945 15.6358C1.94178 17.5825 0.943153 20.4749 0.610275 22.0323C0.277397 23.6453 0 26.4264 0 28.1507C0 29.9306 0.388359 32.8785 0.887672 34.714C1.38699 36.5495 2.55206 39.5531 3.49521 41.333C4.49384 43.1685 6.60205 45.9496 8.15547 47.6183C9.76438 49.2313 12.15 51.178 13.426 51.9567C14.7575 52.6798 17.3096 53.8479 19.1404 54.4597C20.9712 55.0716 24.189 55.739 26.3527 55.9059C29.0158 56.1284 31.4568 55.9615 33.9534 55.3497C36.0616 54.8491 39.1685 53.7366 40.8884 52.8467C42.6637 51.9567 45.3267 50.1769 46.8247 48.8419C48.3226 47.507 50.5418 44.8372 54.0925 39.3863L54.2034 46.6171C54.3144 50.6219 54.4808 53.9035 54.6473 53.9035C54.8137 53.9035 56.2562 53.2361 57.8096 52.4574C59.4185 51.623 62.2479 49.4538 64.1342 47.5626C66.2979 45.3934 68.0733 42.8904 69.1829 40.5543C70.126 38.5519 71.1247 36.3271 71.4575 35.5484C71.9014 34.4915 72.0678 35.7708 72.1788 48.6195L74.1205 46.3946C75.1747 45.1709 76.8945 42.4454 77.9486 40.2762C79.0027 38.107 80.1678 34.9921 80.4452 33.3235C80.7781 31.6548 81 29.0962 81 27.5944C81 26.1483 80.7226 23.6453 80.3897 22.0323C80.0568 20.4749 78.9473 17.4157 77.8932 15.2464C76.8945 13.0772 75.1747 10.4629 72.1233 7.45937L72.0678 14.6902C72.0678 20.1967 71.9014 21.5873 71.4575 20.5305C71.1801 19.7518 70.2925 17.7494 69.5158 16.0807C68.739 14.4121 67.1856 11.7979 66.076 10.2961C64.9664 8.79429 62.5808 6.51379 60.75 5.17887C58.9192 3.89957 56.7555 2.56464 54.3699 1.61907L54.0925 16.9151L52.3726 13.8559C51.4295 12.1872 49.4322 9.51736 47.8788 8.01557C46.3253 6.45816 43.4959 4.40015 41.5541 3.34334Z"
                fill="#F94A23" />
        </svg>
    </section>

    <section class="section-creative">
        <div class="swiper main-carousel">
            <div class="swiper-wrapper">

                <?php
                $args = [
                    'post_type' => 'criadores-parceiros',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'order' => 'DESC',
                ];
                $query = new WP_Query($args);

                if ($query->have_posts()):
                    while ($query->have_posts()):
                        $query->the_post();

                        $imagem_do_topo = get_field('imagem_do_topo');
                        $texto = get_field('texto');
                        $imagem_lateral = get_field('imagem_lateral');
                        $title = get_the_title();
                        ?>
                        <div class="swiper-slide creative-slide">
                            <div class="creative-top">
                                <?php if ($imagem_do_topo): ?>
                                    <img class="img" src="<?php echo esc_url($imagem_do_topo); ?>"
                                        alt="<?php echo esc_attr("$title – imagem do topo"); ?>" loading="lazy" />
                                <?php endif; ?>

                                <div class="container">
                                    <h2 class="title-section">
                                        <span>arquitetos</span>
                                        <span>e</span>
                                        <span>paisagistas</span>
                                        <span>criadores parceiros</span>
                                    </h2>
                                </div>
                            </div>

                            <div class="creative-bottom">
                                <div class="container">
                                    <div class="creative-content">
                                        <?php if ($texto): ?>
                                            <p><?php echo wp_kses_post($texto); ?></p>
                                        <?php else: ?>
                                            <p>Sem texto cadastrado.</p>
                                        <?php endif; ?>

                                        <a class="btn dkt" href="#">Seja um parceiro</a>
                                    </div>
                                </div>
                                <?php if ($imagem_lateral): ?>
                                    <img class="img-bottom" src="<?php echo esc_url($imagem_lateral); ?>"
                                        alt="<?php echo esc_attr("$title – imagem lateral"); ?>" loading="lazy" />
                                <?php endif; ?>

                                <a class="btn mbl" href="#">Seja um parceiro</a>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    ?>
                    <p>Nenhum parceiro encontrado.</p>
                <?php endif; ?>

            </div>

            <div class="container" style="position: relative;">
                <div class="swiper-pagination black" aria-hidden="true"></div>
            </div>
        </div>
    </section>


</main>

<?php get_footer(); ?>