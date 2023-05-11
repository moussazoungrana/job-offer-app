<?php

namespace App\Data;

use App\Entity\JobOffer;
use App\Form\JobOfferType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints as Assert;

class JobOfferData implements CrudInterfaceData
{
    /**
     * @Assert\NotBlank
     */
    public ?string $title = null;
    /**
     * @Assert\NotBlank
     */
    public ?string $description = null;

    public bool $active = false;


    private JobOffer $entity;

    public function __construct(JobOffer $entity)
    {
        $this->entity = $entity;
        $this->title = $entity->getTitle();
        $this->description = $entity->getDescription();
        $this->active = $entity->isActive();
    }

    public function hydrate(): void
    {
        $this->entity->setTitle($this->title);
        $this->entity->setDescription($this->description);
        $this->entity->setActive($this->active);
    }

    public function getEntity(): JobOffer
    {
        return $this->entity;
    }

    public function getFormClass(): string
    {
        return JobOfferType::class;
    }


    public function setEntityManager(EntityManagerInterface $em): self
    {
        $this->em = $em;

        return $this;
    }
}