<?php

use App\Models\Project;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {
    public Project $project;

    public ?int $id = null;
    #[Validate('required')]
    public ?string $name;
    public ?string $method = 'update';

    public function mount(Project $project): void
    {
        $project->id ? $this->id = $project->id : $this->method = 'add';
        $this->name = $project->name;
    }

    public function add(): void
    {
        $this->validate();
        $project = Project::create([
            'name' => $this->pull('name'),
        ]);
        Flux::toast(
            text: "created $project->name record.",
            variant: 'success'
        );
    }

    public function update(): void
    {
        $this->validate();
        Project::findOrFail($this->id)->update([
            'name' => $this->name,
        ]);
        Flux::toast(
            text: "updated $this->name record.",
            variant: 'warning'
        );
    }

};
?>

<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <flux:card class="lg:w-1/3 space-y-4">
        <flux:input wire:model="name" label="Name:"/>
        <div wire:dirty="name">
            <flux:button
                wire:click="{{$method}}"
                variant="primary"
                class="mr-2"
            >{{ Str::ucfirst($method) }}
            </flux:button>
        </div>
        <flux:button href="{{ route('projects.index') }}" variant="filled">
            Back
        </flux:button>
    </flux:card>
</div>
