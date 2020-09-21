<?php

class HomeController
{
    public function httpGetMethod(Http $http)
    {

        // Récupération de tous les films pour la page d'accueil 
        $movieModel = new MovieModel();
        $movies = $movieModel->allMovies();
        $moviesMain = $movieModel->allMoviesMain();

        // Récupération de tous les genres pour la page d'accueil
        $genreModel = new GenreModel();
        $genres = $genreModel->genresTop5();



        return 
        [
            'flashBag' => new FlashBag(),
            'movies'   => $movies,
            'genres'   => $genres,
            'moviesMain' => $moviesMain
        ];
    }
}
