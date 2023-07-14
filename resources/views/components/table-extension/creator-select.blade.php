<div class="col-md-6">
    <select class="{{ $input['class'] }}" {{ $input['multiple'] }} name="{{ $input['name'] }}"
        @if ($input['search']) data-mdb-container="#{{ $id }}" data-mdb-filter="true" @endif>
        @foreach ($input['options'] as $key => $value)
            <option value="{{ $value }}">{{ $key }}</option>
        @endforeach
    </select>
    <small class="{{ $input['validation'] }}" style="display: block;"></small>
</div>
