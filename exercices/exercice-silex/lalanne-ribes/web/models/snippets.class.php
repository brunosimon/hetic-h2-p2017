<?php 

// Snippets Model
class Snippets_Model
{
	function __construct($pdo) 
	{
		$this->pdo = $pdo; 
	}

	function get() 
	{
		return $this->get_by_page();
	}

	function get_by_page($page = 1, $limit = 4) 
	{
		$start = ($page - 1) * $limit; 

		$prepare = $this->pdo->prepare('
			SELECT
				s.id,
				s.title,
				s.content,
				c.title AS category_title,
				c.slug AS category_slug
			FROM
				snippets AS s
			LEFT JOIN
				categories AS c
			ON
				s.id_category = c.id
			ORDER BY
				s.id DESC
			LIMIT :start,:limit
		');
		
		$prepare->bindValue(':start',$start,PDO::PARAM_INT);
		$prepare->bindValue(':limit',$limit,PDO::PARAM_INT);
		$prepare->execute();
		$results = $prepare->fetchAll();

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
				c.slug AS category_slug
			FROM
				snippets AS s
			LEFT JOIN
				categories AS c
			ON
				s.id_category = c.id
			WHERE
				c.slug = :slug
			ORDER BY
				s.id DESC
		');
	
		$prepare->bindValue(':slug',$slug);
		$prepare->execute();
		$results = $prepare->fetchAll();

		return $results;	
	}

	function get_pages($current = 1, $limit = 4)
	{
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

	function sanetize($data)
	{
		$data['content'] = strip_tags(trim($data['content']));

		return $data;
	}

	// formulaire
	function ajout($data) 
	{
		$title = $_POST['title'];
		$content = $_POST['content'];
		$category = $_POST['category'];


		// NOUS AVONS VOULU ESSAYER L'AJOUT DE CATEGORIES, CEPENDANT NOUS N'AVONS PAS SU AJOUTER LA CATEGORIE DANS LE SLUG ET DANS LE TITLE DE LA TABLE CATEGORIES
		// $prepare = $this->pdo->prepare('INSERT INTO categories (slug,title) VALUES (:slug,:title)');
		// $prepare->bindValue(':title',$title);
		// $prepare->bindValue(':slug',$slug);
		// $exec = $prepare->execute();


		$prepare = $this->pdo->prepare('INSERT INTO snippets (title,content,id_category) VALUES (:title,:content,:category)');
		$prepare->bindValue(':title',$title);
		$prepare->bindValue(':content',$content);
		$prepare->bindValue(':category',$category);
		$exec = $prepare->execute();


	}

	function get_categories()
	{
		$query   = $this->pdo->query('SELECT * FROM categories');
		$results = $query->fetchAll();

		return $results;
	}



	// NOUS AVONS VOULU ESSAYER L'AJOUT DE CATEGORIES, CEPENDANT NOUS N'AVONS PAS SU AJOUTER LA CATEGORIE DANS LE SLUG ET DANS LE TITLE DE LA TABLE CATEGORIES
	// function get_by_category_result($page = 1, $limit = 4) // 4 premiers résultats de la page 1
	// //$limit : combien on en veut, $page : la page
	// {
	// 	$start = ($page - 1) * $limit; // commence a partir du énième snippet

	// 	$prepare = $this->pdo->prepare('
	// 		SELECT
	// 			s.id,
	// 			s.title,
	// 			s.content,
	// 			c.title AS category_title,
	// 			c.slug AS category_slug
	// 		FROM
	// 			categories AS c
	// 		LEFT JOIN
	// 			snippets AS s
	// 		ON
	// 			s.id_category = c.id
	// 		ORDER BY
	// 			s.id DESC
	// 	');
	// 	// LIMIT : pour limiter le nb de résultats par page
	// 	// ORDER BY s.id DESC : pr afficher les dernier ajoutés en premier
	// 	$prepare->execute();
	// 	$category_result = $prepare->fetchAll();

	// 	return $category_result; //renvois ds le controleur ds l'index.php
	// }
}








