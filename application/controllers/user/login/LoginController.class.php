<?php


class LoginController
{
	public function httpGetMethod()
	{
        return [ '_form' => new LoginForm(),
                    'movies' => array()];
	}

	public function httpPostMethod(Http $http, array $formFields)
	{
		try
		{
            // Récupération de l'utilisateur en fonction de ses identifiants.
            $userModel = new UserModel();
            $user      = $userModel->findWithEmailPassword
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
                $user['lastConnection_u']
            );
            // nouveau test pour mise a jour date connection
            $userModel->updateLoginTimestamp($user['id_u']);

            // Redirection vers la page d'accueil.
            $http->redirectTo('/');
		}
		catch(DomainException $exception)
		{
            // Réaffichage du formulaire avec un message d'erreur.
            $form = new LoginForm();
            $form->bind($formFields);
            $form->setErrorMessage($exception->getMessage());

			return [ '_form' => $form, 'movies' => array() ];
		}
	}
}