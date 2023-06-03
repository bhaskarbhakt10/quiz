<?php
// incuding config file
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- //dependency  -->
    <?php
    $styles_dep = scandir(ROOT_PATH . 'assets/css/dependency-css');
    unset($styles_dep[0]);
    unset($styles_dep[1]);
    foreach ($styles_dep as $style_dep) {
    ?>
        <link rel="stylesheet" href="<?php echo ROOT_URL . 'assets/css/dependency-css/' . $style_dep ?>" />
    <?php
    }

    ?>

    <!-- // css  -->
    <?php
    $styles = scandir(ROOT_PATH . 'assets/css/custom-css');
    unset($styles[0]);
    unset($styles[1]);
    foreach ($styles as $style) {
    ?>
        <link rel="stylesheet" href="<?php echo ROOT_URL . 'assets/css/custom-css/' . $style ?>" />
    <?php
    }
    ?>
    <title>Divine Uk Quiz</title>
</head>

<body>