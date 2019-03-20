<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Logboek", mappedBy="chauffeur")
     */
    private $logboeks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Logboek", mappedBy="user_id")
     */
    private $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->logboeks = new ArrayCollection();
        $this->user_id = new ArrayCollection();
        // your own logic
    }

    /**
     * @return Collection|Logboek[]
     */
    public function getLogboeks(): Collection
    {
        return $this->logboeks;
    }

    public function addLogboek(Logboek $logboek): self
    {
        if (!$this->logboeks->contains($logboek)) {
            $this->logboeks[] = $logboek;
            $logboek->setChauffeur($this);
        }

        return $this;
    }

    public function removeLogboek(Logboek $logboek): self
    {
        if ($this->logboeks->contains($logboek)) {
            $this->logboeks->removeElement($logboek);
            // set the owning side to null (unless already changed)
            if ($logboek->getChauffeur() === $this) {
                $logboek->setChauffeur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Logboek[]
     */
    public function getUserId(): Collection
    {
        return $this->user_id;
    }

    public function addUserId(Logboek $userId): self
    {
        if (!$this->user_id->contains($userId)) {
            $this->user_id[] = $userId;
            $userId->setUserId($this);
        }

        return $this;
    }

    public function removeUserId(Logboek $userId): self
    {
        if ($this->user_id->contains($userId)) {
            $this->user_id->removeElement($userId);
            // set the owning side to null (unless already changed)
            if ($userId->getUserId() === $this) {
                $userId->setUserId(null);
            }
        }

        return $this;
    }
}