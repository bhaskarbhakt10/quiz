<footer>

    <!-- //dependency  -->
    <?php
    $scripts_dep = scandir(ROOT_PATH . 'assets/js/dependency-js');
    unset($scripts_dep[0]);
    unset($scripts_dep[1]);
    foreach ($scripts_dep as $script_dep) {
    ?>
        <script src="<?php echo ROOT_URL . 'assets/js/dependency-js/' . $script_dep ?>"></script>
    <?php
    }

    ?>

    <!-- // css  -->
    <?php
    $scripts = scandir(ROOT_PATH . 'assets/js/custom-scripts');
    unset($scripts[0]);
    unset($scripts[1]);
    foreach ($scripts as $script) {
    ?>
        <script src="<?php echo ROOT_URL . 'assets/js/custom-scripts/' . $script ?>"></script>
    <?php
    }
    ?>

    <!-- //php js scripts  -->
    <?php
    $php_js = scandir(ROOT_PATH . 'assets/php-js-scripts');
    unset($php_js[0]);
    unset($php_js[1]);
    foreach ($php_js as $js) {
        require_once ROOT_PATH . 'assets/php-js-scripts/' . $js ;
    }
    ?>

</footer>
</body>

</html>