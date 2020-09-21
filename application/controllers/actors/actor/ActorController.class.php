<?php


class ActorController
{
	public function httpGetMethod(Http $http)
	{
        try {
            $id_a = $http->getParameter()['id_a'];

            // Récupération des actors du film
            $actorModel = new ActorModel();
            $listOfMovies = $actorModel->findMoviesForOneActor($id_a);

            // si la liste est vide redirection vers la page d'accueil.
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
                $http->redirectTo('/');
            }
        } catch (\Throwable $th) {
            //throw $th;
            // En cas d'erreur, redirection vers la page d'accueil.
            $http->redirectTo('/');
        }        
	}
}