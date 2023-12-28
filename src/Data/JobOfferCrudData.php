<?php

namespace App\Data;

use App\Entity\Category;
use App\Entity\JobOffer;
use App\Form\JobOfferType;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints as Assert;

class JobOfferCrudData implements CrudInterfaceData
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

    /**
     * @return Collection<int, Category>
     */
    public Collection $categories;

    private JobOffer $entity;

    public function __construct(JobOffer $entity)
    {
        $this->entity = $entity;
        $this->title = $entity->getTitle();
        $this->description = $entity->getDescription();
        $this->active = $entity->isActive();
        $this->categories = $entity->getCategories();
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


}