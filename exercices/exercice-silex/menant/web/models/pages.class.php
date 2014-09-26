<?php

/**
* PAGES
*/
class Pages_Model
{
    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    function get($page = NULL)
    {
        $prepare = $this->pdo->prepare('
            SELECT
                content,
                title
            FROM
                pages
            WHERE
                title = :title
        ');
        $prepare->bindValue('title', $page);
        $prepare->execute();
        $result = $prepare->fetch();
        
        return $result;
    }

    function update($title, $content){
        $prepare = $this->pdo->prepare('
            UPDATE
                pages
            SET
                content = :content
            WHERE
                title = :title
        ');
        $prepare->bindValue('title', $title);
        $prepare->bindValue('content', $content);
        $exec = $prepare->execute();

        return $exec;
    }
}


















