<?php
	class Cake_Model
	{
		function __construct($pdo)
		{
			$this->pdo = $pdo;
		}

		function get()
		{
			return $this->get_by_page();
		}



		function get_by_page($page = 1, $limit = 5)
		{
			$start = ($page - 1) * $limit;

			$prepare = $this->pdo->prepare('
				SELECT
					cak.id,
					cak.title,
					cak.content,
					cat.title AS category_title,
					cat.slug AS category_slug
				FROM
					cakes AS cak
				LEFT JOIN
					categories AS cat
				ON
					cak.id_category = cat.id
				ORDER BY
					cak.id DESC
				LIMIT :start, :limit

			');

			$prepare->bindValue(':start', $start,PDO::PARAM_INT);
			$prepare->bindValue(':limit', $limit,PDO::PARAM_INT);
			$prepare->execute();
			$results = $prepare->fetchAll();

			return $results;


		}

		function get_pages($current = 1, $limit = 5)
    	{
	        $query  = $this->pdo->query('SELECT COUNT(*) AS count FROM cakes');
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


		function get_by_category_slug($slug)
		{

			$prepare = $this->pdo->prepare('
				SELECT
					cak.id,
					cak.title,
					cak.content,
					cak.img_url,
					cat.title AS category_title,
					cat.slug AS category_slug
				FROM
					cakes AS cak
				LEFT JOIN
					categories AS cat
				ON
					cak.id_category = cat.id
				WHERE
					cat.slug = :slug
				ORDER BY
					cak.id DESC
			');

			$prepare->bindValue(':slug', $slug);
			$prepare->execute();
			$results = $prepare->fetchAll();

			return $results;

		}
		function add_cake($name,$categorie,$description/*,$url*/){
			$prepare = $this->pdo->prepare('INSERT INTO cakes (id_category,title,content) VALUES (:id_category,:title,:content)');
			$prepare->bindValue(':id_category', $categorie);
			$prepare->bindValue(':title', $name);
			$prepare->bindValue(':content', $description);
			// $prepare->bindValue(':img_url', $url);


			$exec = $prepare->execute();
		}
	}

 ?>
