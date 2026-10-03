<?php

use App\Models\Track;
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
    public $noLinkedProjectFlg = false;

    #[Computed]
    public function tracks(): LengthAwarePaginator
    {
        return Track::withTrashed($this->trashViewFlg)
            ->when(request('projectId'), function (Builder $query) {
                $query->where('project_id', request('projectId'));
            })
            ->when(request('workerId'), function (Builder $query) {
                $query->where('worker_id', request('workerId'));
            })
            ->when($this->search, function (Builder $query) {
                $query->where('worker_id', 'like', '%'.$this->search.'%');
            })
            ->when($this->noLinkedProjectFlg, function (Builder $query) {
                $query->where('project_id', '0');
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

    public function delete($trackId): void
    {
        Track::findOrFail($trackId)->delete();
        $this->resetPage();

        Flux::toast(
            text: 'delete track record.',
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
        <flux:button icon="plus" href="{{ route('tracks.show') }}" class="mr-4 mt-7"/>
    </div>

    <flux:modal name="filter" class="w-96">
        <div class="space-y-4">
            <flux:checkbox.group label="Filter" class="mt-2">
                <flux:checkbox label="Delete Data with Table" wire:model="trashViewFlg"/>
                <flux:checkbox label="No Linked Project data" wire:model="noLinkedProjectFlg"/>
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
                                   align="left"
                                   :sorted="$sortBy === 'project_id'"
                                   :direction="$sortDirection"
                                   wire:click="sort('project_id')">
                    Project
                </flux:table.column>
                <flux:table.column sortable
                                   align="left"
                                   :sorted="$sortBy === 'worker_id'"
                                   :direction="$sortDirection"
                                   wire:click="sort('worker_id')">
                    Worker
                </flux:table.column>
                <flux:table.column sortable
                                   :sorted="$sortBy === 'workTime'"
                                   :direction="$sortDirection"
                                   wire:click="sort('workTime')">
                    Work Time
                </flux:table.column>
                <flux:table.column sortable
                                   :sorted="$sortBy === 'workDay'"
                                   :direction="$sortDirection"
                                   wire:click="sort('workDay')">
                    Work Day
                </flux:table.column>
                <flux:table.column align="center" class="w-24">Edit</flux:table.column>
                <flux:table.column align="center" class="w-24">Delete</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @foreach($this->tracks as $track)
                    <flux:table.row :key="$track->id" class="hover:bg-zinc-100 dark:hover:bg-zinc-700">
                        <flux:table.cell align="center">
                            {{ $track->id }}
                        </flux:table.cell>
                        <flux:table.cell>
                            {{ $track->project->name ?? '' }}
                        </flux:table.cell>
                        <flux:table.cell>
                            {{ $track->worker->name ?? '' }}
                        </flux:table.cell>
                        <flux:table.cell>
                            {{ $track->workTime }}
                        </flux:table.cell>
                        <flux:table.cell>
                            {{ $track->workDay->format('Y-m-d') }}
                        </flux:table.cell>
                        <flux:table.cell align="center">
                            @unless($track->deleted_at)
                                <flux:button
                                    href="{{ route('tracks.show',$track) }}"
                                    variant="subtle"
                                    size="xs"
                                >
                                    <flux:icon.pencil/>
                                </flux:button>
                            @else
                                <flux:button
                                    as="div"
                                    variant="subtle"
                                    size="xs"
                                >
                                    <flux:icon.pencil-off variant="mini"/>
                                </flux:button>
                            @endunless
                        </flux:table.cell>
                        <flux:table.cell align="center">
                            @unless($track->deleted_at)
                                <flux:button
                                    wire:confirm="Delete OK?"
                                    wire:click="delete({{ $track->id }})"
                                    variant="subtle"
                                    size="xs"
                                >
                                    <flux:icon.trash/>
                                </flux:button>
                            @else
                                <flux:button
                                    as="div"
                                    variant="subtle"
                                    size="xs"
                                >
                                    <flux:icon.save-off/>
                                </flux:button>
                            @endunless
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </div>
    <flux:pagination :paginator="$this->tracks"/>
</div>
