<?php
namespace App\Model;

use App\Service\Config;

class User
{
    private ?int $userID = null;
    private ?string $userName = null;
    private ?string $userPasswd = null;
    private ?string $role = null;

    //*****gettery i settery */
    public function getUserID(): ?int
    {
        return $this->userID;
    }

    public function setUserID(?int $id): User
    {
        $this->userID = $id;

        return $this;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(?string $userName): User
    {
        $this->userName = $userName;

        return $this;
    }

    public function getUserPasswd (): ?string
    {
        return $this->userPasswd;
    }

    public function setUserPasswd(?string $password): User
    {
        $this->userPasswd = $password;

        return $this;
    }

    public function getRole (): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): User
    {
        $this->role = $role;

        return $this;
    }
    //***********************************
    public static function fromArray($array): User
    {
        $user = new self();
        $user->fill($array);

        return $user;
    }

    public function fill($array): User
    {
        if (isset($array['userID']) && ! $this->getUserID()) {
            $this->setUserID($array['userID']);
        }
        if (isset($array['userName'])) {
            $this->setUserName($array['userName']);
        }
        if (isset($array['userPasswd'])) {
            $this->setUserPasswd($array['userPasswd']);
        }
        if (isset($array['role'])) {
            $this->setRole($array['role']);
        }

        return $this;
    }

    public static function findAll(): array
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM users';
        $statement = $pdo->prepare($sql);
        $statement->execute();

        $users = [];
        $usersArray = $statement->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($usersArray as $userArray) {
            $users[] = self::fromArray($userArray);
        }

        return $users;
    }

    public static function find($id): ?User
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM users WHERE userID = :id';
        $statement = $pdo->prepare($sql);
        $statement->execute(['userID' => $id]);

        $userArray = $statement->fetch(\PDO::FETCH_ASSOC);
        if (! $userArray) {
            return null;
        }
        $user = Post::fromArray($userArray);

        return $user;
    }

    public function save(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        if (! $this->getUserID()) {
            $sql = "INSERT INTO users (userName, userPasswd, role) VALUES (:userName, :userPasswd, :role)";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                'userName' => $this->getUserName(),
                'userPasswd' => $this->getUserPasswd(),
                'role' => $this->getRole(),
            ]);

            $this->setUserID($pdo->lastInsertId());
        } else {
            $sql = "UPDATE users SET userName = :userName, userPasswd = :userPasswd, role = :role WHERE userID = :userID";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':userName' => $this->getUserName(),
                ':userPasswd' => $this->getUserPasswd(),
                ':role' => $this->getRole(),
                ':userID' => $this->getUserID(),
            ]);
        }
    }

    public function delete(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = "DELETE FROM user WHERE userID = :userID";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            ':userID' => $this->getUserID(),
        ]);

        $this->setUserID(null);
        $this->setUserName(null);
        $this->setUserPasswd(null);
        $this->setRole(null);
    }
}
