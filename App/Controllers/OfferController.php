<?php

    namespace App\Controllers;

    use App\Models\Equipment_Offer;
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
                'announces' => $this->rm->getOfferRepo()->findByAuthor(),
                'reservations' => $this->rm->getReservationRepo()->findByReservation()
            ];

            $view->render( $view_data );
        }

        public function addAnnounces( ServerRequest $request )
        {
            $result = $request->getParsedBody();
            $equipments = '';
            if (isset( $result[ 'equipment_id' ] )) {

                $equipments = $result[ 'equipment_id' ];

            }


            $offer = new Offer( $result );


            // Recuperation du path de l'image
            $path = PATH;
            $img = $_FILES[ 'picture' ][ 'name' ];
            $pathImage = $path . $img;

            $equip = new Equipment_Offer();
            $standard = new Standard( $result );

            $standardReturnObject = RepositoryManager::getRm()->getStandardRepo()->create( $standard );
            $offerReturnObject = RepositoryManager::getRm()->getOfferRepo()->create( $offer );

            // Update de l'annonce avec l'image et les details qui lui corresponde
            RepositoryManager::getRm()->getOfferRepo()->updateOfferWithStandard(
                $standardReturnObject->id,
                $offerReturnObject->id,
                $_FILES[ 'picture' ][ 'name' ]
            );

            foreach ($equipments as $equipment) {

                $test[] = $this->rm->getEquipmentOfferRepo()->multipleCreate($equip, $equipment, $offerReturnObject->id);

            }

                // Upload du fichier dans le dossier de destination
                move_uploaded_file( $_FILES[ 'picture' ][ 'tmp_name' ], $pathImage );

                header( 'Location: /mon-espace' );
        }
    }

