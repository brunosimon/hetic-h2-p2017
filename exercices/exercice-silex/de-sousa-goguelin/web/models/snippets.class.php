<?php

/**
*Snippets Model
*/

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

	function get_by_page($page = 1, $limit = 2)	
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
			ON s.id_category = c.id 
			ORDER BY
				s.id DESC
			LIMIT :start,:limit
		');
		
		$prepare->bindValue(':start', $start, PDO::PARAM_INT);
		$prepare->bindValue(':limit', $limit, PDO::PARAM_INT);
		$prepare->execute();
		$results = $prepare->fetchAll();

		return $results;
	}

	function get_by_category_slug($slug,$page = 1, $limit = 2)
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
			ON s.id_category = c.id
			WHERE
				c.slug = :slug
			ORDER BY
				s.id DESC
			LIMIT :start,:limit
		');
		$prepare->bindValue(':slug', $slug);
		$prepare->bindValue(':start', $start, PDO::PARAM_INT);
		$prepare->bindValue(':limit', $limit, PDO::PARAM_INT);
		$prepare->execute();
		$results = $prepare->fetchAll();

		return $results;
	}


	/* Pagination snippets */
	function get_pages($current = 1, $limit = 2)
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


    
    /* Categories snippets */
    function get_pages_category($current = 1, $category = '', $limit = 2)
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


    /* Envoi mail BDD */
    function add($data)
    {
    	$prepare = $this->pdo->prepare('INSERT INTO contact VALUES (null,:name,:email,:message)');
    	$prepare->bindValue(':name',$data["name"]);
    	$prepare->bindValue(':email',$data["email"]);
		$prepare->bindValue(':message',$data["message"]);
    	$prepare->execute();

    }


    /* Envoi nouvelle snippet BDD */
    function add_snip($snip)
    {
    	$prepare = $this->pdo->prepare('INSERT INTO snippets VALUES (null, :idcat, :title, :content)');

    	$prepare->bindvalue(':title', $snip["title"]);
    	$prepare->bindvalue(':idcat', $snip["category"]);
    	$prepare->bindvalue(':content', $snip["content"]);

    	$prepare->execute();

    	die('ok');
    }

    function get_about($about)
    {
      
    }
    
}


?>