<?php

use App\Models\Worker;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {

    public Worker $worker;

    public ?int $id = null;
    #[Validate('required')]
    public ?string $name;
    public ?string $method = 'update';

    public function mount(Worker $worker): void
    {
        $worker->id ? $this->id = $worker->id : $this->method = 'add';
        $this->name = $worker->name;
    }

    public function add(): void
    {
        $this->validate();
        $worker = Worker::create([
            'name' => $this->pull('name'),
        ]);
        Flux::toast(
            text: "created $worker->name record.",
            variant: 'success'
        );
    }

    public function update(): void
    {
        $this->validate();
        Worker::findOrFail($this->id)->update([
            'name' => $this->name,
        ]);
        Flux::toast(
            text: "updated worker record.",
            variant: 'warning'
        );
    }
}
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
        <flux:button href="{{ route('workers.index') }}" variant="filled">
            Back
        </flux:button>
    </flux:card>
</div>
