<?php

/**
* Quotes class
*/
class Quotes_Model
{
    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    function get_all_quotes()
    {
        $prepare = $this->pdo->prepare('
            SELECT
                q.content,
                s.first_name as student_first_name,
                s.last_name as student_last_name,
                s.id as student_id,
                p.title as promotion_title,
                p.slug as promotion_slug
            FROM
                quotes q
            LEFT JOIN
                students s
            ON
                q.id_student = s.id
            LEFT JOIN
                promotions p
            ON
                s.id_promotion = p.id
            ORDER BY
                q.id DESC
        ');
        $prepare->execute();

        return $prepare->fetchAll();
    }

    function get_promotion_by_slug($slug)
    {
        $prepare = $this->pdo->prepare('
            SELECT
                *
            FROM
                promotions
            WHERE
                slug = :slug
        ');
        $prepare->bindValue(':slug',$slug);
        $prepare->execute();

        return $prepare->fetch();
    }

    function get_student_by_id($id)
    {
        $prepare = $this->pdo->prepare('
            SELECT
                s.*,
                p.title
            FROM
                students s
            LEFT JOIN
                promotions p
            ON
                s.id_promotion = p.id
            WHERE
                s.id = :id
        ');
        $prepare->bindValue(':id',$id);
        $prepare->execute();

        return $prepare->fetch();
    }

    function get_quotes_by_student_id($id)
    {
        $prepare = $this->pdo->prepare('
            SELECT
                q.*
            FROM
                quotes q
            WHERE
                q.id_student = :id
        ');
        $prepare->bindValue(':id',$id);
        $prepare->execute();

        return $prepare->fetchAll();
    }

    function get_student_by_promotion_slug($slug)
    {
        $prepare = $this->pdo->prepare('
            SELECT
                s.*,
                p.title,
                COUNT(q.id) AS count
            FROM
                students s
            LEFT JOIN
                promotions p
            ON
                s.id_promotion = p.id
            LEFT JOIN
                quotes q
            ON
                q.id_student = s.id
            WHERE
                p.slug = :slug
            GROUP BY
                s.id
        ');
        $prepare->bindValue(':slug',$slug);
        $prepare->execute();

        return $prepare->fetchAll();
    }

    function get_students_for_form()
    {
        $query = $this->pdo->query('SELECT * FROM students');
        $students = $query->fetchAll();

        $results = array();
        foreach($students as $_student)
            $results[$_student['id']] = $_student['last_name'].' '.$_student['first_name'];

        return $results;
    }

    function get_promotions_for_form()
    {
        $query = $this->pdo->query('SELECT * FROM promotions');
        $promotions = $query->fetchAll();

        $results = array();
        foreach($promotions as $_promotion)
            $results[$_promotion['id']] = $_promotion['title'];

        return $results;
    }

    function add_quote($data)
    {
        if(empty($data['id_student']) || empty($data['content']))
            return false;

        $prepare = $this->pdo->prepare('
            INSERT INTO
                quotes (id_student,content)
            VALUES
                (:id_student,:content)
        ');
        $prepare->bindValue('id_student',$data['id_student']);
        $prepare->bindValue('content',$data['content']);

        $prepare->execute();

        return true;
    }
}
