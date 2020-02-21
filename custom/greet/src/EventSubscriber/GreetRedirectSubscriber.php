<?php
namespace Drupal\greet\EventSubscriber;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Drupal\Core\Routing\TrustedRedirectResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Url;
use Drupal\Core\Routing\RouteMatchInterface;

class GreetRedirectSubscriber implements EventSubscriberInterface {
    protected $currentUser;

    protected $currentRouteMatch;

    public function __construct(AccountProxyInterface $currentUser, RouteMatchInterface $currentRouteMatch) {
        $this->currentUser = $currentUser;
        $this->currentRouteMatch = $currentRouteMatch;
    }
    public static function getSubscribedEvents() {
        $events['kernel.request'][] = array('onRequest', 1);
        return $events;
    }

    /**
     * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
     */
    public function onRequest(GetResponseEvent $event) {
        // return;
        // kint($this->currentRouteMatch->getRouteName()); exit();

        // $request = $event->getRequest();
        // $path = $request->getPathInfo();

        if($this->currentRouteMatch->getRouteName() !== 'greet.default_controller_sayhi') {
            return;
        }

        $roles = $this->currentUser->getRoles();
        if(in_array('authenticated', $roles)) {
            $event->setResponse(new RedirectResponse(''));
        }
    }
    
    // /**
    //  * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
    //  */
    // public function onRequest2(GetResponseEvent $event) {
    //     $request = $event->getRequest();
    //     $path = $request->getPathInfo();

    //     if($path !== 'greet') {
    //         return;
    //     }

    //     $roles = $this->currentUser->getRoles();
    //     if(in_array('authenticated', $roles)) {
    //         $event->setResponse(new RedirectResponse('/'));
    //     }
    // }
}