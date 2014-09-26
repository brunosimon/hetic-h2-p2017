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
		$prepare->bindValue(':start',$start, PDO::PARAM_INT);
		$prepare->bindValue(':limit',$limit, PDO::PARAM_INT);
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
		$prepare->bindValue(':slug', $slug);
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


	function check($data)
	{
		$errors = array();

		// test si pas de name
		if(empty($data['name']))
			$errors[] = 'Empty name';

		// test si pas de message
		if(empty($data['message']))
			$errors[] = 'Empty message';

		// test si category egal 0 (car transformé en entier dans sanetize)
		if($data['category'] == 0)
			$errors[] = 'Wrong category';

		return $errors;
	}

	function sanetize($data)
	{
		$data['name']     = strip_tags(trim($data['name']));
		$data['category'] = (int)$data['category']; // On transform en int
		$data['message']  = strip_tags(trim($data['message']));
		return $data;
	}

	// tentative d'ajout du snippet créer

	function add_snippet($data)
	{
		if(!empty($data))
		{
			// N'oubliez pas le $this->
			$data	= $this->sanetize($data);
			$errors	= $this->check($data);

			if(empty($errors))
			{
				// prIpare ???
				// Voila comment utiliser le prepare
				$prepare = $this->pdo->prepare('
					INSERT INTO
						snippets (id_category,title,content)
					VALUES
						(:id_category,:title,:content)
				');
				$prepare->bindValue('id_category',$data['category']); // Attention : Dans votre formulaire c'est "category" mais dans la BDD c'est "id_category"
				$prepare->bindValue('title',$data['name']);           // Attention : Dans votre formulaire c'est "name" mais dans la BDD c'est "title"
				$prepare->bindValue('content',$data['message']);      // Attention : Dans votre formulaire c'est "message" mais dans la BDD c'est "content"
				$prepare->execute();

				echo "<pre>";
				print_r($data);
				echo "</pre>";
				echo "<pre>";
				print_r($prepare);
				echo "</pre>";
				exit;

				$success[] = 'Well done';
			}
		}

		return $errors;
	}

}
