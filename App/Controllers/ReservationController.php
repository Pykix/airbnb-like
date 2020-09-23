<?php


    namespace App\Controllers;


    use App\Models\Reservation;
    use App\Repositories\RepositoryManager;
    use Core\View;
    use Zend\Diactoros\ServerRequest;

    class ReservationController
    {

        /**
         * Enregistrement d'une reservation d'annonce
         *
         * @param ServerRequest $request
         */
        public function register( ServerRequest $request ): void
        {

            $view = new View( 'reservation' );

            $results = $request->getParsedBody();

            $newReservation = new Reservation( $results );

            $reservation = RepositoryManager::getRm()->getReservationRepo()->create( $newReservation );
            if (isset( $reservation->id )) {
                $view->render(
                    [
                        'offer_id' => $reservation->id
                    ]
                );
            }

        }

        /**
         * Suppression d'une reservation
         *
         * @param $id
         */
        public function delete( $id )
        {
            RepositoryManager::getRm()->getEquipmentOfferRepo()->delete($id);
            RepositoryManager::getRm()->getReservationRepo()->delete( $id );
            if ($_SESSION[ 'role' ] == 0) {
                header( 'Location: /mon-espace' );
            }
            header( 'Location: /mes-reservations' );
        }

        /**
         * Affiche les reservation des users
         */
        public function show(): void
        {
            $view = new View( 'mes-reservations' );
            $show = RepositoryManager::getRm()->getReservationRepo()->findReservation();
            $view->render(
                [
                    'html_title' => 'Vos reservations',
                    'html_h1' => $_SESSION[ 'username' ],
                    'reservationDetail' => $show
                ]
            );

        }
    }