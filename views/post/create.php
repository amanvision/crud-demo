<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/config/setting.php'); ?>
<?php require_once(path('elements/header.php')); ?>

<?php require_once(path('classes/Post.php')); ?>
<?php
    if(isset($_POST['submit'])) {
        $post = new Post();
        $message = $post->store();
    }
?>

<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= url('views/post/index.php') ?>">Posts</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <?php require(path('elements/message.php')); ?>
                <form method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input name="title" required type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea name="description" required class="form-control" id="exampleInputPassword1"></textarea>
                    </div>

                    <button name="submit" type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once(path('elements/footer.php')); ?>