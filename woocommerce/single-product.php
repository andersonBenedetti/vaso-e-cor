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
                        <h1><?= $produto['name']; ?></h1>

                        <div class="short-description">
                            <?= wpautop(wp_kses_post($produto['short_description'])); ?>
                        </div>

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
                            <div class="list-acabamentos">
                                <?php foreach ($acabamentos as $acabamento): ?>
                                    <a class="btn" href="<?php echo esc_url($acabamento['link']); ?>" target="_blank"
                                        rel="noopener noreferrer">
                                        <?php echo esc_html($acabamento['nome']); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <?php woocommerce_template_single_add_to_cart(); ?>

                        <div class="btn-details">
                            <?php
                            if ($product->is_type('variable') && $product->get_available_variations()) {
                                $whatsapp_number = '554834690743';
                                $mensagem = "Olá! Tenho interesse no produto *{$produto['name']}*. Pode me passar mais informações?";
                                $link_whats = "https://wa.me/{$whatsapp_number}?text=" . urlencode($mensagem);
                                ?>
                                <a href="<?= esc_url($link_whats); ?>" target="_blank" class="btn btn-whatsapp">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/whatsapp.svg" alt="whatsapp">
                                    Compre aqui
                                </a>
                            <?php } ?>

                            <?php $link_3d = get_field('3d_w'); ?>
                            <?php if ($link_3d): ?>
                                <a class="btn-3d" href="<?php echo esc_url($link_3d); ?>" target="_blank" rel="noopener">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/3d.svg" alt="3D Warehouse">
                                </a>
                            <?php endif; ?>
                        </div>

                    </div>

                    <?php
                    $peso = get_field('peso') ?: '';
                    $medidas = get_field('medidas') ?: '';

                    if ($medidas) {
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

                    <div class="abas-btns">
                        <div class="toggle-content">
                            <button class="toggle-btn" data-target="descricao">
                                Descrição
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/arrow-bottom.svg" alt="Flecha">
                            </button>
                            <div id="descricao" class="tab-content">
                                <?php echo wpautop(wp_kses_post($produto['description'])); ?>
                            </div>
                        </div>

                        <div class="toggle-content">
                            <?php if ($peso): ?>
                                <button class="toggle-btn" data-target="peso">
                                    Peso
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/arrow-bottom.svg" alt="Flecha">
                                </button>
                                <div id="peso" class="tab-content">
                                    <?php echo wp_kses_post($peso); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="toggle-content">
                            <?php if ($medidas): ?>
                                <button class="toggle-btn" data-target="medidas">
                                    Medidas
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/arrow-bottom.svg" alt="Flecha">
                                </button>
                                <div id="medidas" class="tab-content">
                                    <?php echo $medidas; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>

                <div class="product-gallery">
                    <?php echo do_shortcode('[wcgs_gallery_slider]'); ?>
                </div>
            </section>

        <?php }
        } ?>

    <?php
    global $woocommerce;
    $cart_cross_sells = [];

    if ($product = wc_get_product(get_the_ID())) {
        $cross_sell_ids = $product->get_cross_sell_ids();

        if (!empty($cross_sell_ids)) {
            foreach ($cross_sell_ids as $product_id) {
                $cart_cross_sells[] = wc_get_product($product_id);
            }
        }
    }

    if (!empty($cart_cross_sells)) {
        $formatted_cross = format_products($cart_cross_sells);
        ?>
        <section class="cross-sell-products related-list">
            <div class="container">
                <div class="content-cross">
                    <div class="text">
                        <h2>Acessórios que fazem a diferença</h2>
                        <p>Funcionais e discretos, os acessórios indicados para cada modelo ajudam a reter a água da rega,
                            proporcionando mais praticidade no dia a dia.</p>
                    </div>

                    <div class="swiper cross-sell-carousel">
                        <div class="swiper-wrapper">
                            <?php foreach ($formatted_cross as $product): ?>
                                <div class="swiper-slide">
                                    <a href="<?= esc_url($product['link']); ?>" class="product-link">
                                        <img src="<?= esc_url($product['img']); ?>" alt="<?= esc_attr($product['name']); ?>" />
                                        <h3><?= esc_html($product['name']); ?></h3>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

    <?php
    $upsell_ids = get_post_meta($produto['id'], '_upsell_ids', true);
    $upsell_products = [];

    if (!empty($upsell_ids)) {
        foreach ($upsell_ids as $product_id) {
            $upsell_products[] = wc_get_product($product_id);
        }
    }

    if (!empty($upsell_products)) {
        $formatted_upsells = format_products($upsell_products);
        ?>
        <section class="upsell-products related-list">
            <div class="container">
                <h2 class="title">VOCÊ TAMBÉM PODE GOSTAR:</h2>
                <div class="swiper upsell-carousel">
                    <div class="swiper-wrapper">
                        <?php foreach ($formatted_upsells as $product): ?>
                            <div class="swiper-slide">
                                <a href="<?= esc_url($product['link']); ?>" class="product-link">
                                    <img src="<?= esc_url($product['img']); ?>" alt="<?= esc_attr($product['name']); ?>" />
                                    <h3><?= esc_html($product['name']); ?></h3>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <a class="btn" href="/loja">Ver todos os produtos</a>
            </div>
        </section>
    <?php } ?>

</main>

<?php get_footer(); ?>