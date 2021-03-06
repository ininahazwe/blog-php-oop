<?php

include_once "functions.php"; 

    $post_id = (isset($_GET['post_id']) ? $_GET['post_id'] : "");
    $page = $_GET['page'];
    if($post_details = $post_obj->loadSingle($post_id)) {
        $title = $post_details->title;
        $content = $post_details->content;
        $tags = $post_details->tags;
        $category = $post_details->category;
        $image = $post_details->image;
    }else{
        header("Location: posts.php?page=$page&post_id_invalid");
    }

//updade post

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $t = $_POST['title'];    
    $con = $_POST['content'];
    $tag = $_POST['tags'];
    $catt = $_POST['categories'];
    $img = $_FILES['image'];

    if ($img['name'] != ""){
        $image = upload($img, "post_images/", true);
    }
    
    $data = [$t, $con, $catt, $tag, $image, $post_id];

    if($post_obj->editPost($data)) {
        header("Location: posts.php?page=$page&post_updated"); 
    }else{
        $msg = "<div class='alert alert-danger'>Something went wrong</div>";
    }
}

?>

<div class="col-lg-8">

    <h2 class="text-left">Edit Post</h2>
    <?php

    if (isset($msg)) {
        echo $msg;
    }

    ?>
    <form action="" method="post" enctype="multipart/form-data" autocomplete="off">

        <div class="form-group">
            <label for="">Title</label>
            <input type="text" name="title" id="" class="form-control" value="<?= $title; ?>">
        </div>

        <div class="form-group">
            <label for="">Image</label>
            <input type="file" name="image">
            <br>
            <img src="<?= $image; ?>" alt="Post Image" class="img-fluid" width="150" height="150">
        </div>

        <div class="form-group">
            <label for="">Tags</label>
            <input type="text" name="tags" id="" class="form-control" value="<?= $tags; ?>">
        </div>

        <div class="form-group">
            <label for="">Post Content</label>
            <textarea name="content" id="" cols="5" rows="5" class="form-control"><?= $content; ?></textarea>
        </div>

        <div class="form-group">
            <label for="">Categories</label>
            <select name="categories" class="form-control">
            <option value="<?= $category; ?>"><b>Initial category</b> - <?= $category; ?></option>
            
            <?php
                if($cat = $category_obj->loadCategories()) {
                    foreach ($cat as $c){
                        echo "<option value='$c->category'>$c->category</option>";
                    }
                }
            ?>

            </select>
        </div>

        <div class="form-group">
            <input type="submit" name="save" value="Save" class="btn btn-info btn-block">
        </div>
    </form>
</div>