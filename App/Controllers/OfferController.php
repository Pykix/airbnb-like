<?php

    namespace App\Controllers;

    use App\Models\Offer;
    use App\Models\Standard;
    use App\Models\User;
    use App\Repositories\RepositoryManager;
    use Core\Controller;
    use Core\View;

    use DateTime;
    use Zend\Diactoros\ServerRequest;

    class OfferController extends Controller
    {
        public function show( $id ): void
        {

            // TODO changer le mode de redirection
            if (!isset( $_SESSION[ 'username' ] )) {
                header( 'Location: /login' );
            }

            $view = new View( 'detail' );

            $view_data = [
                'html_title' => 'Welc-Home - detail',
                'details' => $this->rm->getOfferRepo()->details( $id ),
                'equipment' => $this->rm->getEquipmentOfferRepo()->equipmentDetails( $id )
            ];

            $view->render( $view_data );
        }

        public function myAnnounces()
        {
            $view = new View( 'mon-espace' );

            $view_data = [
                'html_title' => 'Welc-Home - Mes Annonces',
                'html_h1' => $_SESSION[ 'username' ],
                'announces' => $this->rm->getOfferRepo()->findByAuthor()
            ];

            $view->render( $view_data );
        }

        public function addAnnounces(ServerRequest $request)
        {
            $result = $request->getParsedBody();

            $equipments = $result['equipment_id'];
            
            $offer = new Offer($result);
            $standard = new Standard($result);
            $standardReturnObject = RepositoryManager::getRm()->getStandardRepo()->create($standard);
            $offerReturnObject = RepositoryManager::getRm()->getOfferRepo()->create($offer);
            RepositoryManager::getRm()->getOfferRepo()->updateOfferWithStandard($standardReturnObject->id, $offerReturnObject->id);

            header('Location: /mon-espace');
        }

    }

