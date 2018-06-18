<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Form\Type\QuestionType;

class QuestionnaireType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
	  $builder->add('titre')
                ->add('publie')
                ->add('thematique')
                ->add('questions', CollectionType::class, array(
                    'entry_type'   => QuestionType::class,
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false
                ));
    }
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Questionnaire',
        ));
    }
}
