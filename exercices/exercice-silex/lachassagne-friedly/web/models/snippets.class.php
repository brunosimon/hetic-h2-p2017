<?php

/**
* SNIPPETS
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
		// Start / Limit
		$page  = $page - 1;
		$start = $page * $limit;

		// SQL
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
			LIMIT
				:start,:limit
		');

		// Bind values
		$prepare->bindValue('start',$start,PDO::PARAM_INT);
		$prepare->bindValue('limit',$limit,PDO::PARAM_INT);

		// Execute
		$prepare->execute();

		// Return
		return $prepare->fetchAll();
	}

	function get_by_category_slug($slug, $limit = 4,$page)
	{

		$page  = $page - 1;
		$start = $page * $limit;
		// SQL
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
			LIMIT
				:start, :limit
		');

		// Bind values
		$prepare->bindValue('slug',$slug,PDO::PARAM_INT);
		$prepare->bindValue('start',$start,PDO::PARAM_INT);
		$prepare->bindValue('limit',$limit,PDO::PARAM_INT);

		// Execute
		$prepare->execute();

		// Return
		return $prepare->fetchAll();
	}

	function get_by_id($id)
	{
		$prepare = $this->pdo->prepare(' SELECT * FROM snippets WHERE id = :id');

		// Bind values
		$prepare->bindValue(':id',$id,PDO::PARAM_INT);

		// Execute
		$prepare->execute();

		// Return
		return $prepare->fetch();
	}

	function get_pages($current = 1, $limit = 4, $category)
	{

		if(isset($category)) {
			$prepare = $this->pdo->prepare('SELECT id FROM categories WHERE slug = :slug');
			$prepare->bindValue(':slug',$category,PDO::PARAM_STR);
			$prepare->execute();
			$id = $prepare->fetch();

			//Bind Values
			
			$prepare = $this->pdo->prepare('SELECT COUNT(*) AS count FROM snippets WHERE id_category = :id');
			$prepare->bindValue(':id',$id['id'],PDO::PARAM_STR);
			$prepare->execute();
			$result = $prepare->fetch();
			$count  = ceil($result['count'] / $limit);
			$pages  = array();

			for($i = 1; $i <= $count; $i++)
			{
				$pages[] = array(
					'number'  => $i,
					'current' => $i == $current
				);
			}

			return $pages;
		}
	}

	function get_categories()
	{
		$query  = $this->pdo->query('SELECT * FROM categories');
		return $query->fetchAll();
	}

	function update_count(){

		//initiate
		$query = $this->pdo->query('UPDATE categories SET count = 0');

		//count
		$prepare = $this->pdo->prepare('SELECT * FROM snippets');
		$prepare->execute();
		$snippets = $prepare->fetchAll();

		foreach ($snippets as $key => $value) {
			$prepare = $this->pdo->prepare('UPDATE categories SET count = count + 1 where id = :id');
			$prepare->bindValue(':id',$value['id_category']);
			$prepare->execute();
			$prepare->fetchAll(); 
		}
	}

	function new_snippet($title,$category,$content,$id_sender){
		$prepare = $this->pdo->prepare('INSERT INTO snippets (id_category, title, content, down, id_sender) VALUES (:id,:title,:content, :down, :id_sender)');
		$prepare->bindValue(':id',$category,PDO::PARAM_INT);
		$prepare->bindValue(':title',$title,PDO::PARAM_STR);
		$prepare->bindValue(':content',$content,PDO::PARAM_STR);
		$prepare->bindValue(':down',str_replace(' ', '', $title));
		$prepare->bindValue(':id_sender',$id_sender,PDO::PARAM_INT);

		$prepare->execute();
	}

	function delete_snippet($id, $user_id){
		$prepare = $this->pdo->prepare('SELECT * FROM snippets WHERE id = :id');
		$prepare->bindValue(':id', $id, PDO::PARAM_INT);
		$prepare->execute();

		$result = $prepare->fetch();

		if($result['id_sender'] == $user_id) {
			$prepare = $this->pdo->prepare('DELETE FROM snippets WHERE id = :id');
			$prepare->bindValue(':id', $id, PDO::PARAM_INT);
			$prepare->execute();
		} 
	}

	function update_snippet($title, $category, $content){
		$prepare = $this->pdo->prepare('UPDATE snippets SET title = :title, id_category = :id, content = :content, down = :down');
		$prepare->bindValue(':id',$category,PDO::PARAM_INT);
		$prepare->bindValue(':title',$title,PDO::PARAM_STR);
		$prepare->bindValue(':content',$content,PDO::PARAM_STR);
		$prepare->bindValue(':down',str_replace(' ', '', $title));
		$prepare->execute();
	}
}
