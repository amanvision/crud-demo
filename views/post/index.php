<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/config/setting.php'); ?>
<?php require_once(path('elements/header.php')); ?>
<?php require_once(path('classes/Post.php')); ?>
<?php
    $post = new Post();
    $posts = $post->index();

    if(isset($_GET['delete'])) {
        $result = $post->getById($post->tableName, $_GET['delete']);
        if($result) {
            $post->destory($_GET['delete']);
        } else {
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
                <li class="breadcrumb-item"><a href="<?=url()?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Posts</li>
            </ol>
        </nav>
        <?php require_once(path('elements/message.php')); ?>
        <div class="card">
            <div class="card-body">
                <div class="float-right mb-2">
                    <a href="<?=url("views/post/create.php")?>" class="btn btn-dark">Create Post</a>
                </div>
                <table class="table">
                    <thead>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php if(!empty($posts)): ?>
                            <?php foreach($posts as $post): ?>
                                <tr>
                                    <td><a href="<?=url('views/post/show.php?id=' . $post['id'])?>"><?=$post['title']?></a></td>
                                    <td><?=limit($post['description'], 50, "...")?></td>
                                    <td>
                                        <a href="<?=url('views/post/edit.php?id=' . $post['id'])?>" class='btn btn-sm btn-info'>
                                            Edit
                                        </a>
                                        <button type='button' data-url="<?=url('views/post/index.php?delete=' . $post['id'])?>" class='btn btn-sm btn-danger delete-post'>
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr class='text-center'>
                                <td colspan="3">No Posts available yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once(path('elements/footer.php')); ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const buttons = document.querySelectorAll('.delete-post');
        buttons.forEach(el => el.addEventListener('click', function(event) {
            if(confirm('Are you sure want to delete?')) {
                window.location = event.target.dataset.url;
            }
        }));
    });
</script>