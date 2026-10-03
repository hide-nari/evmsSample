<?php

use App\Models\Project;
use App\Models\System;
use Illuminate\Support\Collection;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {
    public Project $project;
    public Collection $systems;

    public ?int $id = null;
    #[Validate('required')]
    public ?string $name = null;
    public ?string $ticketNumber = null;
    public ?string $systemId = null;
    public ?float $estimate = null;
    public ?string $method = 'update';

    public function mount(Project $project): void
    {
        $project->id ? $this->id = $project->id : $this->method = 'add';
        $this->name = $project->name;
        $this->ticketNumber = $project->ticket_number;
        $this->systemId = $project->system_id;
        $this->estimate = $project->estimate;
        $this->systems = System::all();
    }

    public function add(): void
    {
        $this->validate();
        $project = Project::create([
            'name' => $this->pull('name'),
            'ticket_number' => $this->pull('ticketNumber'),
            'system_id' => $this->pull('systemId'),
            'estimate' => $this->pull('estimate'),
        ]);
        Flux::toast(
            text: "created record.",
            variant: 'success'
        );
    }

    public function update(): void
    {
        $this->validate();
        Project::findOrFail($this->id)->update([
            'name' => $this->name,
            'ticket_number' => $this->ticketNumber,
            'system_id' => $this->systemId,
            'estimate' => $this->estimate,
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
        <flux:input wire:model="name" label="Name:"/>
        <flux:input wire:model="mgrNumber" label="MGR Number:"/>
        <flux:select wire:model="systemId" label="System:">
            <flux:select.option value="0">----</flux:select.option>
            @foreach($systems as $system)
                <flux:select.option value="{{ $system->id }}">{{ $system->name }}</flux:select.option>
            @endforeach
        </flux:select>
        <flux:input type="number" step="0.01" wire:model="estimate" label="Estimate:"/>
        <flux:button
            wire:click="{{$method}}"
            variant="primary"
            class="mr-2"
        >{{ Str::ucfirst($method) }}
        </flux:button>
        <flux:button href="{{ route('projects.index') }}" variant="filled">
            Back
        </flux:button>
    </flux:card>
</div>
