<?php

/**
* CATEGORIES
*/
class Categories_Model
{
    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    function get($id = NULL)
    {
        if(!$id)
            return $this->get_all();

        $prepare = $this->pdo->prepare('
            SELECT
                COUNT(*)
            FROM
                categories
            WHERE
                id = :id
        ');
        $prepare->bindValue('id', $id, PDO::PARAM_INT);
        $prepare->execute();
        $result = $prepare->fetch();

        if(empty($result))
            return false;

        return $result;
    }

    function get_all(){
        $prepare = $this->pdo->prepare('
            SELECT
                c.id,
                c.slug,
                c.title,
                COUNT(s.id_category) AS total_cat
            FROM
                categories AS c
            LEFT JOIN
                snippets AS s
            ON
                s.id_category = c.id
            GROUP BY
                c.id
            ORDER BY
                c.id DESC
        ');
        $prepare->execute();
        $results = $prepare->fetchAll();
        return $results;
    }

    function delete($id){

        $category = $this->get($id);

        if(!$category)
            return 'Category not found';

        $prepare  = $this->pdo->prepare('
            DELETE FROM
                categories
            WHERE
                id = :id
        ');
        $prepare->bindValue('id', $id);
        $exec = $prepare->execute();

        return $exec;
    }

    function add($data){
        $prepare = $this->pdo->prepare('
            INSERT INTO
                categories (title, slug)
            VALUES
                (:title, :slug)
            ');
        $prepare->bindValue(':title', $data['title']);
        $prepare->bindValue(':slug', strtolower($data['title']));
        $exec = $prepare->execute();

        return $exec;
    }
}


















