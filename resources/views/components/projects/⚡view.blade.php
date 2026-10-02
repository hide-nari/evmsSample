<?php

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public $sortBy = 'id';
    public $sortDirection = 'asc';
    public $search = '';
    public $trashViewFlg = false;

    #[Computed]
    public function projects(): LengthAwarePaginator
    {
        return Project::withTrashed($this->trashViewFlg)
            ->when($this->search, function (Builder $query) {
                $query->where('name', 'like', '%'.$this->search.'%');
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(12);
    }

    public function sort($column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function delete($projectId): void
    {
        Project::findOrFail($projectId)->delete();
        $this->resetPage();

        Flux::toast(
            text: 'delete project record.',
            variant: 'danger'
        );
    }
};
?>

<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="flex mb-5 mt-5">
        <flux:input wire:model.live="search" label="Search:"/>
        <flux:spacer/>
        <flux:modal.trigger name="filter">
            <flux:button icon="funnel" icon:variant="outline" class="mr-4 mt-7"/>
        </flux:modal.trigger>
        <flux:button icon="plus" href="{{ route('projects.show') }}" class="mr-4 mt-7"/>
    </div>

    <flux:modal name="filter" class="w-96">
        <div class="space-y-4">
            <flux:checkbox.group label="Filter" class="mt-2">
                <flux:checkbox label="Delete Data with Table" wire:model="trashViewFlg"/>
            </flux:checkbox.group>
            <flux:button wire:click="$refresh">Apply</flux:button>
        </div>
    </flux:modal>

    <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
        <flux:table>
            <flux:table.columns>
                <flux:table.column sortable
                                   align="center"
                                   :sorted="$sortBy === 'id'"
                                   :direction="$sortDirection"
                                   wire:click="sort('id')"
                                   class="w-24">
                    ID
                </flux:table.column>
                <flux:table.column sortable
                                   :sorted="$sortBy === 'name'"
                                   :direction="$sortDirection"
                                   wire:click="sort('name')">
                    Project
                </flux:table.column>
                <flux:table.column sortable
                                   :sorted="$sortBy === 'system_id'"
                                   :direction="$sortDirection"
                                   wire:click="sort('system_id')">
                    System
                </flux:table.column>
                <flux:table.column sortable
                                   :sorted="$sortBy === 'estimate'"
                                   :direction="$sortDirection"
                                   wire:click="sort('estimate')">
                    Estimate
                </flux:table.column>
                <flux:table.column>
                    Plan
                </flux:table.column>
                <flux:table.column>
                    Track
                </flux:table.column>
                <flux:table.column>
                    CPI
                </flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @foreach($this->projects as $project)
                    <flux:table.row :key="$project->id" class="hover:bg-zinc-100 dark:hover:bg-zinc-700">
                        <flux:table.cell align="center">
                            {{ $project->id }}
                        </flux:table.cell>
                        <flux:table.cell>
                            {{ $project->name }}
                        </flux:table.cell>
                        <flux:table.cell>
                            {{ $project->system->name ?? '' }} <br>
                            {{ $project->system->worker->name ?? '' }}
                        </flux:table.cell>
                        <flux:table.cell>
                            {{ $project->estimate . 'FTE' }}<br>
                            {{ Number::parseFloat($project->estimate) * 140 . 'h'  }}
                        </flux:table.cell>
                        <flux:table.cell>
                            @foreach($project->plans as $plan)
                                {{ $plan->worker->name ?? '' }} :
                                {{ $plan->workDay->format('m/d') }} :
                                {{ $plan->planTime . 'h' }}
                                <br>
                            @endforeach
                            {{ 'total :' . $project->plans->sum('planTime') . 'h' }}
                        </flux:table.cell>
                        <flux:table.cell>
                            @foreach($project->tracks as $track)
                                {{ $track->worker->name ?? '' }} :
                                {{ $track->workDay->format('m-d') }} :
                                {{ $track->workTime . 'h' }}
                                <br>
                            @endforeach
                            {{ 'total :' . $project->tracks->sum('workTime') . 'h' }}
                        </flux:table.cell>
                        <flux:table.cell>
                            @if($project->plans->sum('planTime') !== 0 AND $project->tracks->sum('workTime') !== 0)
                                {{ Number::parseFloat($project->plans->sum('planTime')) / Number::parseFloat($project->tracks->sum('workTime')) }}
                            @endif
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </div>
    <flux:pagination :paginator="$this->projects"/>
</div>
