<?php 

/**
	* Snippets Models
	*/

	//Gestion des fonctions concernant les snippets

class Snippets_Model
{

	function __construct($pdo)
	{
		$this->pdo = $pdo;
		//instance $pdo = $this
		//objet

	}

	//renvoie et stocke dans 'snippets' => $snippets_model->get() dans index.php
	function get()
	{
		return $this->get_by_page();	//ce qui est renvoyé par get_by_page est renvoyé
	}


	function get_by_page($page = 1, $limit = 4)
	{
		$start = ($page - 1) * $limit;

		//on initialise la requête
		$prepare = $this->pdo->prepare('
				SELECT
					s.id,
					s.title,
					s.content,
					c.title AS category_title,
					c.slug  AS category_slug
				FROM
					snippets AS s
				LEFT JOIN
					categories AS c
				ON 
					s.id_category = c.id
				LIMIT :start,:limit
			'); 

		$prepare->bindValue('start',$start,PDO::PARAM_INT); //spécifier le type, ici entier
		$prepare->bindValue('limit',$limit,PDO::PARAM_INT);
		$prepare->execute(); // on execute la requete
		$results = $prepare->fetchAll(); //on récupère les resultats

		return $results;

	}

	function get_by_category_slug($slug)
	{

		$prepare = $this->pdo->prepare('
				SELECT
					s.id,
					s.title,
					s.content,
					c.title AS category_title,
					c.slug  AS category_slug
				FROM
					snippets AS s
				LEFT JOIN
					categories AS c
				ON 
					s.id_category = c.id
				WHERE
					c.slug = :slug
			'); //on initialise la requête

		$prepare->bindValue('slug',$slug);
		$prepare->execute(); // on execute la requete
		$results = $prepare->fetchAll(); //on récupère les resultats

		return $results;
	}

	function get_pages($current = 1, $limit = 4){

		$query  = $this->pdo->query('SELECT COUNT(*) AS count FROM snippets');
        $result = $query->fetch();
        $count  = ceil($result['count'] / $limit);
        $pages  = array();

        for($i = 1; $i <= $count; $i++)
        {
            $pages[] = array(
                'number'  => $i,
                'current' => $current == $i
            );
        }

  	     return $pages;
	}

	// Cette fonction récupère le nom des catégories 
	function get_categories()
	{

		$prepare = $this->pdo->prepare('
				SELECT
					 c.id,
					 c.title,
					 c.slug,
					 COUNT(s.id_category) AS total_snippets
				FROM
					categories AS c
				LEFT JOIN
					snippets   AS s
				ON
					s.id_category = c.id
				GROUP BY
					s.id_category
			'); 

		$prepare->execute(); 
		$categories_results = $prepare->fetchAll(); 

		return $categories_results;
	}

	//Ajouter catégories à la BDD
	function add_category($addCategory,$slug)
	{

		$query = $this->pdo->prepare("
			INSERT INTO 
				categories
			VALUES
				(
					NULL,
					:slug,
					:newCategory
				)
		");

		$query->bindvalue('slug', $slug, PDO::PARAM_STR);
		$query->bindvalue('newCategory', $addCategory, PDO::PARAM_STR); 
		$query->execute();		
	}


}