<?php

use App\Models\System;
use App\Models\Worker;
use Illuminate\Support\Collection;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {
    public System $system;
    public Collection $workers;

    public ?int $id = null;
    #[Validate('required')]
    public ?string $name;
    public ?string $workerId;
    public ?string $method = 'update';

    public function mount(System $system): void
    {
        $system->id ? $this->id = $system->id : $this->method = 'add';
        $this->name = $system->name;
        $this->workerId = $system->worker_id;
        $this->workers = Worker::all();
    }

    public function add(): void
    {
        $this->validate();
        $system = System::create([
            'name' => $this->pull('name'),
            'worker_id' => $this->pull('workerId'),
        ]);
        Flux::toast(
            text: "created record.",
            variant: 'success'
        );
    }

    public function update(): void
    {
        $this->validate();
        System::findOrFail($this->id)->update([
            'name' => $this->pull('name'),
            'worker_id' => $this->pull('workerId'),
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
        <flux:select wire:model="workerId" label="Worker:">
            <flux:select.option value="0">----</flux:select.option>
            @foreach($workers as $worker)
                <flux:select.option value="{{ $worker->id }}">{{ $worker->name }}</flux:select.option>
            @endforeach
        </flux:select>
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
