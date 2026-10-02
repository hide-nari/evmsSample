<?php

use App\Models\Track;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {
    public Track $track;

    public ?int $id = null;
    #[Validate('required')]
    public ?string $workTime;
    #[Validate('required')]
    public ?string $workDay;
    public ?string $method = 'update';

    public function mount(Track $track): void
    {
        $track->id ? $this->id = $track->id : $this->method = 'add';
        $this->workTime = $track->workTime;
    }

    public function add(): void
    {
        $this->validate();
        $track = Track::create([
            'workTime' => $this->pull('workTime'),
            'workDay' => $this->pull('workDay'),
        ]);
        Flux::toast(
            text: "created $track->workTime record.",
            variant: 'success'
        );
    }

    public function update(): void
    {
        $this->validate();
        Track::findOrFail($this->id)->update([
            'workTime' => $this->workTime,
            'workDay' => $this->workDay,
        ]);
        Flux::toast(
            text: "updated $this->workTime record.",
            variant: 'warning'
        );
    }

};
?>
<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <flux:card class="lg:w-1/3 space-y-4">
        <flux:input wire:model="workTime" label="Work Time:"/>
        <flux:input wire:model="workDay" label="Work Day:"/>
        <div wire:dirty="workTime">
            <flux:button
                wire:click="{{$method}}"
                variant="primary"
                class="mr-2"
            >{{ Str::ucfirst($method) }}
            </flux:button>
        </div>
        <flux:button href="{{ route('plans.index') }}" variant="filled">
            Back
        </flux:button>
    </flux:card>
</div>
