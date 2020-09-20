<?php


    namespace App\Controllers;


    use App\Models\Reservation;
    use App\Repositories\RepositoryManager;
    use Core\View;
    use Zend\Diactoros\ServerRequest;

    class ReservationController
    {
        public function register(ServerRequest $request): void
        {

            $view = new View('reservation');

            $results = $request->getParsedBody();

            $newReservation = new Reservation($results);

            $reservation = RepositoryManager::getRm()->getReservationRepo()->create($newReservation);
            if (isset($reservation->id)) {
               $view->render(
                   [
                       'offer_id' => $reservation->id
                   ]
               );
            }

        }


        /**
         * Affiche les reservation des users
         */
        public function show():void
        {
            $view = new View('mes-reservations');
            $show = RepositoryManager::getRm()->getReservationRepo()->findReservation();
            $view->render(
                [
                    'html_title' => 'Vos reservations',
                    'html_h1' => $_SESSION['username'],
                    'reservationDetail' => $show
                ]
            );

        }
    }