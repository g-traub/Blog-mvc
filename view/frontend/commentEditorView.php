<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

    <p><a href="index.php?action=post&amp;id=<?= $_GET['postId'] ?>">Retour (sans prendre en compte les modifications)</a></p>
    <div class='commentEditor'>
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['date_comment_fr'] ?></p>
        <form method='post' action='index.php?action=editComment&amp;commentId=<?= $comment['id'] ?>&amp;postId=<?= $_GET['postId'] ?>'>
            <input type='text' name='edited_comment' value='<?= $comment['comment'] ?>'required>
            <input type='submit' value='Modifier'>
        </form>
    </div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>