<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Recipient;
use App\Form\AddressType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class RecipientType extends AbstractType
{
    private $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (!$builder->getEmptyData()) {
            $builder->setAction($this->urlGenerator->generate('cart-editRecipient', ['id' => $builder->getData()->getId()]));
        } else {
//            $builder->setAction($this->urlGenerator->generate('cart-new-recipient'));
            $builder->setAction($this->urlGenerator->generate('cart-editRecipient', ['id' => $builder->getData()->getId()]));
        }
        $builder
            ->add('id', HiddenType::class,[
                // ha hidden mezőről van szó, ami maga az ID, akkor azt nem szabad map-elni az entityvel.
                'mapped' => false,
            ])
            ->add('name', TextType::class,[
                'label' => 'Címzett',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Szabó János',
                    'autocomplete' => 'name'
                ]
            ])
            ->add('address',AddressType::class,[
                'label' => false,
            ])
            ->add('phone',IntegerType::class,[
                'label' => 'Telefonszám',
                'required' => false,
            ])
            ->add('customer',HiddenType::class,[
                'mapped' => false
            ])
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipient::class,
            'attr' => ['novalidate' => 'novalidate'],
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }


}