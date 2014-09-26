<?php
/**
* Snippets_Model
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
	
	function get_by_page($page = 1, $limit=4)
	{
		$start = ($page - 1) * $limit;	

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
			LIMIT :start,:limit
		');
		$prepare->bindValue('start', $start,PDO::PARAM_INT);
		$prepare->bindValue('limit', $limit,PDO::PARAM_INT);
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
		');

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
     
    function get_by_categories()
    {
     	$prepare = $this->pdo->prepare('
     		SELECT
     			*
			FROM
				categories

		');
		
     	$prepare->execute();
		$results = $prepare->fetchAll();
		return $results;

	 }

	 function post_snippet($form)
	 {

	 	if (!empty($form['title']) && !empty($form['category']) && !empty($form['content']))
	 	{
	 		$prepare = $this->pdo->prepare('
     		INSERT INTO
     			snippets(id_category, title, content)
			VALUE
				(:id, :name, :content)
			');
			
			$prepare->bindValue('name', $form['title'], PDO::PARAM_STR);
			$prepare->bindValue('id', $form['category'], PDO::PARAM_STR);
			$prepare->bindValue('content', $form['content'], PDO::PARAM_STR);
			$prepare->execute();

			return 'success';
	 	}

	 	else
	 	{
	 		return 'NON';
	 	}

	 	
	 }  
}







