<?php 

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

	function get_by_page($page = 1,$limit=4)
	{
		$start = ($page - 1) * $limit;

		$prepare = $this->pdo->prepare('
			SELECT
				s.id,
				s.nom,
				s.img,
				c.nom AS category_title,
				c.slug AS category_slug
			FROM
				circuits AS s 
			LEFT JOIN 
				consoles AS c
			ON 
				s.id_console = c.id
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
				s.nom,
				s.img,
				c.nom AS category_title,
				c.slug AS category_slug
			FROM
				circuits AS s 
			LEFT JOIN 
				consoles AS c
			ON 
				s.id_console = c.id
			WHERE 
				c.slug = :slug
			ORDER BY
				s.id DESC
		');
		$prepare->bindValue(':slug', $slug);
		$prepare->execute();
		$results = $prepare->fetchAll();

		return $results;
	}
}

?>