<?php

/**
* Snippets Model
*/
class Snippets_Model 
{
	
	public function __construct($app) {
		$this->app = $app;
	}
	
    
	public function get() {
	    return $this->get_by_page();
	}
	
	 /**
        Get the snippets by page
        @param $page The actual page
        @param $limit The number of snippets per page
        @return Array
    */
	public function get_by_page($page = 1, $limit = 6) {
	    $start = ($page - 1) * $limit;
	    $sql = 'SELECT 
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
            ORDER BY s.id DESC
            LIMIT '.$start.' , '.$limit; // Must put it here because of the ?
	    $results = $this->app['db']->fetchAll($sql);

	    return $results; 
	}
	
    /**
        Get the snippets by slug and by page
        @param $slug The slug
        @param $page The actual page
        @param $limit The number of snippets per page
        @return Array
    */
	public function get_by_category_slug($slug, $page = 1, $limit = 6) {
	    $start = ($page - 1) * $limit;
	    $sql = '
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
                c.slug = ?
            ORDER BY s.id DESC
            LIMIT '.$start.' , '.$limit; // Must put it here because of the ?
        $conditions = array($slug);
        $results = $this->app['db']->fetchAll($sql, $conditions);

	    return $results; 	
    }
    
    
    /**
        Get the number of page
        @param $limit The number of snippets per page
        @return Integer
    */
    public function get_number_page($limit = 6) {
        $results = $this->app['db']->fetchAssoc('
            SELECT COUNT(*) AS number_snippets FROM snippets 
        ');
        $number_page = (int) ceil($results['number_snippets']/$limit);
        return $number_page;
    }
    
    /**
        Get the number of page per category
        @param $limit The number of snippets per page
        @param $category the category
        @return Integer
    */
    public function get_number_page_by_category($limit = 6, $category) {
        $id = $this->app['db']->fetchAssoc('
            SELECT id FROM categories WHERE slug = :slug
        ', array('slug' => $category));
        
        $results = $this->app['db']->fetchAssoc('
            SELECT COUNT(*) AS number_snippets FROM snippets WHERE id_category = :id
        ', $id);
        $number_page = (int) ceil($results['number_snippets']/$limit);
        return $number_page;
    }
    
    /**
        Get all the informations about the categories
        @return Array
    */
    public function get_categories() {
        $sql = 'SELECT
                    *
                FROM
                    categories';
        $results = $this->app['db']->fetchAll($sql);
        
        return $results;
    }
    
    /**
        Get the name and if of categories > Use it for the select in the add snippets
        @return Array
    */
    public function get_categories_name() {
        $sql = 'SELECT
                    id, title
                FROM
                    categories';
        $results = $this->app['db']->fetchAll($sql);
        
        foreach($results as $result) {
            $names[$result['id']] = $result['title'];
        }
        
        return $names;
    }
    
    /**
        Get the informations about the snippet
        @param $id id of the snippet
        @return Array
    */
    public function get_snippet($id) {
        $sql = 'SELECT
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
            WHERE s.id = :id';
        $results = $this->app['db']->fetchAssoc($sql, array('id' => $id));
        return $results;
    }
    
    /**
        Add the snippet in the selected category
        @param $title title of the snippet
        @param $content content of the snippet
        @param $id id of the snippet
        @return string
    */
    public function add_snippet($title, $content, $id_category) {
        $parameters = array('id_category' => $id_category, 'title' => $title, 'content' => $content);
        $this->app['db']->insert('snippets', $parameters);
        
        return 'Your snippet has been added.';
    }
    
    /**
        Delete the snippet
        @param $id id of the snippet
        @return string
    */
    public function delete_snippet($id) {
        $parameters = array('id' => $id);
        $this->app['db']->delete('snippets',$parameters);
        
        return 'Snippet has been removed';
    }
}
