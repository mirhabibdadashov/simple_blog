<?php
$request = str_replace("/metak", "", $_SERVER['REQUEST_URI']);
session_start();
switch ($request) {
    case '/' :
        require __DIR__ . '/view/home/list.php';
        break;
    case '' :
        require __DIR__ . '/view/home/list.php';
        break;
    case '/index' :
        require __DIR__ . '/view/home/list.php';
        break;
    case '/blog':
        require __DIR__ . '/view/blog/list.php';
        break;
    case '/blog/index' :
        require __DIR__ . '/view/blog/list.php';
        break;
    case '/blog/add' :
        require __DIR__ . '/view/blog/add.php';
        break;
    case '/blog/edit' :
        require __DIR__ . '/view/blog/edit.php';
        break;
    default:
        if(strpos($request, "/blog/edit") !== false){
            require __DIR__ . '/view/blog/edit.php';
            break;
        }
        elseif(strpos($request, "/blog/delete") !== false){
            require __DIR__ . '/view/blog/delete.php';
            break;
        }
        elseif(strpos($request, "/blog") !== false){
            require __DIR__ . '/view/blog/list.php';
            break;
        }
        else{
            http_response_code(404);
            require __DIR__ . '/view/404.php';
        }
        break;
}