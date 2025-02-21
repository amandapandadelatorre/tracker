<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $activities = [
            [
                'name' => 'Apple Rings',
                'type' => 'text',
                'description' => 'Track your daily Apple Watch rings progress',
                'options' => [
                    'fields' => [
                        ['name' => 'move', 'type' => 'integer'],
                        ['name' => 'exercise', 'type' => 'integer'],
                        ['name' => 'stand', 'type' => 'integer'],
                    ]
                ],
            ],
            [
                'name' => 'Appointment',
                'type' => 'text',
                'description' => 'Track appointments and meetings',
            ],
            [
                'name' => 'Bedtime Routine',
                'type' => 'multiselect',
                'description' => 'Track your bedtime routine tasks',
                'options' => [
                    'choices' => [
                        'showered',
                        'brushed teeth',
                        'brushed hair',
                        'took medications',
                        'took vitamins',
                    ]
                ],
            ],
            [
                'name' => 'Event',
                'type' => 'text',
                'description' => 'Track notable events throughout your day',
            ],
            [
                'name' => 'Gratitude',
                'type' => 'text',
                'description' => 'Write what you are grateful for',
            ],
            [
                'name' => 'Chores',
                'type' => 'multiselect',
                'description' => 'Track completed household chores',
                'options' => [
                    'choices' => [
                        'dishes',
                        'laundry',
                        'bathroom',
                        'kitchen',
                        'bedrooms',
                    ]
                ],
            ],
            [
                'name' => 'Morning Routine',
                'type' => 'multiselect',
                'description' => 'Track your morning routine tasks',
                'options' => [
                    'choices' => [
                        'showered',
                        'brushed teeth',
                        'brushed hair',
                        'took medications',
                        'took vitamins',
                    ]
                ],
            ],
            [
                'name' => 'One Line',
                'type' => 'text',
                'description' => 'Write one line about your day',
            ],
            [
                'name' => 'Pain',
                'type' => 'text',
                'description' => 'Track pain levels and locations',
            ],
            [
                'name' => 'Reading',
                'type' => 'text',
                'description' => 'Track what you are reading',
            ],
            [
                'name' => 'Watching',
                'type' => 'text',
                'description' => 'Track what you are watching',
            ],
            [
                'name' => 'Work Out',
                'type' => 'multiselect',
                'description' => 'Track your workout activities',
                'options' => [
                    'choices' => [
                        'upper body',
                        'lower body',
                        'core',
                        'cardio',
                        'yoga',
                        'walk',
                    ]
                ],
            ],
            [
                'name' => 'Day Rating',
                'type' => 'select',
                'description' => 'Rate your day on a scale of 1-5',
                'options' => [
                    'choices' => ['1', '2', '3', '4', '5'],
                ],
            ],
            [
                'name' => 'Mood',
                'type' => 'select',
                'description' => 'Track your daily mood',
                'options' => [
                    'choices' => ['good', 'fine', 'okay', 'bad'],
                ],
            ],
        ];

        foreach ($activities as $activity) {
            Activity::create($activity);
        }
    }
} 