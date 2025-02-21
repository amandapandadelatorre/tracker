<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Today's Journal Entry -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Today's Journal Entry</h3>
                    
                    @if (session()->has('message'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form wire:submit="saveJournalEntry">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Write about your day
                            </label>
                            <textarea
                                wire:model="journalContent"
                                rows="4"
                                class="w-full border-gray-300 rounded-md shadow-sm"
                                placeholder="How was your day?"
                            ></textarea>
                            @error('journalContent') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Save Entry
                        </button>
                    </form>
                </div>
            </div>

            <!-- Quick Activities -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Activities</h3>
                    
                    @if (session()->has('activity_message'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('activity_message') }}
                        </div>
                    @endif

                    <div class="space-y-4">
                        @foreach($activities as $activity)
                            <div class="border rounded-lg p-4">
                                <h4 class="font-medium text-gray-900">{{ $activity->name }}</h4>
                                <p class="text-sm text-gray-500 mb-2">{{ $activity->description }}</p>
                                
                                @if($activity->type === 'select')
                                    <select wire:model="activityValues.{{ $activity->id }}" class="w-full border-gray-300 rounded-md shadow-sm">
                                        <option value="">Select...</option>
                                        @foreach($activity->options['choices'] as $option)
                                            <option value="{{ $option }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                @elseif($activity->type === 'multiselect')
                                    <div class="space-y-2">
                                        @foreach($activity->options['choices'] as $option)
                                            <label class="flex items-center">
                                                <input 
                                                    type="checkbox" 
                                                    wire:model="activityValues.{{ $activity->id }}" 
                                                    value="{{ $option }}"
                                                    class="rounded border-gray-300 text-blue-600 shadow-sm"
                                                >
                                                <span class="ml-2 text-gray-700">{{ $option }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                @elseif($activity->type === 'text')
                                    <input 
                                        type="text" 
                                        wire:model="activityValues.{{ $activity->id }}"
                                        class="w-full border-gray-300 rounded-md shadow-sm" 
                                        placeholder="Enter value..."
                                    >
                                @endif
                            </div>
                        @endforeach

                        <button 
                            wire:click="saveActivities" 
                            class="mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-full"
                        >
                            Save All Activities
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Entries -->
        <div class="mt-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Entries</h3>
                    <div class="space-y-4">
                        @foreach($recentEntries as $entry)
                            <div class="border rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $entry->entry_date->format('F j, Y') }}</h4>
                                        <p class="text-gray-600 mt-1">{{ Str::limit($entry->content, 150) }}</p>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($entry->mood === 'good') bg-green-100 text-green-800
                                        @elseif($entry->mood === 'fine') bg-blue-100 text-blue-800
                                        @elseif($entry->mood === 'okay') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($entry->mood) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 