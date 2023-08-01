<td>
    <div class="switch">
        <label>
            نشط
            <input type="checkbox" wire:click="status({{ $id }},{{ $name }} )"
                {{ $status == 'active' ? 'checked' : '' }} {{ $status == 1 ? 'checked' : '' }}>
            <span class="lever"></span>
            غير نشط
        </label>
    </div>
</td>
