<?php

//fonction pour récupérer tout la liste des articles
function getArticle(){

	$database = dbConnect();

	// On récupère tout le contenu de la table article
	$statement = $database->query( "SELECT * FROM article  ORDER BY date DESC");

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
		"SELECT * FROM article WHERE id_article = ? "
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
	$database = dbConnect();
	$statement = $database->prepare(
		'INSERT INTO article(title, content, date, chapo, author_id) VALUES(?, ?, ?, ? ,?)'
	);
	$affectedLines = $statement->execute([$title, $content,$date,$chapo, $_SESSION["userId"]]);

	return ($affectedLines > 0);
}



function updateArticle($idArticle,$title,$chapo,$content,$author)
{
	$date=date("Y-m-d H:i:s");
	$database = dbConnect();
	$statement = $database->prepare(
		"UPDATE article SET title='$title', content='$content', date='$date', chapo='$chapo', author_id='$author' WHERE id_article = '$idArticle' "
	);
	$statement->execute();

	return $statement;

}



function deleteArticle($identifier){

	$database = dbConnect();
	$statement = $database->prepare(
		"DELETE FROM article WHERE id_article = ? "
	);
	$statement->execute([$identifier]);
}



function getArticleAuthor($identifier){
	$database = dbConnect();
	// On récupère tout le contenu de la table article
	$statementidAuthor = $database->query( "SELECT author_id	FROM article WHERE id_article = '$identifier'");
	//	INNER JOIN article ON iduser.id_user = article.author_id WHERE article.author_id != '$identifier' "

	$statementidAuthor->execute([$identifier]);
	$idAuthor=[];
	$row = $statementidAuthor->fetch();
	$idAuthor = [
		'idAuthor' => $row['author_id'],
	];
	$idAuthors=$idAuthor['idAuthor'];


	$statement = $database->query( "SELECT pseudo, id_user  FROM iduser WHERE id_user ='$idAuthors' ");

	$authorArticle =[];
	while(($row = $statement->fetch())){
		$authorArticle =[
			'pseudo' => $row["pseudo"],
			'id' => $row["id_user"],
		];
		$authorArticles[] = $authorArticle;
	}


	return $authorArticles;


}


function getUserList($identifier){
	$database = dbConnect();

	// On récupère tout le contenu de la table article
	$statementidAuthor = $database->query( "SELECT author_id	FROM article WHERE id_article = '$identifier'");
	//	INNER JOIN article ON iduser.id_user = article.author_id WHERE article.author_id != '$identifier' "

	$statementidAuthor->execute([$identifier]);
	$idAuthor=[];
	$row = $statementidAuthor->fetch();
	$idAuthor = [
		'idAuthor' => $row['author_id'],
	];
	$idAuthors=$idAuthor['idAuthor'];


	$statement = $database->query( "SELECT pseudo, id_user FROM iduser WHERE id_user !='$idAuthors' ");

	$userPseudo =[];
	while(($row = $statement->fetch())){
		$userPseudo =[
			'pseudo' => $row["pseudo"],
				'id' => $row["id_user"],
		];
		$userPseudos[] = $userPseudo;
	}


	return $userPseudos;
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
