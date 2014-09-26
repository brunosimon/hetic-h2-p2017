<?php

	/* Snippets Model*/

	class Snippets_Model{
		function __construct($pdo){
			/*this c'est l'instance */
			$this->pdo = $pdo;
		}
		/*Récupère les 4 premiers snippets*/
		function get(){
			/*pas de paramètre car il y en a déjà par défaut */
			return $this->get_by_page();
		}
		/*Rappelée sur toutes les pages*/
		function get_by_page($page = 1, $limit = 4){
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
					ORDER BY s.id DESC
					LIMIT :start,:limit
			');
			$prepare->bindValue(':start',$start,PDO::PARAM_INT);
			$prepare->bindValue(':limit',$limit,PDO::PARAM_INT);
			$prepare->execute();
			$results = $prepare->fetchAll();

			return $results;
		}
		/*Appelle les snippets de telle catégorie*/
		function get_by_category_slug($slug){
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

		/*Retourne un tableau de tableaux des pages*/
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

	    function get_categories()
    	{
    		$query  = $this->pdo->query('SELECT * FROM categories');
	        $results = $query->fetchAll();

	        return $results;
    	}

	    function add_snippet($title,$id_category,$content){
			$prepare = $this->pdo->prepare('INSERT INTO snippets (id_category,title,content) VALUES (:id_category,:title,:content)');
			$prepare->bindValue(':id_category', $id_category);
			$prepare->bindValue(':title', $title);
			$prepare->bindValue(':content', $content);

			$exec = $prepare->execute();
		}
	}
