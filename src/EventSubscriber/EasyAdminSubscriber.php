<?php
    namespace App\EventSubscriber;
    use App\Entity\Projet;
    use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
    use Symfony\Component\EventDispatcher\EventSubscriberInterface;

    class EasyAdminSubscriber implements EventSubscriberInterface
    {
        // private $slugger;

        // public function __construct($slugger)
        // {
        //     $this->slugger = $slugger;
        // }

        public static function getSubscribedEvents()
        {
            return [
                BeforeEntityPersistedEvent::class => ['setSlugEvent'],
            ];
        }

        public function setSlugEvent(BeforeEntityPersistedEvent $event)
        {
            $entity = $event->getEntityInstance();

            if (!($entity instanceof Projet)) {
                return;
            }

            $slug = str_replace(" ","-",strtolower($entity->getTitle()));
            $entity->setSlug($slug);
        }
    }