<?php

//fonction pour récupérer tout la liste des articles
function getArticle(){

	$database = dbConnect();

	// On récupère tout le contenu de la table article
	$statement = $database->query( "SELECT * FROM article");

	$articles =[];
	while(($row = $statement->fetch())){
		$article =[
			'title' => $row["title"],
			'date' =>$row['date'],
			'content' => $row["content"],
			'chapo' => $row['chapo'],
			'idArticle' =>$row['id_article'],
		];
		$articles[] = $article;
	}


	return $articles;
}

//fonction pour récupérer un article en fonction de l'id de la page
function getArticleId($identifier) {
	$database = dbConnect();

	$statement = $database->prepare(
		"SELECT * FROM article WHERE id_article = ?"
	);
	$statement->execute([$identifier]);

	$row = $statement->fetch();
	$articleId = [
		'title' => $row['title'],
		'date' =>$row['date'],
		'content' => $row["content"],
		'chapo' => $row['chapo'],
		'idArticle' =>$row['id_article'],
	];

	return $articleId;
}



function createArticle(string $title, string $content, string $chapo)
{

	$date=date("Y-m-d H:i:s");
	$database = dbCommentConnect();
	$statement = $database->prepare(
			'INSERT INTO article(title, content, date, chapo, author_id) VALUES(?, ?, ?, ? ,?)'
	);
	$affectedLines = $statement->execute([$title, $content,$date,$chapo, $_SESSION["userId"]]);

	return ($affectedLines > 0);
}

// fonction pour se connecter à la base MySQL
function dbConnect()
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
