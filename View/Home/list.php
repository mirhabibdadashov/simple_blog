<?php
$error = '';
if(isset($_POST['password'])){
    $controller = require_once realpath($_SERVER["DOCUMENT_ROOT"])."\metak\Controller\HomeController.php";
    $error = $controller::login($_POST['password']);
}
else{
    if(isset($_SESSION['password']) && $_SESSION['password'] == '123456789'){
        header("Location: /metak/blog");
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body style = 'margin: 0; padding: 0; height: 100vh;'>
        <div id="login">
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12" style = 'margin-top: 120px; max-width: 600px; height: 220px; border: 1px solid #9C9C9C; background-color: #EAEAEA;'>
                            <form id="login-form" class="form" method="post" style='padding: 20px;'>
                                <h3 class="text-center text-info">Login</h3>
                                <div class="form-group">
                                    <label for="password" class="text-info">Password:</label><br>
                                    <input type="text" name="password" id="password" class="form-control">
                                    <span style = 'color:red;'><?php echo $error; ?></span>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-info btn-md" value="Log in">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
