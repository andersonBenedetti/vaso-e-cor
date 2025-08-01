<?php
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

function vaso_e_cor_add_woocommerce_support()
{
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'vaso_e_cor_add_woocommerce_support');

add_theme_support('post-thumbnails');

register_nav_menus([
    'categorias' => 'Categorias'
]);

function vaso_e_cor_loop_shop_per_page()
{
    return 9;
}

add_filter('loop_shop_per_page', 'vaso_e_cor_loop_shop_per_page');

function format_products($products)
{
    $products_final = [];
    foreach ($products as $product) {
        $image = wp_get_attachment_image_src($product->get_image_id());
        $products_final[] = [
            'id' => $product->get_id(),
            'name' => $product->get_name(),
            'img' => $image ? $image[0] : '',
            'link' => $product->get_permalink(),
        ];
    }
    return $products_final;
}


function vaso_e_cor_product_list($products)
{
    echo '<ul class="products-list">';
    foreach ($products as $product) {
        ?>
        <li class="product-item">
            <a href="<?= esc_url($product['link']); ?>" class="product-link">
                <img src="<?= esc_url($product['img']); ?>" alt="<?= esc_attr($product['name']); ?>" />
                <h3><?= esc_html($product['name']); ?></h3>
            </a>
        </li>
        <?php
    }
    echo '</ul>';
}

function custom_post_type($post_type, $singular_name, $plural_name)
{
    $labels = array(
        'name' => $plural_name,
        'singular_name' => $singular_name,
        'menu_name' => $plural_name,
        'add_new' => 'Adicionar Novo',
        'add_new_item' => 'Adicionar Novo',
        'edit' => 'Editar',
        'edit_item' => 'Editar',
        'new_item' => 'Novo',
        'view' => 'Ver',
        'view_item' => 'Ver',
        'search_items' => 'Procurar',
        'not_found' => 'Nenhum slide encontrado',
        'not_found_in_trash' => 'Nenhum slide encontrado no Lixo',
    );

    $args = array(
        'label' => $plural_name,
        'description' => $plural_name,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => false,
        'rewrite' => array('slug' => $post_type, 'with_front' => true),
        'query_var' => true,
        'supports' => array('title', 'thumbnail'),
        'labels' => $labels,
    );

    register_post_type($post_type, $args);
}

add_action('init', function () {
    custom_post_type('carrossel', 'Carrossel', 'Carrossel');
    custom_post_type('criadores-parceiros', 'Carrossel parceiros', 'Carrossel parceiros');
});

add_filter('woocommerce_catalog_orderby', 'custom_woocommerce_catalog_orderby', 20);
add_filter('woocommerce_default_catalog_orderby_options', 'custom_woocommerce_catalog_orderby', 20);
function custom_woocommerce_catalog_orderby($sortby)
{
    $sortby['bestsellers'] = 'Mais vendidos';
    $sortby['discount'] = 'Desconto';
    $sortby['name_asc'] = 'Nome (A–Z)';
    $sortby['name_desc'] = 'Nome (Z–A)';

    $ordered = array(
        'menu_order' => 'Ordenação padrão',
        'popularity' => 'Relevância',
        'date' => 'Mais recentes',
        'name_asc' => 'Nome em ordem crescente',
        'name_desc' => 'Nome em ordem decrescente',
    );

    return $ordered;
}

add_filter('woocommerce_get_catalog_ordering_args', 'custom_woocommerce_get_catalog_ordering_args');
function custom_woocommerce_get_catalog_ordering_args($args)
{
    if (isset($_GET['orderby'])) {
        switch ($_GET['orderby']) {
            case 'bestsellers':
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'DESC';
                $args['meta_key'] = 'total_sales';
                break;
            case 'discount':
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'DESC';
                $args['meta_key'] = '_sale_price';
                break;
            case 'name_asc':
                $args['orderby'] = 'title';
                $args['order'] = 'ASC';
                break;
            case 'name_desc':
                $args['orderby'] = 'title';
                $args['order'] = 'DESC';
                break;
        }
    }
    return $args;
}

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);