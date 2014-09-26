<?php

	class SnippetsModel{
		function __construct($pdo){
			$this->pdo = $pdo;
		}

		function get(){
			return $this->get_by_page();
		}
		
		function get_by_page($page = 1, $limit = 4){

			$start = ($page - 1) * $limit;
			$prepare = $this->pdo->prepare('
				SELECT
					s.id, 
					s.title,
					s.content,
					c.title AS category_title,
					c.slug AS category_slug,
					c.css_class AS category_class
				FROM
					snippets AS s
				LEFT JOIN
					categories AS c
				ON
					s.id_category = c.id
				LIMIT :start,:limit
			');

			$prepare->bindValue('start', $start, PDO::PARAM_INT);
			$prepare->bindValue('limit', $limit, PDO::PARAM_INT);
			$prepare->execute();
			$results = $prepare->fetchAll();
			
			return $results;
		}

		function get_categories(){

			$query = $this->pdo->query('
				SELECT
					c.id AS catgeory_id,
					c.slug,
					c.title AS category_title,
					c.css_class AS category_class,
					s.title AS snippet_title,
					s.id
				FROM
					categories AS c
				LEFT JOIN
					snippets AS s
				ON
					c.id = s.id_category
				GROUP BY
					category_title
			');

			$results = $query->fetchAll();
			
			return $results;
		}

		function get_by_category_slug($slug){
			$prepare = $this->pdo->prepare('
				SELECT
					s.id, 
					s.title,
					s.content,
					c.title AS category_title,
					c.slug AS category_slug,
					c.css_class AS category_class
				FROM
					snippets AS s
				LEFT JOIN
					categories AS c
				ON
					s.id_category = c.id
				WHERE
					c.slug = :slug
			');

			$prepare->bindValue(':slug', $slug, PDO::PARAM_INT);
			$prepare->execute();
			$results = $prepare->fetchAll();

			return $results;
		}

		function get_snippet_by_id($id){
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
					s.id = :id
			');

			$prepare->bindValue(':id', $id, PDO::PARAM_INT);
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

    	function create_form_add($request, $app){

			$data_form = array(
				'name' => 'Snippet name',
				'category' => 'Snippet Catgeory',
				'text_snippet' => '',
				'placeholder_text' => 'Content'
			);

			$get_categories = $this->get_categories();

			$categories = array();

			foreach ($get_categories as $cat => $value) {

				$categories[$value['catgeory_id']] = $value['category_title'];
			}

			$form = $app['form.factory']->createBuilder('form', $data_form)
			    ->add('name')
			    ->add('category', 'choice', array(
		            'choices' => $categories,
		            'expanded' => false,
		        ))
			    ->add('text_snippet', 'textarea', array('attr' => array('rows' => '7','cols' => '10')) )
			    ->getForm();

			$form->handleRequest($request);

			$form_return = array(
				'data_form' => $data_form,
				'form' => $form
			);

			return $form_return;

		}	

		function add_snippet($name,$category,$text_snippet){
			
			if(!empty($name) && !empty($category) && !empty($text_snippet)){

				$prepare = $this->pdo->prepare('
					INSERT INTO
						snippets (id_category, title, content)
					VALUES
						(:id, :title, :content)
				');

				$prepare->execute(array(
					':id'=>$category, 
					':title'=>$name, 
					':content'=>utf8_decode($text_snippet)
				));

				return 'snippet_add';
			}

			else return 'empty_fields';
		}	
	}

?>