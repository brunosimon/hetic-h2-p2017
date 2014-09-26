<?php 

// Snippets model

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

	function get_by_page($page=1, $limit = 4) 
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

	function get_categories()//function to get categories and number of snippets they have each of them
	{
		$prepare = $this->pdo->prepare('
			SELECT 
				c.id,
				c.title,
				c.slug,
				COUNT(s.id_category) AS total_snippets_by_category
			FROM 
				categories AS c
			LEFT JOIN
				snippets AS s
			ON
				s.id_category = c.id
			GROUP BY
				s.id_category
			');
		$prepare->execute();
		$categories_result = $prepare->fetchAll();
		return $categories_result;	
	}

	function get_by_category_slug($slug) //function to get results according one categorie chosen
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

    function add_snippet($data) // function to add snippets in one category
	{
		$category =$data['category'];
		$title = $data['title'];
		$content = $data['content'];

		// insert in snippets table
		$prepare = $this->pdo->prepare("
			INSERT INTO 
			snippets (id_category, title, content) VALUES (:id_category, :title, :content)
			");
		$prepare->bindValue(':id_category', $category);
		$prepare->bindValue(':title', $title);
		$prepare->bindValue(':content', $content);
		$prepare->execute();
	} 


	function add_category($data) // function to add catetegory of snippet
		{
			$add_category = $_POST['add_category'];
			
			if(!empty($add_category))
				{
					$slug = $this->create_url_slug($add_category);

					$prepare = $this->pdo->prepare("
					INSERT INTO 
					categories (slug,title) VALUES (:slug_category,:title_category)
					");
					$prepare->bindValue(':slug_category', $slug);
					$prepare->bindValue(':title_category', $add_category);
					$prepare->execute();
				}
		}

	
	// slugify function (accents, spaces, uppercase)
	function create_url_slug($string){
		$a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð',
                'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã',
                'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ',
                'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ',
                'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę',
                'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī',
                'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ',
                'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ',
                'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 
                'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 
                'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ',
                'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');

  		$b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O',
                'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c',
                'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u',
                'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D',
                'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g',
                'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K',
                'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o',
                'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S',
                's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W',
                'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i',
                'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
		$slug = str_replace($a, $b, $string);
	   	$slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $slug);
	   	$slug = strtolower($slug);
	   	return $slug;
	}
   
}





