<?php
// config file maily for constants
// paths 
if (!defined("ROOT_PATH")) {
    define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT'] . '/kids-quiz/');
}
if (!defined("ROOT_PATH_DB")) {
    define("ROOT_PATH_DB", $_SERVER['DOCUMENT_ROOT'] . '/kids-quiz/database/config.database.php');
}
if (!defined("ROOT_PATH_DBTABLES")) {
    define("ROOT_PATH_DBTABLES", $_SERVER['DOCUMENT_ROOT'] . '/kids-quiz/database/tables.database.php');
}
if (!defined("ROOT_PATH_CLASS")) {
    define("ROOT_PATH_CLASS", $_SERVER['DOCUMENT_ROOT'] . '/kids-quiz/controller/');
}
if (!defined("ROOT_PATH_PARTS")) {
    define("ROOT_PATH_PARTS", $_SERVER['DOCUMENT_ROOT'] . '/kids-quiz/parts/');
}
if (!defined("ROOT_PATH_QUIZ")) {
    define("ROOT_PATH_QUIZ", $_SERVER['DOCUMENT_ROOT'] . '/kids-quiz/quiz/');
}
if (!defined("ROOT_PATH_QUIZ_LEVEL")) {
    define("ROOT_PATH_QUIZ_LEVEL", $_SERVER['DOCUMENT_ROOT'] . '/kids-quiz/quiz/index.php?level=');
}
//paths

//urls
if (!defined("ROOT_PATH_ACTION") || !defined("ROOT_URL_ACTION")) {
    define("ROOT_PATH_ACTION", $_SERVER['DOCUMENT_ROOT'] . '/kids-quiz/classes/actions/');
    $root_url = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/kids-quiz/actions/';
    define("ROOT_URL_ACTION", $root_url);
}
if (!defined("ROOT_URL")) {
    $root_url = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/kids-quiz/';
    define("ROOT_URL", $root_url);
}
if (!defined("ROOT_URL_QUIZ")) {
    $root_url = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/kids-quiz/quiz/';
    define("ROOT_URL_QUIZ", $root_url);
}
if (!defined("ROOT_URL_LEVEL")) {
    $root_url = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/kids-quiz/quiz/index.php?quiz=';
    define("ROOT_URL_LEVEL", $root_url);
}

if (!defined("ASSETS_URL")) {
    $root_url = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/kids-quiz/assets/';
    define("ASSETS_URL", $root_url);
}
