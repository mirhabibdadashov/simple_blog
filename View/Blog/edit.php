<?php
    $controller = require_once realpath($_SERVER["DOCUMENT_ROOT"])."\metak\Controller\BlogController.php";
    $errors = array();
    if(isset($_POST['title']) || isset($_POST['photoName']) || isset($_POST['photoName'])){
        $data = $controller::postedit($_POST, $_FILES);
        $blog = $data['blog'];
        $errors = $data['errors'];
    }
    else{
        $blog = $controller::getedit($_GET['post']);
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
            <p class="text-center mt-3" style="font-weight: bold; font-size: 1.5rem;">Edit Post</p>
            <input type="hidden" id="uid" name="uid" required value="<?php if(isset($blog['uid']))echo $blog['uid']; ?>">
            <div class="form-group mt-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required value="<?php if(isset($blog['title']))echo $blog['title']; ?>">
                <span style="color: red;"><?php if(isset($errors['title']))echo $errors['title']; ?></span>
            </div>
            <div class="form-group mt-3">
                <label for="photoName">Upload photo</label>
                <input type="file" class="form-control-file" id="photoName" name="photoName" accept="image/*">
                <span style="color: red;"><?php if(isset($errors['photoName']))echo $errors['photoName']; ?></span>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Text</label>
                <textarea class="form-control" id="text" rows="3" name="text" required><?php if(isset($blog['text']))echo $blog['text']; ?></textarea>
                <span style="color: red;"><?php if(isset($errors['text']))echo $errors['text']; ?></span>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </body>
</html>