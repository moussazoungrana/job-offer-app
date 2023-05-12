<?php

namespace App\Form;

use App\Data\JobOfferCrudData;
use App\Entity\Category;
use App\Entity\JobOffer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobOfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class)
            ->add('description',TextareaType::class,[
                'attr' => ['rows' => 8],
            ])
            ->add('categories',EntityType::class,[
                'class' => Category::class,
                'multiple' => true,
                'choice_label' => 'title',
                'required' => false,
            ])
            ->add('active',CheckboxType::class,[
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            //'data_class' => JobOfferCrudData::class,
        ]);
    }
}
