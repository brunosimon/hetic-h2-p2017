<?php

/**
 * Pages Model
 */
class Pages_Model
{
    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    function get($page = NULL)
    {
    	if(empty($page))
    		return $this->get_all();

    	$prepare = $this->pdo->prepare('
            SELECT
                content
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

    function get_all(){
    	$prepare = $this->pdo->prepare('
            SELECT
            	id,
                title,
                content
            FROM
                pages
        ');
        $prepare->execute();
        $results = $prepare->fetchAll();
        
        return $results;
    }

    function update($pages){
    	$prepare = $this->pdo->prepare('
            UPDATE
                pages
            SET
            	content = :content
            WHERE
            	id = :id
        ');
        foreach($pages['page'] as $key => $page){
	        $prepare->bindValue('id', $key, PDO::PARAM_INT);
	        $prepare->bindValue('content', $page);
	        $exec[] = $prepare->execute();
        }

        return $exec;
    }
}
