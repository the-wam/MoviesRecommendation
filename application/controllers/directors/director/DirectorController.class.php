<?php


class DirectorController
{
	public function httpGetMethod(Http $http)
	{
        try {
            $id_d = $http->getParameter()['id_d'];

            // Récupération des actors du film
            $directorModel = new DirectorModel();
            $listOfMovies = $directorModel->findMoviesForOneDirector($id_d);

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
                $http->redirectTo('/directors');
            } 
        } catch (\Throwable $th) {
            //throw $th;
            // En cas d'erreur, redirection vers la page d'accueil.
            $http->redirectTo('/');
        }
        
        

        
	}
}