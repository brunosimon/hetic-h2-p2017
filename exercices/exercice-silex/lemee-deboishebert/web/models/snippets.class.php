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

    function get_by_page($page = 1, $limit = 2)
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
        //var_dump($prepare->fetchAll());
        return $prepare->fetchAll();
        
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
        ');

        // Bind values
        $prepare->bindValue('slug',$slug,PDO::PARAM_INT);

        // Execute
        $prepare->execute();

        // Return
        return $prepare->fetchAll();
    }
    
    /*

    function get_by_category_slug($slug)
    {
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
        ');

        // Bind values
        $prepare->bindValue('slug',$slug,PDO::PARAM_INT);

        // Execute
        $prepare->execute();

        // Return
        return $prepare->fetchAll();
    }
    */

    function get_pages($current = 1, $limit = 2)
    {
        $query  = $this->pdo->query('SELECT COUNT(*) AS count FROM snippets');
        $result = $query->fetch();
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
    
    function add_snippet($name, $category, $snippet)
    {
    	$prepare = $this->pdo->prepare("INSERT INTO snippets VALUES ('', :category, :name, :snippet)");

        // Bind values
        $prepare->bindValue('category',$category,PDO::PARAM_INT);
        $prepare->bindValue('name',$name,PDO::PARAM_STR);
        $prepare->bindValue('snippet',$snippet,PDO::PARAM_STR);
        
        // Execute
        $prepare->execute();
    }
}


