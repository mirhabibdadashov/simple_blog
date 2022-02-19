<?php
    $errors = array();
    if(isset($_POST['title']) || isset($_POST['photoName']) || isset($_POST['photoName'])){
        $controller = require_once realpath($_SERVER["DOCUMENT_ROOT"])."\metak\Controller\BlogController.php";
        $errors = $controller::add($_POST, $_FILES);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
        <form class="container mt-3 p-3" method="post" style="border: 1px solid;" enctype='multipart/form-data'>
            <p class="text-center mt-3" style="font-weight: bold; font-size: 1.5rem;">Add New Post</p>
            <div class="form-group mt-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required value="<?php if(isset($_POST['title']))echo $_POST['title']; ?>">
                <span style="color: red;"><?php if(isset($errors['title']))echo $errors['title']; ?></span>
            </div>
            <div class="form-group mt-3">
                <label for="photoName">Upload photo</label>
                <input type="file" class="form-control-file" id="photoName" name="photoName" accept="image/*" required>
                <span style="color: red;"><?php if(isset($errors['photoName']))echo $errors['photoName']; ?></span>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Text</label>
                <textarea class="form-control" id="text" rows="3" name="text" required><?php if(isset($_POST['text']))echo $_POST['text']; ?></textarea>
                <span style="color: red;"><?php if(isset($errors['text']))echo $errors['text']; ?></span>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </body>
</html>