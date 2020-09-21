<?php


class GenreController
{
	public function httpGetMethod(Http $http)
	{
        try {
            $id_g = $http->getParameter()['id_g'];

            // Récupération des actors du film
            $genreModel = new GenreModel();
            $listOfMovies = $genreModel->findMoviesForOneGenre($id_g);

            if ($listOfMovies)
            {
                return 
                [
                    "listOfMovies" => $listOfMovies, 
                    "movies" => array()
                ];
            }
            else
            {
                $http->redirectTo('/genres');
            } 
        } catch (\Throwable $th) {
            //throw $th;
            // En cas d'erreur, redirection vers la page d'accueil.
            $http->redirectTo('/');
        }

        
	}
}