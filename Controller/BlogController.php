<?php
class BlogController
{
    private static function Authorize(){
        if(!isset($_SESSION['password']) || $_SESSION['password'] != '123456789'){
            header("Location: /metak");
        }
    }

    function List($page){
        self::Authorize();
        $blog = require_once realpath($_SERVER["DOCUMENT_ROOT"]).'/metak/Model/Blog.php';
        return array("blogs" => $blog::get($page), "pageCount" => $blog::getPageCount());
    }

    function Add($data, $files){
        self::Authorize();
        if(!isset($data['title'])){
            $errors['title'] = "Title must be filled";
        }
        elseif(!isset($files['photoName'])){
            $errors['photoName'] = "Photo must be choosen";
        }
        elseif(!isset($data['text'])){
            $errors['text'] = "Text must be filled";
        }
        else{
            $blog = require_once realpath($_SERVER["DOCUMENT_ROOT"]).'/metak/Model/Blog.php';
            $blog->title = $data['title'];
            $blog->photoName = date("U")."_".basename($files["photoName"]["name"]);
            $blog->text = $data['text'];
            if($blog->add()){
                $target_dir = "Images/";
                $target_file = $target_dir.date("U")."_".basename($files["photoName"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                // if (file_exists($target_file)) {
                //     echo "Sorry, file already exists.";
                //     $uploadOk = 0;
                // }
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    $errors['photoName'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                if($uploadOk == 1){
                    if (move_uploaded_file($files["photoName"]["tmp_name"], $target_file)) {
                        header("Location: /metak/blog");
                    }
                    else {
                        $errors['photoName'] = "Sorry, there was an error uploading your file. Please try again";
                    }
                }
            }
            else{
                $errors["text"] = "Please try again";
            }
        }
        return $errors;
    }

    function getedit($post){
        self::Authorize();
        $blog = require_once realpath($_SERVER["DOCUMENT_ROOT"]).'/metak/Model/Blog.php';
        return $blog->getOne($post);
    }

    function postedit($data, $files){
        self::Authorize();
        $blog = require_once realpath($_SERVER["DOCUMENT_ROOT"]).'/metak/Model/Blog.php';
        $oldBlog = $blog->getOne($data['uid']);
        if(!isset($data['title'])){
            $errors['title'] = "Title must be filled";
        }
        elseif(!isset($data['text'])){
            $errors['text'] = "Text must be filled";
        }
        else{
            $blog->uid = $oldBlog['uid'];
            $blog->title = $data['title'];
            $unify = date("U");
            if($files['photoName']["name"] != ""){
                $blog->photoName = $unify."_".basename($files["photoName"]["name"]);
            }
            $blog->text = $data['text'];
            if($blog->update()){
                $target_dir = "Images/";
                $target_file = $target_dir.$unify."_".basename($files["photoName"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                if($files['photoName']["name"] != ""){
                    if (file_exists($target_dir.$oldBlog['photoName'])) {
                        unlink($target_dir.$oldBlog['photoName']);
                    }
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                        $errors['photoName'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                    }
                    if($uploadOk == 1){
                        if (!move_uploaded_file($files["photoName"]["tmp_name"], $target_file)) {
                            $errors['photoName'] = "Sorry, there was an error uploading your file. Please try again";
                        }
                    }
                }
                $oldBlog = $blog;
                header("Location: /metak/blog");
            }
            else{
                $errors["text"] = "Please try again";
            }
        }
        return array("blog" => $oldBlog, "errors" => $errors);
    }

    function Delete($post){
        self::Authorize();
        $blog = require_once realpath($_SERVER["DOCUMENT_ROOT"]).'/metak/Model/Blog.php';
        $oldBlog = $blog->getOne($post);
        if (file_exists("Images/".$oldBlog['photoName'])) {
            unlink("Images/".$oldBlog['photoName']);
        }
        $blog->uid = $oldBlog['uid'];
        $blog->delete();
    }
}
return new BlogController;