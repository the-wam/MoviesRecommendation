<?php

class GenreModel
{
    public function allGenres()
    {        
        $sql = 'SELECT
                    id_g,
                    name_g
                FROM Genres';

        $database = new Database();

        
        return $database->query($sql);
    }

    public function findGenreForMovie($movieId)
    {
        $database = new Database();

        $sql = 'SELECT name_g, genres.id_g
                FROM genres
                INNER JOIN type_movies
                ON type_movies.id_g = genres.id_g
                INNER JOIN movies
                ON movies.id_m = type_movies.id_m
                WHERE movies.id_m = ?';

        // Récupération du film spécifié.
        return $database->query($sql, [ $movieId ]);
    }

    public function genresTop5()
    {
        $sql = 'SELECT name_g, type_movies.id_g as numGenre, genres.id_g as id_ 
        FROM genres 
        INNER JOIN type_movies ON type_movies.id_g = genres.id_g 
        GROUP BY numGenre ORDER BY numGenre DESC LIMIT 5';

        $database = new Database();

        return $database->query($sql);
    }


    public function findMoviesForOneGenre($genreId)
    {
        $database = new Database();

        $sql = 'SELECT name_g, title_m, movies.id_m, poster_m
        From genres
        INNER JOIN type_movies
        ON type_movies.id_g = genres.id_g
        INNER JOIN movies 
        ON movies.id_m = type_movies.id_m
        WHERE genres.id_g = ?';

        // Récupération des films d'un réalisateur.
        return $database->query($sql, [ $genreId ]);

    }

}
