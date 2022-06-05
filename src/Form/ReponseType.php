<?php

namespace App\Form;

use App\Entity\Messages;
use App\Entity\Users;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ReponseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('message',TextareaType::class, [

                'attr'=> [
                    'class'=>'form-control'
                ]
            ])
        ->add('recipient', EntityType::class, [
            'class' => Users::class,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('u')
                    ->orderBy('u.email', 'ASC');
            },
            'choice_label' => 'email',
            'multiple' => false,
            'required' => false
        ])
        ;
    }

 
}
