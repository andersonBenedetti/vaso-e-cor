<?php
// Template Name: Home
?>

<?php get_header(); ?>

<main id="pg-home">

    <section class="swiper-carrossel swiper">
        <div class="swiper-wrapper">
            <?php
            $args = array(
                'post_type' => 'carrossel',
                'status' => 'publish',
                'posts_per_page' => -1,
                'order' => 'DESC',
            );
            $the_query = new WP_Query($args);

            if ($the_query->have_posts()):
                while ($the_query->have_posts()):
                    $the_query->the_post(); ?>
                    <a class="swiper-slide" href="<?php the_field('link_da_imagem'); ?>">
                        <img class="dkp" src="<?php the_field('imagem_-_desktop'); ?>" alt="<?php the_title(); ?>">
                        <img class="mbl" src="<?php the_field('imagem_-_mobile'); ?>" alt="<?php the_title(); ?>">
                    </a>
                <?php endwhile;
                wp_reset_postdata();
            else: ?>
                <p><?php _e('Desculpe, nenhum slide encontrado.'); ?></p>
            <?php endif; ?>
        </div>
        <div class="swiper-pagination"></div>
    </section>


    <section class="products-shop">
        <div class="container">
            <div class="top">
                <h2>Orgânicos e fresquinhos</h2>
                <a href="/categoria-produto/hortifruti/" class="btn desk">Ver todos os ítens</a>
            </div>

            <?php if (!empty($data['hortifruti'])): ?>
                <?php vaso_e_cor_product_list($data['hortifruti']); ?>
            <?php else: ?>
                <p><?php _e('Nenhum produto encontrado na categoria Hortifruti.'); ?></p>
            <?php endif; ?>

            <a href="/categoria-produto/hortifruti/" class="btn mbl">Ver todos os ítens</a>
        </div>
    </section>
</main>

<?php get_footer(); ?>