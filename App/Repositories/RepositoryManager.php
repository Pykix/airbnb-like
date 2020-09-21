<?php

    namespace App\Repositories;

    use Core\Database;

    class RepositoryManager
    {
        private static ?self $instance = null;

        private UserRepository $user_repo;

        public function getUserRepo(): UserRepository
        {
            return $this->user_repo;
        }

        private StandardRepository $standard_repo;

        /**
         * @return StandardRepository
         */
        public function getStandardRepo(): StandardRepository
        {
            return $this->standard_repo;
        }

        private ReservationRepository $reservation_repo;

        public function getReservationRepo(): ReservationRepository
        {
            return $this->reservation_repo;
        }

        private OfferRepository $offer_repo;

        public function getOfferRepo(): OfferRepository
        {
            return $this->offer_repo;
        }


        private EquipmentOfferRepository $equipment_offer_repo;

        public function getEquipmentOfferRepo(): EquipmentOfferRepository
        {
            return $this->equipment_offer_repo;
        }


        public static function getRm(): self
        {
            if (is_null( self::$instance )) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        private function __construct()
        {
            $pdo = Database::get();

            $this->user_repo = new UserRepository( $pdo );
            $this->reservation_repo = new ReservationRepository( $pdo );
            $this->offer_repo = new OfferRepository( $pdo );
            $this->equipment_offer_repo = new EquipmentOfferRepository( $pdo );
            $this->standard_repo = new StandardRepository( $pdo );
        }

        private function __clone()
        {
        }

        private function __wakeup()
        {
        }
    }