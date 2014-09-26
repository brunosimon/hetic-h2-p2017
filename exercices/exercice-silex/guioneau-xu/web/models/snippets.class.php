<?php

class Snippets_Model
{
	function __construct($pdo){
		$this->pdo = $pdo;
	}

	function get_by_page($page = 1, $limit = 4){ // Show 4 snippets per page
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

	function get_by_category_slug($slug){ // Show snippets from 1 category slug

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

	function get_pages($current = 1, $limit = 4){ // Count number of pages

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

    function get_pages_categories($slug, $current = 1, $limit = 4){ // Count number of pages for each categories

        $prepare = $this->pdo->prepare('
        	SELECT 
        		COUNT(*) AS count 
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
        $result = $prepare->fetch();

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

    function get_categories(){ // Get datas from categories

        $query  = $this->pdo->query('SELECT * FROM categories');
        $results = $query->fetchAll();

        return $results;
    }

    function add($data){ // Insert values from the proposition of snippet

    	$prepare = $this->pdo->prepare('INSERT INTO snippets (id_category,title,content) VALUES (:category,:name,:content)');
        $prepare->bindValue(':name',$data['name']);
        $prepare->bindValue(':content',$data['content']);
        $prepare->bindValue(':category',$data['category']);
        $exec = $prepare->execute();
    }

}