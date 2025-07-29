<?php
$footer_menu_institucional = [
    ['label' => 'Quem somos', 'url' => '#'],
    ['label' => 'Seja um profissional parceiro', 'url' => '#'],
    ['label' => 'Ferramentas', 'url' => '#'],
    ['label' => 'Blog', 'url' => '#'],
    ['label' => 'Fale conosco', 'url' => '#'],
];

$footer_menu_infos = [
    ['label' => 'Manual de uso e cuidados', 'url' => '#'],
    ['label' => 'Perguntas frequentes', 'url' => '#'],
    ['label' => 'Políticas de privacidade', 'url' => '#'],
    ['label' => 'Políticas de frete', 'url' => '#'],
    ['label' => 'Trocas e devoluções', 'url' => '#'],
];
?>

<footer id="footer">
    <div class="container">
        <div class="footer-top">
            <a href="/" class="logo" aria-label="Voltar para página inicial">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-footer.svg"
                    alt="Logo Vaso & Cor - Voltar para página inicial" loading="lazy" width="150" height="auto">
            </a>

            <div class="links-social">
                <a href="#" title="Siga no Instagram" target="_blank" rel="noopener noreferrer">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/instagram.svg" alt="Instagram"
                        loading="lazy" width="24" height="24">
                </a>
                <a href="#" title="Inscreva-se no YouTube" target="_blank" rel="noopener noreferrer">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/youtube.svg" alt="YouTube"
                        loading="lazy" width="24" height="24">
                </a>
            </div>
        </div>

        <div class="footer-main">
            <address class="footer-column">
                <a href="https://wa.me/554834690743" target="_blank" rel="noopener noreferrer">
                    <span>Telefone/WhatsApp:</span>+55 (48) 3469-0743
                </a>

                <a href="mailto:faleconosco@vasoecor.com.br">
                    <span>E-mail:</span>faleconosco@vasoecor.com.br
                </a>

                <p>
                    <span>Horário de atendimento:</span>Segunda a sexta — 08h30 às 18h00
                </p>
            </address>

            <nav class="footer-column" aria-labelledby="footer-institucional">
                <h3 id="footer-institucional">Institucional</h3>
                <ul>
                    <?php
                    foreach ($footer_menu_institucional as $item) {
                        echo '<li><a href="' . esc_url($item['url']) . '" aria-label="' . esc_html($item['label']) . '">' . esc_html($item['label']) . '</a></li>';
                    }
                    ?>
                </ul>
            </nav>

            <nav class="footer-column" aria-labelledby="footer-informacoes">
                <h3 id="footer-informacoes">Informações</h3>
                <ul>
                    <?php
                    foreach ($footer_menu_infos as $item) {
                        echo '<li><a href="' . esc_url($item['url']) . '" aria-label="' . esc_html($item['label']) . '">' . esc_html($item['label']) . '</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>

        <div class="footer-bottom">
            <p>Vaso e Cor. Todos os direitos reservados.</p>
            <p>Desenvolvido por <a href="#" rel="noopener noreferrer" target="_blank">Blume Web Studio</a></p>
        </div>
    </div>
</footer>

<a href="https://wa.me/554834690743" class="whatsapp-float" target="_blank" aria-label="Fale conosco no WhatsApp">
    <img src="https://cdn.jsdelivr.net/gh/rafaelbotazini/floating-whatsapp/whatsapp.svg" alt="WhatsApp" width="60"
        height="60">
</a>


<script>
    const app = new Vue({
        el: '#app',
        data: {
            activeMenu: false,
        },
        created() { },
        methods: {}
    });
</script>

</div>
<script src="<?php echo get_template_directory_uri(); ?>/js/swiper-bundle.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/slider.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>

<?php wp_footer(); ?>
</body>

</html>