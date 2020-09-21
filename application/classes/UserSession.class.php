<?php


class UserSession
{
	public function __construct()
	{
		if(session_status() == PHP_SESSION_NONE)
		{
            // Démarrage du module PHP de gestion des sessions.
			session_start();
		}
	}

    public function create($id_u, $login, $email, $level)
    {
        // Construction de la session utilisateur.
        $_SESSION['user'] =
        [
            'id_u'      => $id_u,
            'login'     => $login,
            'Email'     => $email,
            'level'     => $level
        ];
    }

    public function destroy()
    {
        // Destruction de l'ensemble de la session.
        $_SESSION = array();
        session_destroy();
    }

    public function getEmail()
    {
        if($this->isAuthenticated() == false) {
            return null;
        }
        return $_SESSION['user']['Email'];
    }
    
    public function getLevel()
    {
        if($this->isAuthenticated() == false) {
            return null;
        }

        return $_SESSION['user']['level'];
    }


    public function getLogin() {
        if($this->isAuthenticated() == false)
        {
            return null;
        }
        return $_SESSION['user']['login'];
    }


    public function getUserId() {
        if($this->isAuthenticated() == false)
        {
            return null;
        }
        return $_SESSION['user']['id_u'];
    }


	public function isAuthenticated()
	{
		if(array_key_exists('user', $_SESSION) == true)
		{
            if (empty($_SESSION['user']) == false) {
				return true;
            }
        }
		return false;
	}
}