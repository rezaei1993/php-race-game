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
        $vehiclesData = json_decode(file_get_contents(__DIR__.'/../../assets/vehicles.json'), true);

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

        $vehicleChoices = $this->getVehicleChoices();

        $player1Vehicle = $this->promptForVehicle($vehicleChoices, 'Player 1');
        $player2Vehicle = $this->promptForVehicle($vehicleChoices, 'Player 2');
    }


    /**
     * @param array $choices
     * @param string $playerName
     * @return Vehicle
     */
    private function promptForVehicle(array $choices, string $playerName): Vehicle
    {
        $choice = \cli\menu($choices, null, "{$playerName}, please choose your vehicle:");
        return $this->vehicles[$choice];
    }

    /**
     * @return array
     */
    private function getVehicleChoices(): array
    {
        $vehicleChoices = [];
        foreach ($this->vehicles as $vehicle) {
            $vehicleChoices[] = "{$vehicle->name}";
        }
        return $vehicleChoices;
    }
}
