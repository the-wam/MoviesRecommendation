<?php


class UserController
{
	public function httpGetMethod()
	{
		return [ '_form' => new UserForm(), 'movies' => array() ];
	}

	public function httpPostMethod(Http $http, array $formFields)
	{
		try
		{
			// Inscription de l'utilisateur.
            $userModel = new UserModel();
			$userModel->signUp
			(
				$formFields['login'],
				$formFields['email'],
				$formFields['password'],
				$formFields['birthYear'].'-'.
			    $formFields['birthMonth'].'-'.
			    $formFields['birthDay'],
			);
			
            $user = $userModel->findWithEmailPassword
            (
                $formFields['email'],
                $formFields['password']
            );

            // Construction de la session utilisateur.
            $userSession = new UserSession();
            $userSession->create
            (
                $user['id_u'],
                $user['login_u'],
                $user['email_u'],
                $user['level_u']
            );
            // nouveau test pour mise a jour date connection
			$userModel->updateLoginTimestamp($user['id_u']);
			
            // Redirection vers la page d'accueil.
            $http->redirectTo('/');
		}
		catch(DomainException $exception)
		{
            // Réaffichage du formulaire avec un message d'erreur.
            $form = new UserForm();
            $form->bind($formFields);
            $form->setErrorMessage($exception->getMessage());

			return [ '_form' => $form];
		}
	}
} 