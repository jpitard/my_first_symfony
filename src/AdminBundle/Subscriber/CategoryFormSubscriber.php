<?php
/**
 * Created by PhpStorm.
 * User: wamobi8
 * Date: 20/01/17
 * Time: 09:41
 */

namespace AdminBundle\Subscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\NotBlank;

class CategoryFormSubscriber implements EventSubscriberInterface
{

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        // TODO: Implement getSubscribedEvents() method.
        return[
            FormEvents::POST_SET_DATA => 'postSetData'
        ];
    }

    public function postSetData(FormEvent $events){
        //$events contient l'entité et le builder(form
        $entity = $events->getData();
        $form = $events->getForm();
        if ($entity->getId()){
            $form->remove('position');
            $form->add('description');
        }else{
            $form->add('description', TextareaType::class, [
                'constraints'=> [
                    new NotBlank([
                        'message' => 'La description est vide'
                    ])
                ]
            ]);
        }
        //dump($events); exit ;
    }
}