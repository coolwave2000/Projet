<?php
/**
 * Created by PhpStorm.
 * User: mamadhaxor
 * Date: 05/02/2015
 * Time: 22:50
 */

namespace video\StreamBundle\Events;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;

class RegistrationConfirmListener implements EventSubscriberInterface
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
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     *
     * @api
     */
    public static function getSubscribedEvents()
    {
        // TODO: Implement getSubscribedEvents() method.
        return array(
            FOSUserEvents::REGISTRATION_CONFIRM => 'onRegistrationConfirmed'
        );
    }
    public function onRegistrationConfirmed()
    {
        $response = new Response("catched the confirmation message");
        return $response;
    }

}