<?php
class Snippets_Model {

    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    function get() {
        return $this->getByPage();
    }

    function getByPage($page = 1, $limit = 5, $slug) {

        $id = $this->pdo->prepare("SELECT * FROM categories WHERE slug = :slug");
        $id->bindvalue('slug', $slug, PDO::PARAM_STR);
        $id->execute();

        $i = $id->fetch();

        $start = ($page-1)*$limit;
        $prepare = $this->pdo->prepare('
            SELECT
                  s.id,
                  s.title,
                  s.content,
                  u.username
            FROM
                snippets as s
            LEFT JOIN
                users as u
            ON 
                u.id = s.id_user
            WHERE
                s.id_category = :id
            LIMIT
                :start, :limit
          ');

        $prepare->bindValue('start', $start, PDO::PARAM_INT);
        $prepare->bindValue('id', $i['id'], PDO::PARAM_STR);
        $prepare->bindValue('limit', $limit, PDO::PARAM_INT);
        $prepare->execute();
        $result = $prepare->fetchAll();

        return $result;
    }

    function select_one_snippet($id){
        $prepare = $this->pdo->prepare("
            SELECT 
                s.title AS title,
                s.content,
                u.username
            FROM 
                snippets AS s
            LEFT JOIN
                users AS u
            ON
                u.id = s.id_user
            WHERE 
                s.id = :id
        ");
        $prepare->bindvalue('id', $id, PDO::PARAM_INT);
        $prepare->execute();

        return $prepare->fetch();
    }

    function get_pages_slug($current = 1, $limit = 2, $slug){

        $id = $this->pdo->prepare("SELECT * FROM categories WHERE slug = :slug");
        $id->bindvalue('slug', $slug, PDO::PARAM_STR);
        $id->execute();

        $i = $id->fetch();

        $query  = $this->pdo->prepare('SELECT COUNT(*) AS count FROM snippets WHERE id_category = :id');
        $query->bindvalue('id', $i['id'], PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch();
        $count  = ceil($result['count'] / $limit);
        $pages  = array();

        for($i = 1; $i <= $count; $i++){
            $pages[] = array(
                'number'  => $i,
                'current' => $i == $current
            );
        }

        return $pages;
    }

    function top (){
        $query = $this->pdo->query("
            SELECT 
                title, 
                slug,
                img
            FROM 
                categories
        ");

        return $query->fetchAll();
    }

    function getCategories() {
        $prepare = $this->pdo->prepare('
          SELECT
            *
          FROM
            categories
        ');

        $prepare->execute();
        $result = $prepare->fetchAll();

        return $result;
    }

    function create($data) {
        $title = $data['title'];
        $content = $data['content'];
        $category = $data['category'];
        $user = $data['user'];

        $prepare = $this->pdo->prepare('
          INSERT INTO
            snippets
          SET
            title = :title,
            content = :content,
            id_category = :category,
            id_user = :user
        ');

        $prepare->bindValue('title', $title);
        $prepare->bindValue('content', $content);
        $prepare->bindValue('category', $category);
        $prepare->bindValue('user', $user);
        $result = $prepare->execute();

        return $result;
    }
}