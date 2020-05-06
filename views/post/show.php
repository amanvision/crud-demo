<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/config/setting.php'); ?>
<?php require_once(path('elements/header.php')); ?>

<?php require_once(path('classes/Post.php')); ?>
<?php
if (isset($_POST['submit'])) {
    $post = new Post();
    $message = $post->modify($_GET['id']);
}

if (isset($_GET['id'])) {
    $post = new Post();
    $result = $post->getById($post->tableName, $_GET['id']);
    if ($result == false) {
        $message = [
            'code' => 'danger',
            'message' => 'Error! Post not found.'
        ];
    }
}
?>

<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= url('views/post/index.php') ?>">Posts</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Post</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <?php require(path('elements/message.php')); ?>
                <?php if ($result) : ?>
                    <strong>Title:</strong>
                    <p><?= $result['title'] ?></p>
                    <strong>Description:</strong>
                    <p><?= $result['description'] ?></p>

                    <a href="<?=url('views/post/edit.php?id=' . $result['id'])?>">Edit</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once(path('elements/footer.php')); ?>