<?php


class MovieController
{
	public function httpGetMethod(Http $http)
	{
        try {
            $id_m = $http->getParameter()['id_m'];
            if ($id_m == Null)
            {
                // En cas d'erreur, redirection vers la page d'accueil.
                $http->redirectTo('/');                
            }
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

        $userSession = new UserSession();
        $movies = array();
        // Requete pour les recommendations 
        $userID = $userSession->getUserId();
        $movieID = $id_m;

        if ($userID == null)
        {
            $userID = 4;
        }
        $data = array(
            'userId' => $userID,
            'movieTitle' => $movie["title_m"]
        );

        // requete recommandation
        $resquestiapython = new RequestIaPython();
        $movies = $resquestiapython->myRequest($data);

        // $toto = new MovieModel();
        // $movies = $toto->recommendation($response);

        return 
        [
            "myMovie" => $movie,
            "actors" => $actors, 
            "genres" => $genres, 
            "directors" => $directors,
            "movies" => $movies
        ];

        
	}
}