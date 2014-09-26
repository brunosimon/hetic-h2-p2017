<?php
class Snippets_Model {
  function __construct($pdo) {
    $this->pdo = $pdo;
  }

  function get() {
    return $this->getByPage();
  }

  function getById($id) {
    // ** Echec avec tentative de Jointure :
    // ** Le but étant de récupéré un tableau avec les ids et les auteurs (username) des enfants d'un snippet
    // $prepare = $this->pdo->prepare('
    //   SELECT
    //     s.id,
    //     s.title,
    //     s.content,
    //     s.username,
    //     s.description,
    //     s.parent,
    //     c.id AS category_id,
    //     c.slug AS category_slug,
    //     c.title AS category_title,
    //     children.username AS children,
    //     children.id AS children
    //   FROM
    //     snippets AS s
    //   LEFT JOIN
    //     categories AS c
    //   ON
    //     s.id_category = c.id
    //   RIGHT JOIN
    //     snippets AS children
    //   ON
    //     s.id = children.parent
    //   WHERE
    //     s.id = :id
    // ');

    // ** Succès (modéré) mais avec 2 requêtes
    $prepare = $this->pdo->prepare('
      SELECT
        s.id,
        s.title,
        s.content,
        s.username,
        s.description,
        s.parent,
        c.id AS category_id,
        c.slug AS category_slug,
        c.title AS category_title
      FROM
        snippets AS s
      LEFT JOIN
        categories AS c
      ON
        s.id_category = c.id
      WHERE
        s.id = :id
    ');
    $prepare->bindValue('id', $id, PDO::PARAM_INT);
    $prepare->execute();
    $result1 = $prepare->fetchAll();


    $prepare = $this->pdo->prepare('
      SELECT id, username FROM snippets WHERE parent = :id ');
    $prepare->bindValue('id', $id, PDO::PARAM_INT);
    $prepare->execute();
    $result2 = $prepare->fetchAll();

    $result = array(
      'snippet' => $result1,
      'children' => $result2
      );

    // echo '<pre>';
    // print_r($result);
    // echo '</pre>';
    // exit;

    return $result;
  }

  function getByCategorySlug($slug) {
    $prepare = $this->pdo->prepare('
      SELECT
        s.id,
        s.title,
        s.content,
        s.username,
        s.description,
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
      ORDER BY
        s.id DESC
    ');

    $prepare->bindValue('slug', $slug);
    $prepare->execute();
    $result = $prepare->fetchAll();

    return $result;
  }

  function getByUsername($username) {
    $username = strtolower($username);
    $prepare = $this->pdo->prepare('
      SELECT
        s.id,
        s.title,
        s.content,
        s.username,
        s.description,
        c.title AS category_title,
        c.slug AS category_slug
      FROM
        snippets AS s
      LEFT JOIN
        categories AS c
      ON
        s.id_category = c.id
      LEFT JOIN
        users AS u
      ON
        s.username = u.username
      WHERE
        u.username = :username
    ');

    $prepare->bindValue('username', $username);
    $prepare->execute();
    $result = $prepare->fetchAll();

    return $result;
  }

  function getByPage($page = 1, $limit = 4) {
    $start = ($page-1)*$limit;
    $prepare = $this->pdo->prepare('
      SELECT
        s.id,
        s.title,
        s.content,
        s.username,
        s.description,
        c.title AS category_title,
        c.slug AS category_slug
      FROM
        snippets AS s
      LEFT JOIN
        categories AS c
      ON
        s.id_category = c.id
      ORDER BY
        s.id DESC
      LIMIT
        :start, :limit
    ');

    $prepare->bindValue('start', $start, PDO::PARAM_INT);
    $prepare->bindValue('limit', $limit, PDO::PARAM_INT);
    $prepare->execute();
    $result = $prepare->fetchAll();

    return $result;
  }

  function getPages($current = 1, $limit = 5) {
    $prepare = $this->pdo->prepare('
      SELECT count(*) FROM snippets
    ');

    $prepare->execute();
    $nbOfSnippets = $prepare->fetchColumn();

    $nbOfPage = ceil($nbOfSnippets/$limit);
    $pages = [];
    for ($i=1; $i<=$nbOfPage; $i++) {
      $isCurrent = false;
      if ($i == $current)
        $isCurrent = true;

      $pages[] = array(
          'number' => $i,
          'current' => $isCurrent
        );
    }
    return $pages;
  }

  function getCategories() {
    $categories = $this->pdo->query('
      SELECT
        *
      FROM
        categories
    ');

    $result = $categories->fetchAll();

    return $result;
  }

  function create($data) {
    $errors = [];

    $title = $data['title'];
    $content = $data['content'];
    $description = $data['description'];
    $category = $data['category'];
    $user = $data['username'];

    if ($parent === 0) // The user made a faked parent-field
      $errors[] = "An error happened, please try again.";

    if (!empty($data['parent']))
      $parent = $data['parent'];
    else
      $parent = 0;

    if (strlen($title) < 1)
      $errors[] = "Title's too short";
    if (strlen($description) < 1)
      $errors[] = "The description is too short";
    if (strlen($content) < 2)
      $errors[] = "The content is too short";

    if (!empty($errors))
      return $errors;

    $prepare = $this->pdo->prepare('
      INSERT INTO snippets  SET
        title = :title,
        content = :content,
        description = :description,
        id_category = :category,
        username = :user,
        parent = :parent
    ');

    $prepare->bindValue('title', $title);
    $prepare->bindValue('content', $content);
    $prepare->bindValue('description', $description);
    $prepare->bindValue('category', $category);
    $prepare->bindValue('user', $user);
    $prepare->bindValue('parent', $parent);
    $result = $prepare->execute();

    return $result;
  }

  function search($req) {
    $prepare = $this->pdo->prepare('
      SELECT
        s.id,
        s.title,
        s.content,
        s.username,
        s.description,
        c.title AS category_title,
        c.slug AS category_slug
      FROM
        snippets AS s
      LEFT JOIN
        categories AS c
      ON
        s.id_category = c.id
      WHERE
        s.title
      LIKE
        :req
      ORDER BY
        s.id DESC
    ');

    $prepare->bindValue('req', $req, PDO::PARAM_INT);
    $prepare->execute();
    $result = $prepare->fetchAll();

    return $result;
  }
}
