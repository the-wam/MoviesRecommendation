<?php


class UserModel
{
    public function find($userId)
    {
    	$database = new Database();

    	// Récupération de l'utilisateur spécifié.
    	return $database->queryOne
    	(
    		"SELECT
    			id_u,
    			login_u,
				email_u,
				password_u,
				creationTimestamp_u,
				lastConnection_u,
                level_u
			FROM Users
			WHERE id_u = ?",
    		[ $userId ]
    	);
    }

    public function findWithEmailPassword($email, $password)
    {
        $database = new Database();

        // Récupération de l'utilisateur ayant l'email spécifié en argument.
        $user = $database->queryOne
        (
    		"SELECT
    			id_u,
    			login_u,
				email_u,
				password_u,
				creationTimestamp_u,
				lastConnection_u,
                level_u
			FROM Users
			WHERE email_u = ?",
    		[ $email ]
        );

        // Est-ce qu'on a bien trouvé un utilisateur ?
        if(empty($user) == true || $this->verifyPassword($password, $user['password_u']) == false)
        {
            throw new DomainException
            (
                "Le mot de passe ou email spécifié sont incorrect voir les DEUX !"
            );
        }
      

		return $user;
    }

    private function hashPassword($password)
    {

        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function signUp(
        $login_u,
        $email_u,
        $password_u,
        $birthDate)
    {
        $database = new Database();

        // On vérifie qu'il y a un utilisateur avec l'adresse e-mail spécifiée.
        $user = $database->queryOne
        (
            "SELECT id_u FROM Users WHERE email_u = ? or login_u = ?", [ $email_u, $login_u ]
        );

        // Est-ce qu'on a bien trouvé un utilisateur ?
        if(empty($user) == false)
        {
            throw new DomainException
            (
                "Il existe déjà un compte utilisateur avec cette adresse e-mail ou ce login"
            );
        }
        $date = date('Y-m-d');
        /*
         * Hachage du mot de passe, le mot de passe en clair n'est JAMAIS enregistré
         * et ne pourra JAMAIS être récupéré.
         */
        $passwordHash = $this->hashPassword($password_u);

        $sql = "INSERT INTO Users
		(
            login_u,
            email_u,
            password_u,
            creationTimestamp_u,
            lastConnection_u,
            birthDate_u
		) VALUES (?, ?, ?, ?, ?, ?)";

        $val = [
            $login_u,
            $email_u,
            $passwordHash,
            $date,
            $date,
            $birthDate
        ];

        // Insertion de l'utilisateur dans la base de données.
        $database->executeSql($sql,$val);

        // Ajout d'un message de notification qui s'affichera sur la page d'accueil.
        $flashBag = new FlashBag();
        $flashBag->add('Votre compte utilisateur a bien été créé.');
    }

    public function updateLoginTimestamp($userId)
    {
        // Mise à jour de la date de dernière connexion pour cet utilisateur.
        $database = new Database();
        $database->executeSql
        (
            "UPDATE Users SET lastConnection_u = NOW()	WHERE id_u = ?",
            [ $userId ]
        );
    }

	private function verifyPassword($password, $hashedPassword)
	{
        // Si le mot de passe en clair est le même que la version hachée alors renvoie true.
		return password_verify($password, $hashedPassword);
	}
    public function selectAll()
    {
        $database = new Database();

        $users = $database->query(
            "SELECT LastName, FirstName, Email, level_u FROM User"
            );
        return $users;
    }
}