<?php

require_once  dirname(__FILE__, 2) . '\config.php';
require_once ROOT_PATH_PARTS . 'header.php';
?>

<main class="container d-none">

    <?php
    if (!array_key_exists('quiz', $_GET) && empty($_SERVER['HTTP_REFREER'])) {
        require_once ROOT_PATH . 'add-question/add-question-form/form.php';
        ?>
        <script>
                checkAdmin();
        </script>
        <?php
    }
    ?>


</main>

<?php
require_once ROOT_PATH_PARTS . 'footer.php';
?>
