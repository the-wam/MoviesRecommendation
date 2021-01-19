<?php


class ActorsController
{
	public function httpGetMethod()
	{
        // Récupération la liste des acteurs
        $actorModel = new ActorModel();
        $listOfActors = $actorModel->allActors();

        return 
        [
            "listOfActors" => $listOfActors,
            "movies" => array()
        ];
 
	}
}