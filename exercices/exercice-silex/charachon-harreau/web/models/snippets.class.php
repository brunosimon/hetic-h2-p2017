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

	function get_by_page($page = 1,$limit = 4)
	{
		$start = ($page - 1) * $limit;
		$prepare = $this->pdo->prepare('
			SELECT
				s.id,
				s.title,
				s.content,
				s.state,
				c.title AS category_title,
				c.slug AS category_slug
			FROM
				snippets AS s 
			LEFT JOIN 
				categories AS c
			ON 
				s.id_category = c.id
			WHERE
				s.state = 1
			ORDER BY
				s.id DESC
			LIMIT 
				:start,:limit
		');
		$prepare->bindValue(':start',$start,PDO::PARAM_INT);
		$prepare->bindValue(':limit',$limit,PDO::PARAM_INT);
		$prepare->execute();
		$results = $prepare->fetchAll();

		return $results;

	}

	function get_by_category_slug($slug, $page = 1, $limit = 4)
	{
		$start = ($page - 1) * $limit;

		$prepare = $this->pdo->prepare('
			SELECT
				s.id,
				s.title,
				s.content,
				s.state,
				c.title AS category_title,
				c.slug AS category_slug
			FROM
				snippets AS s 
			LEFT JOIN 
				categories AS c
			ON 
				s.id_category = c.id
			WHERE 
				c.slug = :slug AND s.state = 1
			ORDER BY
				s.id DESC
			LIMIT 
				:start,:limit
		');
		$prepare->bindValue(':slug', $slug);
		$prepare->bindValue(':start',$start,PDO::PARAM_INT);
		$prepare->bindValue(':limit',$limit,PDO::PARAM_INT);
		$prepare->execute();
		$results = $prepare->fetchAll();

		return $results;

	}

	// Pagination
	function get_pages($current = 1, $limit = 4)
    {
        $query  = $this->pdo->query('SELECT COUNT(*) AS count FROM snippets WHERE state = 1');
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


    function get_all_categories()
	{

		$prepare = $this->pdo->prepare('
			SELECT
				c.title AS category_title,
				c.slug AS category_slug
			FROM
				categories AS c
		');
		$prepare->execute();
		$results = $prepare->fetchAll();

		return $results;
	}

	/* Categories snippets */
    function get_pages_category($current = 1, $category = '', $limit = 2)
    {
    	$prepare  = $this->pdo->prepare('SELECT * FROM categories WHERE slug = :slug');
    	$prepare->bindValue(':slug',$category);
    	$prepare->execute();
    	$_category = $prepare->fetch();

    	$query  = $this->pdo->query('SELECT COUNT(*) AS count FROM snippets WHERE state = 1 AND id_category = '.$_category['id']);
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

    function get_all_post()
    {
		$prepare = $this->pdo->prepare('
			SELECT
				s.id,
				s.title,
				s.content,
				s.state,
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
		');
		$prepare->execute();
		$results = $prepare->fetchAll();

		return $results;
    }

    function action_admin()
    {
    	$id = (int)$_GET['id'];
    	$action = $_GET['action'];

		// Test if ID well received
		if($id !== 0)
		{

			switch ($action) {
				// Delete an existing todo
				case 'delete':
					$sql = 'DELETE FROM snippets WHERE id = :id';
					break;
				
				// Mark as done an existing todo
				case 'validate':
					$sql = 'UPDATE snippets SET state = 1 WHERE id = :id';
					break;

				// Mark as undone an existing todo
				case 'unvalidate':
					$sql = 'UPDATE snippets SET state = 0 WHERE id = :id';
					break;
			}

			$prepare = $this->pdo->prepare($sql);
			$prepare->bindValue(':id',$id);
			$prepare->execute();
		}
    }

    function grostest(){
    	echo "CA MARCHE";
    }

}

?>