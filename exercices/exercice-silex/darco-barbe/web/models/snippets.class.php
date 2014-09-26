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

  function get_by_page($page = 1,$limit = 10)
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
      LIMIT  :start,:limit
    ');
    /**
    *0,2 premier affiché,la quantité affichée
    */
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
    $prepare->bindValue('slug',$slug);
    $prepare->execute();
    $results = $prepare->fetchAll();

    //echo'<pre>';
    //print_r($results);
    //echo'</pre>';

    return $results;
  }
}