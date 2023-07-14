<div class="input-group mt-3">
    <span class="input-group-text">
        <i class="{{ $input['icon'] }}"></i>
    </span>

    <input type="{{ $input['type'] }}" dir="{{ $input['dir'] }}" name="{{ $input['name'] }}" class="{{ $input['class'] }}"
        placeholder="{{ $input['placeholder'] }}" />
</div>
<small class="{{ $input['validation'] }}" style="display: block;"></small>
