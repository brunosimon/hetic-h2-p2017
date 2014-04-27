<?php 

    require_once 'config.php';
    
    /*
     * CLASSIC
     * Récupérer les scores sans jointures
     */
    // $query = $pdo->query('
    //     SELECT 
    //         s.*
    //     FROM 
    //         scores AS s
    // ');
    
    
    /*
     * LEFT JOIN
     * Récupérer les scores et joindre le nom du player
     */
    // $query = $pdo->query('
    //     SELECT 
    //         s.score,
    //         p.name
    //     FROM 
    //         scores AS s
    //     LEFT JOIN
    //         players as p
    //     ON
    //         s.id_player = p.id
    // ');


    /*
     * CLASSIC
     * Récupérer les joueurs sans jointures
     */
    // $query = $pdo->query('
    //     SELECT 
    //         p.*
    //     FROM 
    //         players AS p
    // ');


    /*
     * LEFT JOIN
     * Récupérer les joueurs et joindre aux scores
     */
    // $query = $pdo->query('
    //     SELECT 
    //         p.name,
    //         s.score
    //     FROM 
    //         players as p
    //     LEFT JOIN
    //         scores AS s
    //     ON
    //         s.id_player = p.id
    // ');

    
    /*
     * LEFT JOIN
     * Récupérer les joueurs, les joindre aux scores, les regroupés et calculer le total
     */
    // $query = $pdo->query('
    //     SELECT 
    //         p.name,
    //         SUM(s.score) AS total_score
    //     FROM 
    //         players as p
    //     LEFT JOIN
    //         scores AS s
    //     ON
    //         s.id_player = p.id
    //     GROUP BY
    //         p.id
    // ');

    
    /*
     * INNER JOIN
     * Même chose mais sans les players n'ayant aucun score
     */
    $query = $pdo->query('
        SELECT 
            p.name,
            SUM(s.score) AS total_score
        FROM 
            players as p
        INNER JOIN
            scores AS s
        ON
            s.id_player = p.id
        GROUP BY
            p.id
    ');
    
    $results = $query->fetchAll();

    echo '<pre>';
    print_r($results);
    echo '</pre>';
    exit;