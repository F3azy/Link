<?php
namespace App\Model;

use App\Service\Config;

class Link
{
    private ?int $linkID = null;
    private ?string $ogVersion = null;
    private ?string $shortVersion = null;
    private ?string $linkPasswd = null;
    private ?\DateTimeInterface $createDate = null;
    private ?\DateTimeInterface $editDate = null;
    private ?\DateTimeInterface $lastVisitDate = null;
    private ?int $numOfVisits = null;
    private ?\DateTimeInterface $lifetime = null;
    private ?int $userID = null;

    //*****gettery i settery */
    public function getLinkID(): ?int
    {
        return $this->linkID;
    }

    public function setLinkID(?int $id): Link
    {
        $this->linkID = $id;

        return $this;
    }

    public function getOgVersion(): ?string
    {
        return $this->ogVersion;
    }

    public function setOgVersion(?string $ogVersion): Link
    {
        $this->ogVersion = $ogVersion;

        return $this;
    }

    public function getShortVersion(): ?string
    {
        return $this->shortVersion;
    }

    public function setShortVersion(?string $shortVersion): Link
    {
        $this->shortVersion = $shortVersion;

        return $this;
    }
    public function getLinkPasswd(): ?string
    {
        return $this->linkPasswd;
    }

    public function setLinkPasswd(?string $linkPasswd): Link
    {
        $this->linkPasswd = $linkPasswd;

        return $this;
    }
    public function getCreateDate(): ?string
    {
        $date = $this->createDate->format('Y-m-d H:m:s');
        return $date;
    }

    public function setCreateDate(?string $createDate): Link
    {
        $date = new \DateTime($createDate);
        $this->createDate = $date;

        return $this;
    }

    public function getEditDate(): ?string
    {
        $date = $this->editDate->format('Y-m-d H:m:s');
        return $date;
    }

    public function setEditDateDate(?\DateTimeInterface $editDate): Link
    {
        $date = new \DateTime($editeDate);
        $this->editDate = $date;

        return $this;
    }

    public function getLastVisitDate(): ?string
    {
        $date = $this->lastVisitDate->format('Y-m-d H:m:s');
        return $date;
    }

    public function setLastVisitDate(?string $lastVisitDate): Link
    {
        $date = new \DateTime($lastVisitDate);
        $this->lastVisitDate = $date;

        return $this;
    }
    public function getNumOfVisits(): ?int
    {
        return $this->numOfVisits;
    }

    public function setNumOfVisits(?int $numOfVisits): Link
    {
        $this->numOfVisits = $numOfVisits;

        return $this;
    }
    public function getLifetime(): ?string
    {
        $date = $this->lastVisitDate->format('Y-m-d H:m:s');
        return $date;
    }

    public function setLifetime(?string $lifetime): Link
    {
        $date = new \DateTime($lifetime);
        $this->lifetime = $date;

        return $this;
    }

    public function getUserID(): ?int
    {
        return $this->userID;
    }
    public function setUserID(?int $id): ?Link
    {
        $this->userID = $id;

        return $this;
    }

 //***********************************
    
    //Create a random link
    private function randomLink() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        $length = rand(4,10);
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    private function createCheckShortLink() {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM links WHERE shortVersion = :randString';
        $statement = $pdo->prepare($sql);

        do {
            $randomString = $this->randomLink();
            $statement->execute(['randString' => $randomString]);
            $linkArray = $statement->fetch(\PDO::FETCH_ASSOC);
        }while($linkArray);

        return $randomString;
    }

    public static function fromArray($array): Link
    {
        $link = new self();
        $link->fill($array);

        return $link;
    }

    public function fill($array): Link
    {
        if (isset($array['linkID']) && ! $this->getLinkID()) {
            $this->setLinkID($array['linkID']);
        }
        if (isset($array['ogVersion'])) {
            $this->setOgVersion($array['ogVersion']);
        }
        if (isset($array['shortVersion'])) {
            if(empty($array['shortVersion'])) {
                $this->setShortVersion($this->createCheckShortLink());
            }
            else {
                $this->setShortVersion($array['shortVersion']);
            }
        }
        if (isset($array['linkPasswdCheck']) && !empty($array['linkPasswdCheck']) && $array['linkPasswdCheck'] == "True") {
            if(isset($array['linkPasswd'])) {
                $this->setLinkPasswd($array['linkPasswd']);
            }
        }
        else {
            $this->setLinkPasswd("");
        }
        if (isset($array['createDate'])) {
            $this->setCreateDate(new \DateTime($array['createDate']));
        }
        if (isset($array['editDate'])) {
            $this->setEditDateDate(new \DateTime($array['editDate']));
        }
        if (isset($array['lastVisitDate'])) {
            $this->setLastVisitDate(new \DateTime($array['lastVisitDate']));
        }
        if (isset($array['numOfVisits'])) {
            $this->setNumOfVisits($array['numOfVisits']);
        }
        if (isset($array['lifetime'])) {
            $this->setLifetime(new \DateTime($array['lifetime']));
        }
        if (isset($array['userID'])) {
            $this->setUserID($array['userID']);
        }
        return $this;
    }

