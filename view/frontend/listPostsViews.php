<?php $title = 'Mon Blog'; ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p>Derniers billets du blog :</p>

<?php
while ($data = $posts->fetch())
{
?>
<div class='news'>
    <h3>
        <?= htmlspecialchars($data['title']) ?>
        <em><?= htmlspecialchars($data['date_format']) ?></em>
    </h3>
    
    <p>
        <?= nl2br(htmlspecialchars($data['content'])) ?></br>
        <a href="post.php?id=<?= $data['id'] ?>">Commentaires</a>
    </p>
</div>

<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>