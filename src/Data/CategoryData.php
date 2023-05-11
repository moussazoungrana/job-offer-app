<?php

namespace App\Data;

use App\Entity\Category;
use App\Entity\JobOffer;
use App\Form\CategoryType;
use App\Form\JobOfferType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CategoryData implements CrudInterfaceData
{
    /**
     * @Assert\NotBlank
     */
    public ?string $title = null;

    public ?string $description = null;

    private Category $entity;

    public function __construct(Category $entity)
    {
        $this->entity = $entity;
        $this->title = $entity->getTitle();
        $this->description = $entity->getDescription();
    }

    public function hydrate(): void
    {
        $this->entity->setTitle($this->title);
        $this->entity->setDescription($this->description);
    }

    public function getEntity(): Category
    {
        return $this->entity;
    }

    public function getFormClass(): string
    {
        return CategoryType::class;
    }


    public function setEntityManager(EntityManagerInterface $em): self
    {
        $this->em = $em;

        return $this;
    }
}