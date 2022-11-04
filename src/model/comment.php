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
	$isChecked = 0;
	$date=date("Y-m-d H:i:s");
	$database = dbCommentConnect();
	$statement = $database->prepare(
		'INSERT INTO comment(contentCom, dateComment, isChecked,author_id, article_id) VALUES(?, ?, ?, ?, ?)'
	);
	$affectedLines = $statement->execute([$comment, $date, $isChecked, $_SESSION["userId"], $articles]);

	return ($affectedLines > 0);
}


function getUnCheckedComments() {

	$database = dbCommentConnect();
	$statement = $database->query(

		"SELECT iduser.pseudo, comment.contentCom, comment.dateComment, article.title, article.id_article, comment.id
		FROM iduser
		INNER JOIN comment ON iduser.id_user = comment.author_id
		INNER JOIN article ON article.id_article = comment.article_id
		WHERE comment.isChecked = 0 "
	);


	$commentUnCheckeds=[];
	while(($row = $statement->fetch())){

		$commentUnChecked = [
			'contentCom' => $row['contentCom'],
			'dateComment' =>$row['dateComment'],
			'pseudo' => $row['pseudo'],
			'titreArticle' => $row['title'],
			'idArticle' => $row['id_article'],
			'idComment'=> $row['id']
		];
		$commentUnCheckeds[] = $commentUnChecked;
	}

	return $commentUnCheckeds;
}


function validateComment($identifier) {

	$database = dbCommentConnect();
	$statement = $database->prepare(
		"UPDATE comment SET isChecked=1  WHERE id = ? "
	);

	$statement->execute([$identifier]);

}


function deleteComment($identifier) {

	$database = dbConnect();
	$statement = $database->prepare(
				"DELETE FROM comment WHERE id = ? "
	);
	$statement->execute([$identifier]);

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
