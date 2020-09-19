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
    }