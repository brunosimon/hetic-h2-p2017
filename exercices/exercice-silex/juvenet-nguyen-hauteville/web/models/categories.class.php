<?php 

/**
 * Categories Model
 */
class Categories_Model
{
    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    function get($categories = NULL, $admin = NULL)
    {
        if($categories == 'all')
            return $this->get_all();
        else if($categories == 'active')
            return $this->get_active();

        if(gettype($categories) == "integer"){
            $category['id'] = $categories;
            $category['slug'] = '.';
        }
        else{
            $category['id'] = '.';
            $category['slug'] = $categories;
        }

        if($admin === 1)
            $active = '.';
        else
            $active = 1;

        $prepare = $this->pdo->prepare('
            SELECT
                c.id,
                c.title,
                c.slug,
                c.active,
                COUNT(s.id_category) AS total
            FROM
                categories AS c
            LEFT join
                snippets AS s
            ON
                s.id_category = c.id
            WHERE
                c.id REGEXP :id AND
                c.slug REGEXP :slug AND
                c.active REGEXP :active
            GROUP BY
                c.id
            ORDER BY
                c.id DESC
        ');
        $prepare->bindValue('id', $category['id']);
        $prepare->bindValue('slug', $category['slug']);
        $prepare->bindValue('active', $active);
        $prepare->execute();
        $result = $prepare->fetch();
        
        return $result;
    }

    function get_all(){
        $prepare = $this->pdo->prepare('
            SELECT
                c.id,
                c.title,
                c.slug,
                c.active,
                COUNT(s.id_category) AS total
            FROM
                categories AS c
            LEFT join
                snippets AS s
            ON
                s.id_category = c.id AND
                s.active > 0
            GROUP BY
                c.id
            ORDER BY
                c.id DESC
        ');
        $prepare->execute();
        $results = $prepare->fetchAll();
        
        return $results;
    }

    function get_active(){
        $prepare = $this->pdo->prepare('
            SELECT
                c.id,
                c.title,
                c.slug,
                c.active,
                COUNT(s.id_category) AS total
            FROM
                categories AS c
            LEFT join
                snippets AS s
            ON
                s.id_category = c.id AND
                s.active > 0
            WHERE
                c.active = 1
            GROUP BY
                c.id
            ORDER BY
                c.id DESC
        ');
        $prepare->execute();
        $results = $prepare->fetchAll();
        
        return $results;
    }

    function add($data){

        $categories = $this->get_all();

        foreach($categories as $category){
            if($data['title'] === $category['title']) // Si une catégorie du même nom existe déjà.
                return 'This category already exist';
        }

        $prepare  = $this->pdo->prepare('
            INSERT INTO 
                categories (title, slug) 
            VALUES(:title, :slug)
        ');
        $prepare->bindValue('title', $data['title']);
        $prepare->bindValue('slug', $data['slug']);
        $exec = $prepare->execute();

        return $exec;
    }

    function active($id, $active){

        $category = $this->get($id, 1);

        if(!$category)
            return 'Category not found';

        $prepare = $this->pdo->prepare('
            UPDATE
                categories
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

        $category = $this->get($id, 1);

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
}