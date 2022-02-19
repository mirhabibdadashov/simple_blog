<?php
$controller = require_once realpath($_SERVER["DOCUMENT_ROOT"])."\metak\Controller\BlogController.php";
$page = '1';
if(isset($_GET['page']))$page = $_GET['page'];
$blogs = $controller::List($page);
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row mt-3">
                <div class="button ml-auto">
                    <a href="/metak/blog/add" class="btn btn-primary">Add</a>
                </div>
            </div>
                <?php
                if(sizeof($blogs["blogs"]) > 0)
                {
                ?>
                <p class="mt-3 text-center" style="font-size:32px; font-weight: bold;">Posts</p>
                <div class='row mt-3'>
                    <?php
                    foreach($blogs["blogs"] as $blog)
                    {
                    ?>
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="<?php echo "\metak\Images\\".$blog['photoName'] ?>" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text"><?php echo $blog['title'] ?></p>
                                <p class="card-text" style = "color: gray;">
                                    <?php 
                                    if(strlen($blog['text']) > 100){
                                        echo substr($blog['text'], 0, 100)."...";
                                    }
                                    else{
                                        echo $blog['text'];
                                    }
                                    ?>
                                </p>
                                <a href="/metak/blog/edit?post=<?php echo $blog['uid'] ?>" class="btn btn-primary">Edit</a>
                                <a href="/metak/blog/delete?post=<?php echo $blog['uid'] ?>" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php }
            if($blogs['pageCount'] > 1)
            {
            ?>
                <div class="row mt-3">
                    <div class="pagination ml-auto">
                        <?php
                        for($i = 1; $i <= $blogs['pageCount']; $i++)
                        {
                        ?>
                            <a href="/metak/blog?page=<?php echo $i ?>" class="btn btn-primary"><?php echo $i ?></a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </body>
</html>