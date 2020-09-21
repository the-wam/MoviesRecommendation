<?php

class DirectorModel
{
    public function allDirectors()
    {        
        $sql = 'SELECT
                    id_d,
                    firstname_d,
                    lastname_d
                FROM Directors
                LIMIT 10';

        $database = new Database();

        
        return $database->query($sql);
    }

    public function findDirectorsForMovie($movieId)
    {
        $database = new Database();

        $sql = 'SELECT firstname_d,lastname_d, directors.id_d
        FROM directors
        INNER JOIN directing_by
        ON directing_by.id_d = directors.id_d
        INNER JOIN movies
        ON movies.id_m = directing_by.id_m
        WHERE movies.id_m = ?';

        // Récupération du film spécifié.
        return $database->query($sql, [ $movieId ]);
    }

    public function findMoviesForOneDirector($directorId)
    {
        $database = new Database();

        $sql = 'SELECT firstname_d, lastname_d, title_m, movies.id_m, poster_m
        From directors
        INNER JOIN directing_by
        ON directing_by.id_d = directors.id_d
        INNER JOIN movies 
        ON movies.id_m = directing_by.id_m
        WHERE directors.id_d = ?';

        // Récupération des films d'un réalisateur.
        return $database->query($sql, [ $directorId ]);

    }
}

