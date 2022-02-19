<?php
    $controller = require_once realpath($_SERVER["DOCUMENT_ROOT"])."\metak\Controller\BlogController.php";
    $controller->delete($_GET['post']);
    header("Location: /metak/blog");
?>