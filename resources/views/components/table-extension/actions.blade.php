<td>
    <div class="d-flex justify-content-between">

        @foreach ($buttons as $button)
            @if ($button == 'delete')
                <a type="button" class="btn-sm text-danger fa-lg" wire:click='delete({{ $id }})'
                    modelid="{{ $id }}" title="Delete">
                    <i class="fas fa-trash-can"></i>
                </a>
            @endif

            @if ($button == 'edit')
                @if ($page)
                    <a type="button" class="btn-sm text-primary fa-lg" href="{{ edit_table($table, $id) }}"
                        modelid="{{ $id }}" title="Edit">
                        <i class="far fa-pen-to-square"></i>
                    </a>
                @endif

                @if (!$page)
                    <a type="button" class="btn-sm text-primary fa-lg" wire:click='edit({{ $id }})'
                        data-mdb-toggle="modal" data-mdb-target="#{{ $updaterid }}" href="#{{ $table . '-' . $id }}"
                        modelid="{{ $id }}" title="Edit">
                        <i class="far fa-pen-to-square"></i>
                    </a>
                @endif
            @endif
            @if ($button == 'show')
                <a type="button" class="btn-sm text-primary fa-lg" href="#modelid"
                    wire:click="show({{ $id }})" modelid="{{ $id }}" title="Show">
                    <i class="fas fa-eye"></i>
                </a>
            @endif
        @endforeach

    </div>
</td>
