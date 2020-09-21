<?php


class MovieController
{
	public function httpGetMethod(Http $http)
	{
        try {
            $id_m = $http->getParameter()['id_m'];
        } catch (\Throwable $th) {
            //throw $th;
            // En cas d'erreur, redirection vers la page d'accueil.
            $http->redirectTo('/');
        }
        

        // Récupération des informations sur le film.
        $movieModel = new MovieModel();
        $movie      = $movieModel->findMovieById($id_m);
        
        // Récupération des actors du film
        $actorModel = new ActorModel();
        $actors = $actorModel->findCastingForMovie($id_m);

        // Récupération des genres du film
        $genresModel = new GenreModel();
        $genres = $genresModel->findGenreForMovie($id_m);

        // Récupération des réalisateurs du film
        $directorModel = new DirectorModel();
        $directors = $directorModel->findDirectorsForMovie($id_m);

        /*
            * Sérialisation du movie (qui est un tableau PHP) en une
            * chaîne de caractères JSON puis envoi de la réponse HTTP.
            */

        return 
        [
            "movie" => $movie, 
            "actors" => $actors, 
            "genres" => $genres, 
            "directors" => $directors,
            "movies" => array()
        ];

        
	}
}