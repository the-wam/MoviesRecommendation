<?php

class MovieModel
{
    public function allMovies()
    {        
        $sql = 'SELECT
                    id_m,
                    title_m,
                    runtime_m,
                    full_plot_m,
                    poster_m
                FROM Movies
                WHERE poster_m IS NOT NULL
                LIMIT 4';

        $database = new Database();

        
        return $database->query($sql);
    }

    public function allMoviesMain()
    {        
        $sql = 'SELECT
                    id_m,
                    title_m,
                    runtime_m,
                    full_plot_m,
                    poster_m
                FROM Movies
                WHERE poster_m IS NOT NULL
                LIMIT 60';

        $database = new Database();

        
        return $database->query($sql);
    }

    public function findMovieById($movieId)
    {
        $database = new Database();

        $sql = 'SELECT 
                    movies.id_m,
                    title_m,
                    year_m,
                    imdb_rating_m,
                    poster_m,
                    full_plot_m,
                    runtime_m
                FROM movies
                WHERE movies.id_m = ?';

        // Récupération du film spécifié.
        return $database->queryOne($sql, [ $movieId ]);
    }


}