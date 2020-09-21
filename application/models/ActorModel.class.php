<?php

class ActorModel
{
    public function allActors()
    {        
        $sql = 'SELECT
                    id_a,
                    firstname_a,
                    lastname_a
                FROM Actors
                LIMIT 10';

        $database = new Database();

        
        return $database->query($sql);
    }

    public function findCastingForMovie($movieId)
    {
        $database = new Database();

        $sql = 'SELECT firstname_a,lastname_a, actors.id_a
        FROM Actors
        INNER JOIN casting_with
        ON casting_with.id_a = actors.id_a
        INNER JOIN movies
        ON movies.id_m = casting_with.id_m
        WHERE movies.id_m = ?';

        // Récupération du casting du film.
        return $database->query($sql, [ $movieId ]);
    }

    public function findMoviesForOneActor($actorId)
    {
        $database = new Database();

        $sql = 'SELECT firstname_a, lastname_a, title_m, movies.id_m, poster_m
        From actors
        INNER JOIN casting_with
        ON casting_with.id_a = actors.id_a
        INNER JOIN movies 
        ON movies.id_m = casting_with.id_m
        WHERE actors.id_a = ?';

        // Récupération des films d'un acteur.
        return $database->query($sql, [ $actorId ]);
    }


}

