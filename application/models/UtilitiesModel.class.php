<?php

class Utilities
{
    public function listGenres($array)
    {
        
        $genres = array()
        foreach ($array as $row) {
            array_push($genres, row["genres"])
        }


        return array_unique($genres)
    }
}