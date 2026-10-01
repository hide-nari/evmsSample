<?php

use App\Models\System;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {
    public System $system;

    public ?int $id = null;
    #[Validate('required')]
    public ?string $name;
    public ?string $method = 'update';

    public function mount(System $system): void
    {
        $system->id ? $this->id = $system->id : $this->method = 'add';
        $this->name = $system->name;
    }

    public function add(): void
    {
        $this->validate();
        $system = System::create([
            'name' => $this->pull('name'),
        ]);
        Flux::toast(
            text: "created $system->name record.",
            variant: 'success'
        );
    }

    public function update(): void
    {
        $this->validate();
        System::findOrFail($this->id)->update([
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
        <flux:button href="{{ route('systems.index') }}" variant="filled">
            Back
        </flux:button>
    </flux:card>
</div>
