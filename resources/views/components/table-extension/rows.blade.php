<tr>
    {{-- <td scope="row">
        <input class="form-check-input" type="checkbox" value="{{ $model->id }}" modelid="{{ $model->id }}" />
    </td> --}}

    @foreach ($rows as $row => $type)
        @if ($type == 'property')
            <td>{{ $model["$row"] }}</td>
        @endif

        @if ($type == 'selects')
            <x-table-extension.table-select :models="$model[$row]"></x-table-extension.table-select>
        @endif

        @if ($type == 'status')
            <x-table-extension.status :status="$model[$row]" :name="1" :id="$model['id']"></x-table-extension.status>
        @endif

        @if ($type == 'can_add_ad')
            <x-table-extension.status :status="$model[$row]" :name="2" :id="$model['id']"></x-table-extension.status>
        @endif

        @if ($type == 'can_add_offer')
            <x-table-extension.status :status="$model[$row]" :name="3" :id="$model['id']"></x-table-extension.status>
        @endif

        @if ($type == 'image')
            <x-table-extension.image :image="$model[$row]"></x-table-extension.image>
        @endif

        @if ($type == 'popover')
            <x-table-extension.popover :models="$model[$row]"></x-table-extension.popover>
        @endif

        @if ($type == 'dropdown')
            <x-table-extension.dropdown :models="$model[$row]"></x-table-extension.dropdown>
        @endif

        @if ($type == 'dropdown-buttons')
            <x-table-extension.dropdown-buttons :id="$model['id']"
                :status="$model[$row]"></x-table-extension.dropdown-buttons>
        @endif

        @if ($type == 'badge')
            <x-table-extension.badge :property="$model[$row]"></x-table-extension.badge>
        @endif

        @if ($row == 'actions')
            <x-table-extension.actions :buttons="$type" :page="$page" :table="$table" :updaterid="$updaterid"
                :id="$model['id']"></x-table-extension.actions>
        @endif
    @endforeach

</tr>
