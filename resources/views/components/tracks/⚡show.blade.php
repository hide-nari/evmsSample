<?php

use App\Models\Project;
use App\Models\Track;
use App\Models\Worker;
use Illuminate\Support\Collection;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {
    public Track $track;
    public Collection $projects;
    public Collection $workers;

    public ?int $id = null;
    public ?int $projectId = 0;
    #[Validate('required')]
    public ?int $workerId = null;
    public ?string $workTime = null;
    public ?string $workDay = null;
    public ?string $method = 'update';

    public function mount(Track $track): void
    {
        $track->id ? $this->id = $track->id : $this->method = 'add';
        $this->projectId = $track->project_id;
        $this->workerId = $track->worker_id;
        $this->workTime = $track->workTime;
        $this->workDay = $track->workDay;
        $this->projects = Project::all();
        $this->workers = Worker::all();
    }

    public function add(): void
    {
        $this->validate();
        $track = Track::create([
            'project_id' => $this->pull('projectId'),
            'worker_id' => $this->pull('workerId'),
            'workTime' => $this->pull('workTime'),
            'workDay' => $this->pull('workDay'),
        ]);
        Flux::toast(
            text: "created record.",
            variant: 'success'
        );
    }

    public function update(): void
    {
        $this->validate();
        Track::findOrFail($this->id)->update([
            'project_id' => $this->pull('projectId'),
            'worker_id' => $this->pull('workerId'),
            'workTime' => $this->pull('workTime'),
            'workDay' => $this->pull('workDay'),
        ]);
        Flux::toast(
            text: "updated record.",
            variant: 'warning'
        );
    }

};
?>
<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <flux:card class="lg:w-1/3 space-y-4">
        <flux:select wire:model="projectId" label="Project:">
            <flux:select.option value="0">----</flux:select.option>
            @foreach($projects as $project)
                <flux:select.option value="{{ $project->id }}">{{ $project->name }}</flux:select.option>
            @endforeach
        </flux:select>
        <flux:select wire:model="workerId" label="Worker:">
            <flux:select.option value="0">----</flux:select.option>
            @foreach($workers as $worker)
                <flux:select.option value="{{ $worker->id }}">{{ $worker->name }}</flux:select.option>
            @endforeach
        </flux:select>
        <flux:input type="number" wire:model="workTime" label="Work Time:"/>
        <flux:input type="datetime-local" wire:model="workDay" label="Work Day:"/>
        <flux:button
            wire:click="{{$method}}"
            variant="primary"
            class="mr-2"
        >{{ Str::ucfirst($method) }}
        </flux:button>
        <flux:button href="{{ route('tracks.index') }}" variant="filled">
            Back
        </flux:button>
    </flux:card>
</div>
