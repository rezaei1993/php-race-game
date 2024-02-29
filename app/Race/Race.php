<?php
namespace App\Race;

use App\Vehicle\Vehicle;

class Race
{
    private array $vehicles = [];
    public int $distance = 1000;

    public function __construct()
    {
        $this->loadVehicles();
    }

    /**
     * @return void
     */
    private function loadVehicles(): void
    {
        $vehiclesData = json_decode(file_get_contents(__DIR__ . '/../../assets/vehicles.json'), true);

        foreach ($vehiclesData as $data) {
            $vehicle = new Vehicle(
                $data['name'],
                $data['maxSpeed'],
                $data['unit']
            );


            $this->vehicles[] = $vehicle;
        }
    }

    /**
     * @return void
     */
    public function start(): void
    {
        echo "Welcome to Racing Game!\n";

    }


}
