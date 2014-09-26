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

    function get($snippet = NULL, $admin = 0)
    {
        if(!$snippet)
            return $this->get_by_page();
        else if($snippet == 'all')
            return $this->get_all();

        if($admin === 1)
            $active = '.';
        else
            $active = 1;

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
                s.id = :id AND
                s.active REGEXP :active
        ');
        $prepare->bindValue('id', $snippet, PDO::PARAM_INT);
        $prepare->bindValue('active', $active);
        $prepare->execute();
        $result = $prepare->fetch();

        if(empty($result))
            return false;

        return $result;
    }

    function get_all(){
        $prepare = $this->pdo->prepare('
            SELECT
                s.id,
                s.title,
                s.active,
                c.title AS category_title,
                c.slug AS category_slug,
                c.active AS category_active
            FROM
                snippets AS s
            LEFT join
                categories AS c
            ON
                s.id_category = c.id
        ');
        $prepare->execute();
        $results = $prepare->fetchAll();

        return $results;
    }

    function get_by_page($page = 1, $limit = 4)
    {
        $start = ($page - 1) * $limit;

        $prepare = $this->pdo->prepare('
            SELECT
                s.id, 
                s.title, 
                c.title AS category_title,
                c.slug AS category_slug
            FROM
                snippets AS s
            LEFT join
                categories AS c
            ON
                s.id_category = c.id
            WHERE
                s.active = 1 AND
                c.active = 1
            ORDER BY
                s.id DESC
            LIMIT :start,:limit
        ');
        $prepare->bindValue('start', $start, PDO::PARAM_INT);
        $prepare->bindValue('limit', $limit, PDO::PARAM_INT);
        $prepare->execute();
        $results = $prepare->fetchAll();

        if(empty($results))
            return false;

        return $results;
    }

    function get_by_category_slug($slug, $page = 1, $limit = 4)
    {
        $start = ($page - 1) * $limit;

        $prepare = $this->pdo->prepare('
            SELECT
                s.id, 
                s.title, 
                c.title AS category_title,
                c.slug AS category_slug
            FROM
                snippets AS s
            LEFT join
                categories AS c
            ON
                s.id_category = c.id
            WHERE
                c.slug = :slug AND
                s.active = 1 AND
                c.active = 1
            LIMIT :start, :limit
        ');
        $prepare->bindValue('slug', $slug);
        $prepare->bindValue('start', $start, PDO::PARAM_INT);
        $prepare->bindValue('limit', $limit, PDO::PARAM_INT);
        $prepare->execute();
        $results = $prepare->fetchAll();

        return $results;
    }

    function get_by_title($title, $page = 1, $limit = 4)
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
            WHERE
                s.title LIKE :title AND
                s.active = 1
            LIMIT :start, :limit
        ');
        $prepare->bindValue('title', '%' . $title . '%');
        $prepare->bindValue('start', $start, PDO::PARAM_INT);
        $prepare->bindValue('limit', $limit, PDO::PARAM_INT);
        $prepare->execute();
        $results = $prepare->fetchAll();

        return $results;
    }

    function get_pages($current, $limit = 4, $slug = '.', $title = '.')
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
                c.slug REGEXP :slug AND 
                s.title REGEXP :title AND
                s.active = 1
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
                'number'  => $i
            );
        }
        return $pages;
    }

    function add($data){

        $snippets = $this->get_all();

        foreach($snippets as $snippet){
            if($data['title'] === $snippet['title']) // Si un snippet du même nom existe déjà.
                return 'A snippet with the same name already exist';
        }

        $prepare  = $this->pdo->prepare('
            INSERT INTO 
                snippets (title, content, id_category) 
            VALUES(:title, :content, :id_category)
        ');
        $prepare->bindValue('title', $data['title']);
        $prepare->bindValue('content', $data['content']);
        $prepare->bindValue('id_category', $data['category'], PDO::PARAM_INT);
        $exec = $prepare->execute();

        return $exec;
    }

    function update($data){

        $snippet = $this->get($data['id'], 1);

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

    function active($id, $active){

        $snippet = $this->get($id, 1);

        if(!$snippet)
            return 'Snippet not found';
        
        $prepare = $this->pdo->prepare('
            UPDATE
                snippets
            SET
                active = :active
            WHERE
                id = :id
        ');
        $prepare->bindValue('id', $id, PDO::PARAM_INT);
        $prepare->bindValue('active', $active, PDO::PARAM_INT);
        $exec = $prepare->execute();

        return $exec;
    }

    function delete($id){

        $snippet = $this->get($id, 1);

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