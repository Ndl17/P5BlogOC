<?php
/*fonction pour récupérer les information des commentaires publiés,
 en fonction de l'id de l'article de la page visionnée*/
function getComments($identifier) {

	$database = dbCommentConnect();
	$statement = $database->prepare(
		"SELECT iduser.pseudo, comment.contentCom, comment.dateComment FROM iduser INNER JOIN comment ON iduser.id_user = comment.author_id WHERE comment.article_id = ? "
	);

	$statement->execute([$identifier]);
	$commentId=[];
	while(($row = $statement->fetch())){

	$commentIds = [
		'contentCom' => $row['contentCom'],
		'dateComment' =>$row['dateComment'],
		'pseudo' => $row['pseudo'],
	];
			$commentId[] = $commentIds;
}

		return $commentId;
	}

/*
	function createComment(string $articles, string $author, string $comment)
	{
		$database = dbCommentConnect();
		$statement = $database->prepare(
	    	'INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())'
		);
		$affectedLines = $statement->execute([$post, $author, $comment]);

		return ($affectedLines > 0);
	}
*/

// fonction pour se connecter à la base MySQL
function dbCommentConnect()
{
	try {
		$database = new PDO(
			'mysql:host=localhost;dbname=blog_oc;charset=utf8',
			'root',
			'',
			[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
		);

		return $database;
	} catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}
}
