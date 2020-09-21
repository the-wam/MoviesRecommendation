<?php


class DirectorsController
{
	public function httpGetMethod()
	{

        // Récupération de tous les directors
        $directorModel = new DirectorModel();
        $listOfDirectors = $directorModel->allDirectors();

        return 
        [
            "listOfDirectors" => $listOfDirectors,
            "movies" => array()
        ];
        
	}
}