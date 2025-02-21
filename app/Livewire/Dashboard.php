<?php

namespace App\Livewire;

use App\Models\Activity;
use App\Models\JournalEntry;
use App\Models\TrackedActivity;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public $journalContent;
    public $mood;
    public $activities;
    public $recentEntries;
    public $todayEntry;
    public $activityValues = [];

    public function mount()
    {
        $this->activities = Activity::where('is_active', true)->get();
        $this->recentEntries = auth()->user()->journalEntries()
            ->orderBy('entry_date', 'desc')
            ->take(5)
            ->get();
        
        $this->todayEntry = auth()->user()->journalEntries()
            ->whereDate('entry_date', Carbon::today())
            ->first();

        if ($this->todayEntry) {
            $this->journalContent = $this->todayEntry->content;
            $this->mood = $this->todayEntry->mood;
        }

        // Load today's tracked activities
        $todayActivities = auth()->user()->trackedActivities()
            ->whereDate('tracked_date', Carbon::today())
            ->get()
            ->keyBy('activity_id');

        foreach ($this->activities as $activity) {
            if (isset($todayActivities[$activity->id])) {
                $this->activityValues[$activity->id] = $todayActivities[$activity->id]->value;
            } else {
                $this->activityValues[$activity->id] = $activity->type === 'multiselect' ? [] : '';
            }
        }
    }

    public function saveJournalEntry()
    {
        $this->validate([
            'journalContent' => 'required|min:3',
            'mood' => 'required|in:good,fine,okay,bad'
        ]);

        $entry = JournalEntry::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'entry_date' => Carbon::today(),
            ],
            [
                'content' => $this->journalContent,
                'mood' => $this->mood,
                'tags' => [],
            ]
        );

        session()->flash('message', 'Journal entry saved successfully.');
        
        $this->recentEntries = auth()->user()->journalEntries()
            ->orderBy('entry_date', 'desc')
            ->take(5)
            ->get();
    }

    public function saveActivities()
    {
        foreach ($this->activityValues as $activityId => $value) {
            if (!empty($value)) {
                TrackedActivity::updateOrCreate(
                    [
                        'user_id' => auth()->id(),
                        'activity_id' => $activityId,
                        'tracked_date' => Carbon::today(),
                    ],
                    [
                        'value' => $value,
                    ]
                );
            }
        }

        session()->flash('activity_message', 'Activities saved successfully.');
    }

    public function render()
    {
        return view('livewire.dashboard')->layout('layouts.app');
    }
} 