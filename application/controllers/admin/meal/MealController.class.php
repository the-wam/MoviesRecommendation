<?php


class MealController
{
    public function httpGetMethod(Http $http)
    {
        $userSession = new UserSession();
        if($userSession->getAdmin() != 33)
        {
           $http->redirectTo('/user/login');
        }
        $mealModel = new MealModel();
        $meals     = $mealModel->listAll();

        return
        [
            'flashBag' => new FlashBag(),
            'meals'    => $meals,
        ];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        $userSession = new UserSession();
        if($userSession->getAdmin() != 33)
        {
           $http->redirectTo('/user/login');
        }

        if($http->hasUploadedFile('photo') == true)
        {
            $photo = $http->moveUploadedFile('photo', '/images/meals');
        }
        else
        {
            $photo = 'no-photo.png';
        }

        if(empty($formFields['name']) == false) {
            $mealModel = new MealModel();
            $mealModel->create
            (
                $formFields['name'],
                $formFields['description'],
                $photo,
                $formFields['initialStock'],
                $formFields['buyPrice'],
                $formFields['salePrice']
            );

            $http->redirectTo('/admin');
        }

        // récup le name de chaque meal checked et push in $meals 

        array_push($meals, $formFields['name']);

        return $meals;
    }
}