<?php
class HomeController
{
    function login($password){
        if($password == '123456789'){
            $_SESSION['password'] = $password;
            header("Location: /metak/blog");
        }
        else{
            return "Password is not correct";
        }
    }
}

return new HomeController;