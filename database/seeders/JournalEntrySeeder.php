<?php

namespace Database\Seeders;

use App\Models\JournalEntry;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class JournalEntrySeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        $entries = [
            [
                'entry_date' => Carbon::today(),
                'content' => 'Today was productive. Had a great workout and finished some pending tasks.',
                'mood' => 'good',
                'tags' => ['productive', 'exercise', 'work'],
            ],
            [
                'entry_date' => Carbon::yesterday(),
                'content' => 'Feeling a bit tired but managed to keep up with routine.',
                'mood' => 'okay',
                'tags' => ['tired', 'routine'],
            ],
            [
                'entry_date' => Carbon::today()->subDays(2),
                'content' => 'Amazing day! Completed all tasks and had time for self-care.',
                'mood' => 'good',
                'tags' => ['self-care', 'productive', 'happy'],
            ],
            [
                'entry_date' => Carbon::today()->subDays(3),
                'content' => 'Not feeling great today. Need more rest.',
                'mood' => 'bad',
                'tags' => ['rest', 'health'],
            ],
            [
                'entry_date' => Carbon::today()->subDays(4),
                'content' => 'Regular day, nothing special. Maintained routine.',
                'mood' => 'fine',
                'tags' => ['routine'],
            ],
        ];

        foreach ($entries as $entry) {
            JournalEntry::create([
                'user_id' => $user->id,
                'entry_date' => $entry['entry_date'],
                'content' => $entry['content'],
                'mood' => $entry['mood'],
                'tags' => $entry['tags'],
            ]);
        }
    }
} 