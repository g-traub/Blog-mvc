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
        <em><?= htmlspecialchars($data['date_creation_fr']) ?></em>
    </h3>
    
    <p>
        <?= nl2br(htmlspecialchars($data['content'])) ?></br>
        <a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a>
    </p>
</div>

<?php
}
$posts->closeCursor();
?>
<div id='pages'>
    <p>Pages : 
<?php
for($i=1 ; $i <= $nb_pages ; $i++)
{
    if($page_nb == $i)
    {
        echo "<span>$i</span>";
    }
    else
    {
        echo '<a href=\'index.php?action=listPosts&page='.$i.'\'> '.$i.' </a>';
    }
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>