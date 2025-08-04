<?php get_header(); ?>

<?php
global $wp_query;
echo paginate_links(array(
  'total' => $wp_query->max_num_pages,
  'current' => max(1, get_query_var('paged')),
));
?>

<main id="archive-product">

  <section class="section-intro">
    <div class="container">
      <h1>
        <?php
        if (is_shop()) {
          echo 'Loja';
        } else {
          single_cat_title();
        }
        ?>
      </h1>
    </div>
  </section>

  <section class="section-filters">
    <div class="container">
      <div class="filters-content">
        <div class="filters-left">
          <div class="custom-select">
            <?php
            $product_categories = get_categories(array(
              'taxonomy' => 'product_cat',
              'hide_empty' => false,
            ));

            if (!empty($product_categories)) {
              echo '<select class="category-select" onchange="location = this.value;">';
              echo '<option value="">Filtre por categoria</option>';
              foreach ($product_categories as $category) {
                echo '<option value="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</option>';
              }
              echo '</select>';
            } else {
              echo '<p>Não foram encontradas categorias de produtos.</p>';
            }
            ?>
          </div>

          <?php
          $acabamentos = get_terms(array(
            'taxonomy' => 'pa_acabamento',
            'hide_empty' => false,
          ));

          if (!empty($acabamentos) && !is_wp_error($acabamentos)) {
            echo '<div class="custom-select">';
            echo '<select class="acabamento-select" onchange="location = this.value;">';
            echo '<option value="">Filtre por Acabamento</option>';
            foreach ($acabamentos as $acabamento) {
              $url = add_query_arg('filter_acabamento', $acabamento->slug, get_permalink(wc_get_page_id('shop')));
              echo '<option value="' . esc_url($url) . '">' . esc_html($acabamento->name) . '</option>';
            }
            echo '</select>';
            echo '</div>';
          }

          $cores = get_terms(array(
            'taxonomy' => 'pa_cor',
            'hide_empty' => false,
          ));

          if (!empty($cores) && !is_wp_error($cores)) {
            echo '<div class="custom-select">';
            echo '<select class="cor-select" onchange="location = this.value;">';
            echo '<option value="">Filtre por Cor</option>';
            foreach ($cores as $cor) {
              $url = add_query_arg('filter_cor', $cor->slug, get_permalink(wc_get_page_id('shop')));
              echo '<option value="' . esc_url($url) . '">' . esc_html($cor->name) . '</option>';
            }
            echo '</select>';
            echo '</div>';
          }
          ?>
        </div>

        <div class="custom-select">
          <?php
          $orderby_options = apply_filters(
            'woocommerce_catalog_orderby',
            array(
              'menu_order' => 'Ordenação padrão',
              'popularity' => 'Mais populares',
              'rating' => 'Melhor avaliação',
              'date' => 'Mais recentes',
            )
          );

          $current_orderby = isset($_GET['orderby']) ? wc_clean($_GET['orderby']) : 'menu_order';

          $base_url = get_permalink(wc_get_page_id('shop'));

          $query_args = $_GET;
          unset($query_args['orderby']);

          echo '<select class="orderby-select" onchange="if(this.value) window.location.href=this.value">';
          echo '<option value="">Ordenar por</option>';

          foreach ($orderby_options as $value => $label) {
            $query_args['orderby'] = $value;
            $url = esc_url(add_query_arg($query_args, $base_url));

            echo '<option value="' . $url . '" ' . selected($current_orderby, $value, false) . '>' . esc_html($label) . '</option>';
          }

          echo '</select>';
          ?>
        </div>
      </div>
    </div>
  </section>

  <section class="products-store">
    <div class="container">

      <?php
      $products = [];
      if (have_posts()) {
        while (have_posts()) {
          the_post();
          $product = wc_get_product(get_the_ID());

          if (!current_user_can('administrator') && $product && $product->get_status() !== 'publish') {
            continue;
          }

          $products[] = $product;
        }
      }

      $formatted_products = format_products($products);
      ?>

      <?php if (!empty($formatted_products)): ?>
        <?php vaso_e_cor_product_list($formatted_products); ?>

        <div class="pagination">
          <?php woocommerce_pagination(); ?>
        </div>

      <?php else: ?>
        <section class="no-results">
          <div class="container">
            <p>Nenhum resultado encontrado.</p>
            <p>Confira outras categorias ou redefina os filtros para encontrar o produto ideal.</p>
          </div>
        </section>
      <?php endif; ?>

    </div>
  </section>

</main>

<?php get_footer(); ?>