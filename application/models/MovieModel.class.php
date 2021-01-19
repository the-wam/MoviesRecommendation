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
                LIMIT 30';

        $database = new Database();

        
        return $database->query($sql);
    }

    public function recommendation($ids)
    {        
        $sql = 'SELECT
                    id_m,
                    title_m,
                    poster_m
                FROM Movies
                WHERE poster_m IS NOT NULL
                AND id_m IN ('.implode(",",$ids).') LIMIT 4';
        // val = $ids;

        $database = new Database();

        
        return $database->query($sql);
    }

    public function getMoviespro($page, $pageSize)
    {
        $sql = "CALL spGetMovie(?, ?)";

        $val = [$page, $pageSize];

        $database = new Database();

        return $database->query($sql, $val);
    }

    public function MoviesForHome()
    {        
        $sql = 'SELECT comments_rate.id_m, AVG(rate_c) note,title_m,poster_m
                FROM comments_rate
                INNER JOIN movies
                ON comments_rate.id_m = movies.id_m
                WHERE poster_m IS NOT NULL
                GROUP by id_m
                HAVING COUNT(rate_c)>10
                ORDER BY note DESC
                LIMIT 5';

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