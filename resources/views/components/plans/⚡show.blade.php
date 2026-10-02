<?php

use App\Models\Plan;
use App\Models\Project;
use App\Models\Worker;
use Illuminate\Support\Collection;
use Livewire\Component;

new class extends Component {
    public Plan $plan;
    public Collection $projects;
    public Collection $workers;

    public ?int $id = null;
    public ?int $projectId;
    public ?int $workerId;
    public ?string $planTime;
    public ?string $workDay;
    public ?string $method = 'update';

    public function mount(Plan $plan): void
    {
        $plan->id ? $this->id = $plan->id : $this->method = 'add';
        $this->projectId = $plan->project_id;
        $this->workerId = $plan->worker_id;
        $this->planTime = $plan->planTime;
        $this->workDay = $plan->workDay;
        $this->projects = Project::all();
        $this->workers = Worker::all();
    }

    public function add(): void
    {
        $plan = Plan::create([
            'project_id' => $this->pull('projectId'),
            'worker_id' => $this->pull('workerId'),
            'planTime' => $this->pull('planTime'),
            'workDay' => $this->pull('workDay'),
        ]);
        Flux::toast(
            text: "created $plan->planTime record.",
            variant: 'success'
        );
    }

    public function update(): void
    {
        Plan::findOrFail($this->id)->update([
            'project_id' => $this->projectId,
            'worker_id' => $this->workerId,
            'planTime' => $this->planTime,
            'workDay' => $this->workDay,
        ]);
        Flux::toast(
            text: "updated plan record.",
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
        <flux:input type="number" wire:model="planTime" label="Plan Time:"/>
        <flux:input type="datetime-local" wire:model="workDay" label="Work Day:"/>
        <flux:button
            wire:click="{{$method}}"
            variant="primary"
            class="mr-2"
        >{{ Str::ucfirst($method) }}
        </flux:button>
        <flux:button href="{{ route('plans.index') }}" variant="filled">
            Back
        </flux:button>
    </flux:card>
</div>
