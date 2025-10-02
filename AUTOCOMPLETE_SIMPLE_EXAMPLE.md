# Simple Example: Using the New Autocomplete Component

## Before (Old Way)
```blade
<div class="relative w-full col-span-4">
    <div class="relative" x-data="autocomplete()">
        <div class="relative">
            <x-simple-label label="Prestador">
                <div class="relative">
                    <x-inputs.searchinput
                        placeholder="buscar..."
                        resetImput='form.dataPrestadorPlan.insurance_name'
                        @keydown.escape.prevent.stop="closeAutocomplete($event)"
                        wire:model.live.debounce.300ms="form.dataPrestadorPlan.insurance_name"
                    ></x-inputs.searchinput>
                </div>
            </x-simple-label>
            @if (count($listPrestadores) > 0)
                <x-autocomplete.ulautocomplete>
                    @foreach ($listPrestadores as $prestador)
                        <x-autocomplete.liautocomplete
                            x-on:click="setValuesAutocomplete('{{$prestador->id}}','{{ $prestador->insurance_name }}')"
                        >
                            {{ $prestador->insurance_name }}
                        </x-autocomplete.liautocomplete>
                    @endforeach
                </x-autocomplete.ulautocomplete>
            @endif
        </div>
        @error("insurance_id")
        <x-inputs.error-validate>{{ $message }}</x-inputs.error-validate>
        @enderror
    </div>
</div>
```

## After (New Way - Using Reusable Component)
```blade
<div class="col-span-4">
    <x-autocomplete.input
        label="Prestador"
        placeholder="buscar prestador..."
        :items="$listPrestadores"
        idField="form.dataPrestadorPlan.insurance_id"
        nameField="form.dataPrestadorPlan.insurance_name"
        displayField="insurance_name"
        valueField="id"
        :error="$errors->first('insurance_id')"
        required="yes"
    />
</div>
```

## Benefits of the New Component:

1. ✅ **Much cleaner and shorter code** - From 30+ lines to just 10 lines
2. ✅ **Keyboard navigation** - Arrow up/down, Enter, Escape
3. ✅ **Better UX** - Smooth scrolling, visual highlights
4. ✅ **Fully reusable** - Just change the field names and you're done
5. ✅ **Consistent styling** - Same look across all autocompletes
6. ✅ **Easy maintenance** - Update once, affects all autocompletes

## Example: Using in Another View (e.g., Patient Search)

```blade
<div class="col-span-6">
    <x-autocomplete.input
        label="Paciente"
        placeholder="buscar paciente..."
        :items="$patients"
        idField="form.patient_id"
        nameField="form.patient_name"
        displayField="full_name"
        valueField="id"
        :error="$errors->first('patient_id')"
        required="yes"
    />
</div>
```

Just change:
- `idField` → your Livewire property for the ID
- `nameField` → your Livewire property for the name/search
- `displayField` → the property from your model to display
- `valueField` → the property from your model for the ID
- `:items` → your collection variable
