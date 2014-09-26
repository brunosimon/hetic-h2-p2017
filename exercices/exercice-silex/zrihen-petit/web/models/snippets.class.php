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

    function get()
    {
        return $this->get_by_page();
    }

    function get_by_page($page = 1, $limit = 4)
    {
        $start = ($page - 1) * $limit;

        $prepare = $this->pdo->prepare('
            SELECT
                s.id,
                s.title,
                s.content,
                c.title AS category_title,
                c.slug  AS category_slug
            FROM
                snippets AS s
            LEFT JOIN
                categories AS c
            ON
                s.id_category = c.id
            LIMIT :start,:limit
        ');
        $prepare->bindValue('start',$start,PDO::PARAM_INT);
        $prepare->bindValue('limit',$limit,PDO::PARAM_INT);
        $prepare->execute();
        $results = $prepare->fetchAll();

        return $results;
    }

    function get_by_category_slug($slug)
    {
        $prepare = $this->pdo->prepare('
            SELECT
                s.id,
                s.title,
                s.content,
                c.title AS category_title,
                c.slug  AS category_slug
            FROM
                snippets AS s
            LEFT JOIN
                categories AS c
            ON
                s.id_category = c.id
            WHERE
                c.slug = :slug
        ');
        $prepare->bindValue('slug',$slug);
        $prepare->execute();
        $results = $prepare->fetchAll();

        return $results;
    }


    function comment ($form){
        $prepare = $this->pdo->prepare("
            INSERT INTO users
            (name,firstname,comment,email) 
            VALUES (:name,:firstname,:comment,:email)
        ");

        $prepare->bindValue('name', $form['name']);
        $prepare->bindValue('firstname',$form['firstname']);
        $prepare->bindValue('comment',$form['comment']);
        $prepare->bindValue('email',$form['email']);
        $prepare->execute();

        if (empty($form['email'])) {

             echo "Entrez un mail valide";
        }
        else{
            
             $to      = $form['email'];
             $message = $form['comment'];
             $headers = 'From: snippethetic@gmail.com' . "\r\n" .
             'Reply-To: snippethetic@gmail.com' . "\r\n" .
             'X-Mailer: PHP/' . phpversion();

             mail($to, $message, $headers);
        }
    }

   function add_snippet ($form){
        $query = $this->pdo->prepare("
            INSERT INTO snippets
                (
                    title,
                    content,
                    id_category
                )
            VALUES
                (
                    :title,
                    :content,
                    :id_category

                )
        ");

        $query->bindvalue('title', $form['title'], PDO::PARAM_STR);
        $query->bindvalue('content', nl2br($form['content']), PDO::PARAM_STR);
        $query->bindvalue('id_category', $form['id_category'], PDO::PARAM_INT);
        $query->execute();
    }
}