    public static function findAll(): array
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM links';
        $statement = $pdo->prepare($sql);
        $statement->execute();

        $links = [];
        $linksArray = $statement->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($linksArray as $linkArray) {
            $links[] = self::fromArray($linkArray);
        }

        return $links;
    }

    public static function find($id): ?Link
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM links WHERE linkID = :id';
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $id]);

        $linkArray = $statement->fetch(\PDO::FETCH_ASSOC);
        if (! $linkArray) {
            return null;
        }
        $link = Link::fromArray($linkArray);

        return $link;
    }
    public static function findLinksOfUser($userid): ?array
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM links WHERE userID = :userid';
        $statement = $pdo->prepare($sql);
        $statement->execute(['userid' => $userid]);

        $links = [];
        $linksArray = $statement->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($linksArray as $linkArray) {
            $links[] = self::fromArray($linkArray);
        }

        return $links;
    }
    public static function findByShortName($shortName): ?Link
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM links WHERE shortVersion = :shortVersion';
        $statement = $pdo->prepare($sql);
        $statement->execute(['shortVersion' => $shortName]);

        $linkArray = $statement->fetch(\PDO::FETCH_ASSOC);
        if (! $linkArray) {
            return null;
        }
        $link = Link::fromArray($linkArray);

        return $link;
    }

    public static function findByFullName($fullName): ?Link
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM links WHERE ogVersion = :ogversion';
        $statement = $pdo->prepare($sql);
        $statement->execute(['ogversion' => $fullName]);

        $linkArray = $statement->fetch(\PDO::FETCH_ASSOC);
        if (! $linkArray) {
            return null;
        }
        $link = Link::fromArray($linkArray);

        return $link;
    }
    public function save(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        if (! $this->getLinkID()) {
            $sql = "INSERT INTO links (linkID ,ogVersion ,shortVersion ,linkPasswd ,createDate ,editDate ,lastVisitDate ,numOfVisits ,lifetime ,userID ) 
            VALUES (:linkID, :ogVersion,:shortVersion,:linkPasswd,:createDate,:editDate,:lastVisitDate,:numOfVisits,:lifetime,:userID)";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                'linkID'        => $this->getLinkID(),
                'ogVersion'     => $this->getOgVersion(),
                'shortVersion'  => $this->getShortVersion(),
                'linkPasswd'    => $this->getLinkPasswd(),
                'createDate'    => $this->getCreateDate()->format('Y-m-d H:i:s'),
                'editDate'      => $this->getEditDate()->format('Y-m-d H:i:s'),
                'lastVisitDate' => $this->getLastVisitDate()->format('Y-m-d H:i:s'),
                'numOfVisits'   => $this->getNumOfVisits(),
                'lifetime'      => $this->getLifetime()->format('Y-m-d H:i:s'),
                'userID'        => $this->getUserID(),
            ]);

            $this->setLinkID($pdo->lastInsertId());
        } else {
            $sql = "UPDATE links SET  ogVersion  = :ogVersion ,shortVersion  = :shortVersion,linkPasswd  = :linkPasswd ,
                    createDate  = :createDate ,editDate  = :editDate ,lastVisitDate  = :lastVisitDate ,
                    numOfVisits  = :numOfVisits ,lifetime  = :lifetime ,userID  = :userID WHERE linkID = :linkID";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':linkID'       => $this->getLinkID(),
                ':ogVersion'    => $this->getOgVersion(),
                ':shortVersion' => $this->getShortVersion(),
                ':linkPasswd'   => $this->getLinkPasswd(),
                ':createDate'   => $this->getCreateDate(),
                ':editDate'     => $this->getEditDate(),
                ':lastVisitDate'=> $this->getLastVisitDate(),
                ':numOfVisits'  => $this->getNumOfVisits(),
                ':lifetime'     => $this->getLifetime(),
                ':userID'       => $this->getUserID(),
            ]);
        }
    }

    public function delete(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = "DELETE FROM links WHERE linkID = :linkID";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            ':linkID' => $this->getLinkID(),
        ]);

        $this->setLinkID(null);
        $this->setOgVersion(null);
        $this->setShortVersion(null);
        $this->setLinkPasswd(null);
        $this->setCreateDate(new \DateTime(null));
        $this->setEditDate(new \DateTime(null));
        $this->setLastVisitDate(new \DateTime(null));
        $this->setNumOfVisits(null);
        $this->setLifetime(new \DateTime(null));
        $this->setUserID(null);
    }
}
