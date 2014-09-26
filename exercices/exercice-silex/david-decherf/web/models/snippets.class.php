<?php 
/**
* Snippets Model
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

	function get_by_page($page = 1, $limit = 4)
	{
		$start = ($page - 1) * $limit;

		$prepare = $this->pdo->prepare('SELECT
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
				c.slug  AS category_slug
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

    function add($data)
    {
    	$prepare = $this->pdo->prepare('INSERT INTO contact VALUES (null,:name,:email,:message)');
    	$prepare->bindValue(':name',$data["name"]);
    	$prepare->bindValue(':email',$data["email"]);
		$prepare->bindValue(':message',$data["message"]);

    	$prepare->execute();

    }

        function addsnippets($data)
    {
    	$prepare = $this->pdo->prepare('INSERT INTO snippets (id_category, title, content) VALUES (:id,:title,:content)');
    	$prepare->bindValue(':id',1);
    	$prepare->bindValue(':title',$data['title']);
    	$prepare->bindValue(':content',$data['snippets']);

    	$prepare->execute();
    }

    	function get_category() 
    {
    	$query = $this->pdo->query('SELECT * FROM categories');
    	return $query->fetchAll();
    }
}