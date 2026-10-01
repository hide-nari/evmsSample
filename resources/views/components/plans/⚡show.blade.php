<?php

use App\Models\Plan;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {
    public Plan $plan;

    public ?int $id = null;
    #[Validate('required')]
    public ?string $planTime;
    public ?string $workDay;
    public ?string $method = 'update';

    public function mount(Plan $plan): void
    {
        $plan->id ? $this->id = $plan->id : $this->method = 'add';
        $this->planTime = $plan->planTime;
        $this->workDay = $plan->workDay;
    }

    public function add(): void
    {
        $this->validate();
        $plan = Plan::create([
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
        $this->validate();
        Plan::findOrFail($this->id)->update([
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
        <flux:input wire:model="planTime" label="Plan Time:"/>
        <flux:input wire:model="workDay" label="Work Day:"/>
        <div wire:dirty="planTime">
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
