<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
    <h1>Mon super blog !</h1>
    <p><a href="index.php">Retour à la liste des billets</a></p>

    <div class='news'>
        <h3>
            <?= htmlspecialchars($post['title']); ?>
            <em><?= nl2br(htmlspecialchars($post['date_creation_fr']));?></em>
        </h3>
        <p>
            <?= nl2br(htmlspecialchars($post['content']));?>
        </p>
    </div>

    <div class='comments'>
        <h2>Commentaires</h2>
        <form method='post' action='index.php?action=addComment&amp;id=<?= $post['id'] ?>'>
		    <label for='author'>Pseudo :</label>
            <input type='text' id='author' name='author'></br>
			<label for='comment'>Commentaire : </label></br>
			<textarea name='comment' id='comment' rows=6 cols=42 required></textarea></br>	
			<input type='submit' value='Envoyer!'>
		</form>

        <?php
        $data_com = $comments->fetchAll();
        if (empty($data_com))
        {
            echo "<p id='no_com'>Il n'y a pas encore de commentaires sur ce billet!</p>";
        }
        else
        {
            foreach($data_com as $comment)
            {
        ?>        
            <p>
                <strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['date_comment_fr'] ?> (<a href='index.php?action=editComment&amp;commentId=<?=$comment['id']?>&amp;postId=<?=$_GET['id']?>'>edit</a>)
            </p>
            <p><?= nl2br(htmlspecialchars($comment['comment']))?></p>
        
        <?php
            }
        }
        ?>
        <?php $content = ob_get_clean(); ?>

        <?php require('template.php'); ?>