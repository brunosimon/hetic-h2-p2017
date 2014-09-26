<?php

/**
*Snippets Model
*/

class Snippets_Model
{
	function __construct($pdo){ //appelé lors de la créaion du model
		$this->pdo = $pdo;
	}
	function get(){ //method : je l'appel pour le stocker dans le snippet
		return $this->get_by_page();
	}
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
				LIMIT :start,:limit 
			'); // LIMIT index,quantité
		$prepare->bindValue('start',$start,PDO::PARAM_INT);
		$prepare->bindValue('limit',$limit,PDO::PARAM_INT);
		$prepare->execute();
		$results = $prepare->fetchAll();

		return $results;
	}

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
				
			'); // LIMIT index,quantité
		
		$prepare->bindValue('slug',$slug);
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

    function get_pages_category($current = 1, $category = '', $limit = 4)
    {
    	$prepare  = $this->pdo->prepare('SELECT * FROM categories WHERE slug = :slug');
    	$prepare->bindValue(':slug',$category);
    	$prepare->execute();
    	$_category = $prepare->fetch();

    	$query  = $this->pdo->query('SELECT COUNT(*) AS count FROM snippets WHERE id_category = '.$_category['id']);
        $result = $query->fetch();
        $count  = ceil($result['count'] / $limit);
        $pages  = array();

        for($i = 1; $i <= $count; $i++)
        {
            $pages[] = array(
                'category' => $category,
                'number'   => $i,
                'current'  => $current == $i
            );
        }

        return $pages;
    }
                       

    function add($data)
    {
    	$prepare = $this->pdo->prepare('INSERT INTO contact VALUES (null,:nom,:email,:contenu)');
    	$prepare->bindValue(':nom',$data["nom"]);
    	$prepare->bindValue(':email',$data["email"]);
		$prepare->bindValue(':contenu',$data["contenu"]);

    	$prepare->execute();

    }

    function new_snippet($title,$category,$content){
		$prepare = $this->pdo->prepare('INSERT INTO snippets (id_category, title, content) VALUES (:id,:title,:content)');
		$prepare->bindValue(':id',$category,PDO::PARAM_INT);
		$prepare->bindValue(':title',$title,PDO::PARAM_STR);
		$prepare->bindValue(':content',$content,PDO::PARAM_STR);
		$prepare->execute();
	}



}