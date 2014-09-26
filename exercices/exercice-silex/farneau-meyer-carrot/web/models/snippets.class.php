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

		function get_all($page = 1, $limit = 5)
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
					s.category_id = c.id 
				ORDER BY 
					s.id DESC
				LIMIT :start, :limit 
			');

			$prepare->bindValue(':start', $start, PDO::PARAM_INT);
			$prepare->bindValue(':limit', $limit, PDO::PARAM_INT);
			$prepare->execute();
			$results = $prepare->fetchAll();

			return $results;
		}

		function get_by_category($slug, $page = 1, $limit = 5)
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
					s.category_id = c.id 
				WHERE
					c.slug = :slug
				ORDER BY
					s.id DESC
				LIMIT :start, :limit
			');

			$prepare->bindValue(':start', $start, PDO::PARAM_INT);
			$prepare->bindValue(':limit', $limit, PDO::PARAM_INT);
			$prepare->bindValue(':slug', $slug, PDO::PARAM_INT);
			$prepare->execute();
			$results = $prepare->fetchAll();

			return $results;
		}

		function get_cat_details($cat){

			$prepare = $this->pdo->prepare('
				SELECT
					*
				FROM 
					categories
				WHERE
					slug = :cat
			');

			$prepare->bindValue(':cat', $cat);
			$prepare->execute();
			$results = $prepare->fetchAll();

			$prepare = $this->pdo->prepare('
				SELECT
					COUNT(*)
				FROM 
					snippets
				WHERE
					category_id = :catid
			');

			$prepare->bindValue(':catid',$results[0]['id']);
			$prepare->execute();
			$count = $prepare->fetchAll();

			$results[0]['count']=$count[0]['COUNT(*)'];

			return $results;
		}

		function get_snippets_count(){

			$prepare = $this->pdo->prepare('
				SELECT
					COUNT(*)
				FROM 
					snippets
			');

			$prepare->execute();
			$count = $prepare->fetchAll();

			return $count[0]['COUNT(*)'];
		}

		function get_categories()
		{

			$prepare = $this->pdo->prepare('
				SELECT
					*
				FROM 
					categories
				ORDER BY
					title DESC
			');

			$prepare->execute();
			$results = $prepare->fetchAll();

			return $results;
		}

		function get_pages_all($current = 1, $limit = 5)
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

	    function get_pages_by_category($catid, $current = 1, $limit = 5)
	    {

	    	$prepare = $this->pdo->prepare('SELECT COUNT(*) AS count FROM snippets WHERE category_id = :catid');
  			$prepare->bindValue(':catid', $catid);
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

		function add_snippet($title,$message,$category){
			$prepare = $this->pdo->prepare('INSERT INTO snippets (`id`, `title`, `content`, `category_id`) VALUES (NULL, :title, :message, :category);');
			$prepare->bindValue(':title', $title, PDO::PARAM_INT);
			$prepare->bindValue(':message', $message, PDO::PARAM_INT);
			$prepare->bindValue(':category', $category, PDO::PARAM_INT);
			$prepare->execute();
		}
	}

 ?>