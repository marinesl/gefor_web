<?php

namespace Database\Factories;

use App\Models\Cours;
use DateMalformedStringException;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cours>
 */
class CoursFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws DateMalformedStringException
     */
    public function definition(): array
    {
        $local = 'fr_FR';

        // One base DateTime for the course start
        $start = fake($local)->dateTimeBetween('-1 year', '+1 year');

        // Add between 120 and 240 minutes for the end time
        $end = (clone $start)->modify('+' . fake($local)->numberBetween(120, 240) . ' minutes');

        // Date of validation exist only if the course is validated
        $valide = fake($local)->boolean();
        $date_validation = $valide ? (clone $start)->modify('+' . fake($local)->numberBetween(10, 60) . ' minutes') : null;

        return [
            'matiere'        => 'Cours de ' . fake($local)->word(),
            'date'           => $start->format('Y-m-d'),
            'heure_debut'    => $start->format('H:i:s'),
            'heure_fin'      => $end->format('H:i:s'),
            'salle'          => 'Salle ' . fake($local)->numberBetween(1, 10),
            'date_validation'=> $date_validation,
            'valide'         => $valide,
        ];
    }
}
