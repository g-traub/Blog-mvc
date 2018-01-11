<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
    <h1>Mon super blog !</h1>
    <p><a href="index.php">Retour à la liste des billets</a></p>

    <div class='news'>
        <h3>
            <?= htmlspecialchars($post['title']); ?>
            <em><?= nl2br(htmlspecialchars($post['date_formate']));?></em>
        </h3>
        <p>
            <?= nl2br(htmlspecialchars($post['content']));?>
        </p>
    </div>

    <div class='comments'>
        <h2>Commentaires</h2>
        <?php
        $data_com = $comments->fetchAll();
        if (empty(data_com))
        {
            echo "<p id='no_com'>Il n'y a pas encore de commentaires sur ce billet!</p>";
        }
        else
        {
            foreach($data_com as $comment)
            {
        ?>        
            <p>
                <strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['date_comment_fr'] ?></p>
            </p>
            <p><?= nl2br(htmlspecialchars($comment['comment']))?></p>
        
        <?php
            }
        }
        ?>
        <?php $content = ob_get_clean(); ?>

        <?php require('template.php'); ?>