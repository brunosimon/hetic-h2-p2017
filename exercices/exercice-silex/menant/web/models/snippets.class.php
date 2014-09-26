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

    function get($id = NULL)
    {
        if(empty($id))
            return $this->get_by_page();

        $prepare = $this->pdo->prepare('
            SELECT
                s.id,
                s.title,
                s.content,
                c.title AS category_title,
                c.slug AS category_slug
            FROM
                snippets AS s
            LEFT join
                categories AS c
            ON
                s.id_category = c.id
            WHERE
                s.id = :id
        ');
        $prepare->bindValue('id', $id, PDO::PARAM_INT);
        $prepare->execute();
        $result = $prepare->fetch();

        if(empty($result))
            return false;

        return $result;
    }

    function get_by_page($page = 1, $limit = 8)
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
            INNER JOIN
                categories AS c
            ON
                s.id_category = c.id
            ORDER BY
                s.id
            LIMIT
                :start,:limit
        ');

        // Bind values
        $prepare->bindValue('start',$start,PDO::PARAM_INT);
        $prepare->bindValue('limit',$limit,PDO::PARAM_INT);

        // Execute
        $prepare->execute();
        $results = $prepare->fetchAll();

        // Return
        return $results;
    }

    function get_by_category_slug($slug, $page = 1, $limit = 8)
    {
        $start = ($page - 1) * $limit;

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
            LIMIT :start, :limit
        ');

        // Bind values
        $prepare->bindValue('slug',$slug);
        $prepare->bindValue('start', $start, PDO::PARAM_INT);
        $prepare->bindValue('limit', $limit, PDO::PARAM_INT);

        // Execute
        $prepare->execute();

        // Return
        return $prepare->fetchAll();
    }

    function get_by_title($title, $page = 1, $limit = 8)
    {
        $start = ($page - 1) * $limit;

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
                s.title LIKE :title
            LIMIT :start, :limit
        ');

        // Bind values
        $prepare->bindValue('title', '%' . $title . '%');
        $prepare->bindValue('start', $start, PDO::PARAM_INT);
        $prepare->bindValue('limit', $limit, PDO::PARAM_INT);

        // Execute
        $prepare->execute();

        // Return
        return $prepare->fetchAll();
    }

    function get_pages($current = 1, $limit = 8, $slug = '.', $title = '.')
    {
        $prepare  = $this->pdo->prepare('
            SELECT 
                COUNT(*) 
            AS 
                count 
            FROM 
                snippets AS s
            LEFT join
                categories AS c
            ON
                s.id_category = c.id
            WHERE 
                c.slug REGEXP :slug AND s.title REGEXP :title
        ');
        $prepare->bindValue('slug', $slug);
        $prepare->bindValue('title', $title);
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

    function add($form){
        $prepare = $this->pdo->prepare('
            INSERT INTO
                snippets (title, content, id_category)
            VALUES
                (:title, :content, :id_category)
            ');
        $prepare->bindValue(':title', $form['title']);
        $prepare->bindValue(':content', $form['content']);
        $prepare->bindValue(':id_category', $form['category']);
        $prepare->execute();
    }

    function update($data){
        $snippet = $this->get($data['id']);

        if(!$snippet)
            return 'Snippet not found';

        $prepare = $this->pdo->prepare('
            UPDATE
                snippets
            SET
                title = :title,
                content = :content,
                id_category = :category
            WHERE
                id = :id
        ');
        $prepare->bindValue('id', $data['id'], PDO::PARAM_INT);
        $prepare->bindValue('title', $data['title']);
        $prepare->bindValue('content', $data['content']);
        $prepare->bindValue('category', $data['category'], PDO::PARAM_INT);
        $exec = $prepare->execute();

        return $exec;
    }

    function delete($id){

        $snippet = $this->get($id);

        if(!$snippet)
            return 'Snippet not found';

        $prepare  = $this->pdo->prepare('
            DELETE FROM
                snippets
            WHERE
                id = :id
        ');
        $prepare->bindValue('id', $id);
        $exec = $prepare->execute();

        return $exec;
    }
}


















