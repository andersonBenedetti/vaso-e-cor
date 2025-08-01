<?php get_header(); ?>

<?php
function format_single_product($id)
{
    $product = wc_get_product($id);

    return [
        'id' => $id,
        'name' => $product->get_name(),
        'link' => $product->get_permalink(),
        'description' => $product->get_description(),
        'short_description' => $product->get_short_description(),
    ];
}

?>

<main id="single-product">

    <section class="section-content container">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                $produto = format_single_product(get_the_ID());
                ?>
                <div class="product-detail">
                    <div class="detail-content">
                        <h1 class="title"><?= $produto['name']; ?></h1>

                        <p class="short-description">
                            <?= wpautop(wp_kses_post($produto['short_description'])); ?>
                        </p>

                        <?php
                        $acabamentos = [];

                        for ($i = 1; $i <= 3; $i++) {
                            $nome = get_field("nome_do_acabamento" . ($i == 1 ? '' : "_$i"));
                            $link = get_field("link_do_acabamento" . ($i == 1 ? '' : "_$i"));

                            if (!empty($nome) && !empty($link)) {
                                $acabamentos[] = [
                                    'nome' => $nome,
                                    'link' => $link,
                                ];
                            }
                        }

                        if (!empty($acabamentos)): ?>
                            <div class="lista-acabamentos">
                                <?php foreach ($acabamentos as $acabamento): ?>
                                    <a href="<?php echo esc_url($acabamento['link']); ?>" target="_blank" rel="noopener noreferrer">
                                        <?php echo esc_html($acabamento['nome']); ?>
                                    </a><br>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <?php woocommerce_template_single_add_to_cart(); ?>

                        <?php
                        if ($product->is_type('variable') && $product->get_available_variations()) {
                            $whatsapp_number = '554834690743';
                            $mensagem = "Olá! Tenho interesse no produto *{$produto['name']}*. Pode me passar mais informações?";
                            $link_whats = "https://wa.me/{$whatsapp_number}?text=" . urlencode($mensagem);
                            ?>
                            <a href="<?= esc_url($link_whats); ?>" target="_blank" class="btn-whatsapp">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/whatsapp.svg" alt="whatsapp">
                                Falar no WhatsApp
                            </a>
                        <?php } ?>

                        <a href="#">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/3d.svg" alt="3D Warehouse">
                        </a>

                    </div>

                    <div>
                        <?php echo wpautop(wp_kses_post($produto['description'])); ?>

                        <?php
                        $peso = get_field('peso');
                        $medidas = get_field('medidas');

                        // Filtro para transformar links de imagem em popups
                        if ($medidas) {
                            // Regex para encontrar <a href="link-de-imagem">
                            $medidas = preg_replace_callback(
                                '#<a\s[^>]*href=["\']([^"\']+\.(?:jpg|jpeg|png|gif|webp))["\'][^>]*>(.*?)</a>#i',
                                function ($matches) {
                                    $url = esc_url($matches[1]);
                                    $label = strip_tags($matches[2]);
                                    return '<a href="#popup-imagem" class="abrir-popup" data-img="' . $url . '">' . esc_html($label) . '</a>';
                                },
                                $medidas
                            );
                        }
                        ?>

                        <?php if ($peso || $medidas): ?>
                            <div class="informacoes-extras-produto">
                                <?php if ($peso): ?>
                                    <div class="item-peso">
                                        <strong>Peso:</strong><br>
                                        <?php echo wp_kses_post($peso); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($medidas): ?>
                                    <div class="item-medidas">
                                        <strong>Medidas:</strong><br>
                                        <?php echo $medidas; // já filtrado ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

                <div class="product-gallery">
                    <?php echo do_shortcode('[wcgs_gallery_slider]'); ?>
                </div>
            </section>

        <?php }
        } ?>

    <?php
    $related_ids = get_post_meta($produto['id'], '_upsell_ids', true);
    $related_products = [];

    if (!empty($related_ids)) {
        foreach ($related_ids as $product_id) {
            $related_products[] = wc_get_product($product_id);
        }
    }

    if (!empty($related_products)) {
        $related = format_products($related_products);
        ?>

        <section class="related-list">
            <div class="container">
                <h2 class="title">Produtos relacionados</h2>

                <?php quitanda_product_list($related); ?>
            </div>
        </section>

        <?php
    }
    ?>

</main><?php get_footer(); ?>