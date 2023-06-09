<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once  dirname(__FILE__, 2) . '/config.php';
require_once ROOT_PATH_PARTS . 'header.php';
?>

<main class="container padding-0">

    <?php
    if (!array_key_exists('quiz', $_GET) && empty($_SERVER['HTTP_REFREER'])) {
        require_once ROOT_PATH_QUIZ . 'select-level.php';
    } else {
        $quiz_name = $_GET['quiz'];
        require_once ROOT_PATH_QUIZ . $quiz_name . '.php';
    }

    ?>
</main>

<?php
require_once ROOT_PATH_PARTS . 'footer.php';
