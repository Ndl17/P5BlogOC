<?php
/*fonction pour récupérer les information des commentaires publiés,
 en fonction de l'id de l'article de la page visionnée*/
function getComments($identifier) {

	$database = dbCommentConnect();
	$statement = $database->prepare(
		"SELECT iduser.pseudo, comment.contentCom, comment.dateComment FROM iduser INNER JOIN comment ON iduser.id_user = comment.author_id WHERE comment.article_id = ? AND comment.isChecked != 0 "
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


	function createComment(string $articles, string $comment)
	{

		$date=date("Y-m-d H:i:s");
		$database = dbCommentConnect();
		$statement = $database->prepare(
	    	'INSERT INTO comment(contentCom, dateComment, author_id, article_id) VALUES(?, ?, ?, ?)'
		);
		$affectedLines = $statement->execute([$comment, $date, $_SESSION["userId"], $articles]);

		return ($affectedLines > 0);
	}


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
