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
        return $this->ogVersion;
    }

    public function setLinkPasswd(?string $linkPasswd): Link
    {
        $this->linkPasswd = $linkPasswd;

        return $this;
    }
    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->createDate;
    }

    public function setCreateDate(?\DateTimeInterface $createDate): Link
    {
        $this->createDate = $createDate;

        return $this;
    }

    public function getEditDate(): ?\DateTimeInterface
    {
        return $this->editDate;
    }

    public function setEditDateDate(?\DateTimeInterface $editeDate): Link
    {
        $this->editDate = $editDate;

        return $this;
    }

    public function getLastVisitDate(): ?\DateTimeInterface
    {
        return $this->lastVisitDate;
    }

    public function setLastVisitDate(?\DateTimeInterface $lastVisitDate): Link
    {
        $this->lastVisitDate = $lastVisitDate;

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
    public function getLifetime(): ?\DateTimeInterface
    {
        return $this->lifetime;
    }

    public function setLifetime(?\DateTimeInterface $lifetime): Link
    {
        $this->lifetime = $lifetime;

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
            $this->setShortVersion($array['shortVersion']);
        }
        if (isset($array['linkPasswd'])) {
            $this->setLinkPasswd($array['linkPasswd']);
        }
        if (isset($array['createDate'])) {
            $this->setCreateDate($array['createDate']);
        }
        if (isset($array['editDate'])) {
            $this->setEditDateDate($array['editDate']);
        }
        if (isset($array['lastVisitDate'])) {
            $this->setLastVisitDate($array['lastVisitDate']);
        }
        if (isset($array['numOfVisits'])) {
            $this->setNumOfVisits($array['numOfVisits']);
        }
        if (isset($array['lifetime'])) {
            $this->setLifetime($array['lifetime']);
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
        $link = Post::fromArray($linkArray);

        return $link;
    }

    public function save(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        if (! $this->getLinkID()) {
            $sql = "INSERT INTO link (linkID ,ogVersion ,shortVersion ,linkPasswd ,createDate ,editDate ,lastVisitDate ,numOfVisits ,lifetime ,userID ) 
            VALUES (:linkID, :ogVersion,:shortVersion,:linkPasswd,:createDate,:editDate,:lastVisitDate,:numOfVisits,:lifetime,:userID)";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                'linkID'        => $this->getLinkID(),
                'ogVersion'     => $this->getOgVersion(),
                'shortVersion'  => $this->getShortVersion(),
                'linkPasswd'    => $this->getLinkPasswd(),
                'createDate'    => $this->getCreateDate(),
                'editDate'      => $this->getEditDate(),
                'lastVisitDate' => $this->getLastVisitDate(),
                'numOfVisits'   => $this->getNumOfVisits(),
                'lifetime'      => $this->getLifetime(),
                'userID'        => $this->getUserID(),
            ]);

            $this->setLinkID($pdo->lastInsertId());
        } else {
            $sql = "UPDATE post SET  ogVersion  = :ogVersion ,shortVersion  = :shortVersion,linkPasswd  = :linkPasswd ,
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
        $this->setCreateDate(null);
        $this->setEditDate(null);
        $this->setLastVisitDate(null);
        $this->setNumOfVisits(null);
        $this->setLifetime(null);
        $this->setUserID(null);
    }
}
