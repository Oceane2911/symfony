<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType ::class, ['label'=> 'Nom du cours'])
            ->add('teacher',TextType ::class, ['label'=> 'Nom du professeur'])
            ->add('classroom',TextType ::class, ['label'=> 'Nom de la salle'])
            ->add('level',TextType ::class, ['label'=> 'Niveau de la classe'])
            ->add('date',DateType ::class, ['label'=> 'Date du Cours'])
            ->add('start',TimeType::class,['label'=> 'Heure du début'])
            ->add('finish',TimeType::class,['label'=> 'Heure de fin'])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
