<?php if(isset($message)): ?>
    <div class="alert alert-<?=$message['code']?>">
        <?=$message['message']?>
    </div>
<?php endif; ?>