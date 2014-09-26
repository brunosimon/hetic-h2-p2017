<?php 

class Bookmarks_Model
{
	function	__construct($pdo)
	{
		//L'instance This fait référence à toute la classe Snippets_Model.
		$this->pdo = $pdo;
	}

	function get()
	{
		return $this->get_by_page();
	}

	function get_by_page($page = 1, $limit = 4)
	{
		
		//Variable qui nous permet de définir quelle page on veut afficher. A partir de telle $page tu affiches les pages jusqu'à une $limit
		$start = ($page - 1) * $limit;

		$prepare = $this->pdo->prepare('
			SELECT
				b.id,
				b.url,
				b.description,
				c.title AS category_title,
				c.slug AS category_slug
			FROM
				bookmarks AS b
			LEFT JOIN
				categories AS c
			ON
				b.id_category = c.id
			ORDER BY 
				b.id DESC
			LIMIT :start,:limit 
		');
		$prepare->bindValue(':start',$start,PDO::PARAM_INT);
		$prepare->bindValue(':limit',$limit,PDO::PARAM_INT);
		$prepare->execute();
		$results = $prepare->fetchAll();

		//Le return renvoie juste les données. Elles sont prêtes à être affichées.
		return $results;

		//Ce que nous souhaitions faire pour My Bookmark Manager :
		//Je veux afficher 6 catégories par page au maximum, (sous forme de div comme on a actuellement en statique) avec un lien qui pointe vers la bonne catégorie.
		// Il faut un système qui associe chaque div générée avec un id (pour générer le bon nombre de div) et également avec son slug (pour le bon lien sur la div) et son title (pour le bon nom dans le h5)

		//idée hier soir tard de requete SQL : 
		//$preparation->pdo->prepare('
		//		SELECT * FROM categories BY id 
		//	');
	}

	function get_by_category_slug($slug)
	{
		$prepare = $this->pdo->prepare('
			SELECT
				b.id,
				b.url,
				b.description,
				c.title AS category_title,
				c.slug AS category_slug
			FROM
				bookmarks AS b
			LEFT JOIN
				categories AS c
			ON
				b.id_category = c.id
			WHERE
				c.title = :slug
			ORDER BY 
				b.id DESC
		');

		$prepare->bindValue(':slug',$slug);
		$prepare->execute();
		$results = $prepare->fetchAll();

		return $results;
	}

    function get_pages($current = 1, $limit = 4)
    {
        $query  = $this->pdo->query('SELECT COUNT(*) AS count FROM bookmarks');
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
}

 ?>