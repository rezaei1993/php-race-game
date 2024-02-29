<?php
namespace App\Vehicle;
class Vehicle
{
    public string $name;
    public float $maxSpeed;
    public string $unit;

    public function __construct(string $name, float $maxSpeed, string $unit)
    {
        $this->name = $name;
        $this->maxSpeed = $maxSpeed;
        $this->unit = $unit;
    }

    /**
     * @param float $distance
     * @return float
     */
    public function getTimeToComplete(float $distance): float
    {
        return $distance / $this->convertMaxSpeedToKm();
    }
    /**
     * @return float
     */
    public function convertMaxSpeedToKm(): float
    {
        return match (strtolower($this->unit)) {
            'km/h' => $this->maxSpeed,
            'kts', 'knots' => $this->maxSpeed * 1.85200,
            default => throw new \InvalidArgumentException("Unknown unit {$this->unit}"),
        };
    }
}