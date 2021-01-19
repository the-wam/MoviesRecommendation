<?php

class HomeController
{
    public function httpGetMethod(Http $http)
    {

        // Récupération de tous les films pour la page d'accueil 
        $movieModel = new MovieModel();
        $moviesMain = $movieModel->allMovies();

        // Récupération de tous les genres pour la page d'accueil
        $genreModel = new GenreModel();
        $genres = $genreModel->genresTop5();
        

        $userSession = new UserSession();
        
        // Requete pour les recommendations 
        $userID = $userSession->getUserId();

        if ($userID == null)
        {
            $userID = 1;
        }

        
        $movieID = rand(1, 150);

        $RandomMovie = $movieModel->findMovieById($movieID);

        $data = array(
            'userId' => $userID,
            'movieTitle' => $RandomMovie["title_m"]
        );

        // requete recommandation
        $modelRequest = new RequestIaPython();
        $movies = $modelRequest->myRequest($data);

        //$movies = $movieModel->MoviesForHome();
        $movieID2 = rand(1, 150);
        $RandomMovie2 = $movieModel->findMovieById($movieID2);
        $data2 = array(
            'userId' => $userID,
            'movieTitle' => $RandomMovie2["title_m"]
        );

        $movies2 = $modelRequest->myRequest($data2);
        // Compte page

        $Npages = [1,2,3,4];

        return 
        [
            'flashBag' => new FlashBag(),
            'movies'   => $movies,
            'movies2'   => $movies2,
            'genres'   => $genres,
            'moviesMain' => $moviesMain,
            'Npages' => $Npages
        ];
    }

}
