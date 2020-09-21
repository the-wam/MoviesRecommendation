<?php


class GenresController
{
	public function httpGetMethod()
	{
        // list de tous les genres
        $genreModel = new GenreModel();
        $listOfGenres = $genreModel->allGenres();

        return 
        [
            "listOfGenres" => $listOfGenres,
            "movies" => array()
        ];
        
	}
}