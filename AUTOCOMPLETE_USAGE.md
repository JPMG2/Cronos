# Autocomplete Component Usage

This project includes a professional, reusable autocomplete component with full keyboard navigation support.

## Features

- ✅ Arrow Up/Down navigation
- ✅ Enter to select
- ✅ Escape to close
- ✅ Click outside to close
- ✅ Mouse hover highlights
- ✅ Smooth scrolling to selected item
- ✅ Visual feedback for selected items
- ✅ Clear button
- ✅ Fully integrated with Livewire

## Method 1: Using the Reusable Blade Component (Recommended)

The easiest way to use autocomplete in your views:

```blade
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
```

### Parameters:

- **label**: The label text to display above the input
- **placeholder**: Input placeholder text (default: 'buscar...')
- **items**: The collection/array of items to display in the dropdown
- **idField**: Livewire property path for the selected ID (e.g., 'form.user_id')
- **nameField**: Livewire property path for the selected name (e.g., 'form.user_name')
- **displayField**: The property name to display in the list (default: 'name')
- **valueField**: The property name for the value/ID (default: 'id')
- **error**: Error message to display (optional)
- **required**: Whether the field is required (optional)

## Method 2: Manual Implementation

If you need more control, you can implement it manually:

```blade
<div class="relative w-full col-span-4">
    <div class="relative"
         x-data="autocomplete()"
         x-init="isOpen = {{ count($yourItems) > 0 ? 'true' : 'false' }}"
         @click.away="close()"
    >
        <div class="relative">
            <x-simple-label label="Your Label">
                <div class="relative">
                    <input
                        type="text"
                        placeholder="search..."
                        autocomplete="off"
                        wire:model.live.debounce.300ms="yourNameField"
                        @keydown="handleKeydown($event, {{ count($yourItems) }})"
                        @focus="isOpen = {{ count($yourItems) > 0 ? 'true' : 'false' }}"
                        class="border-1 border-gray-300 peer block w-full appearance-none rounded-lg bg-transparent px-2.5 pb-1 pt-3.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                    />
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg
                            type="button"
                            @click="clear('yourNameField', 'yourIdField')"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="mr-1 h-4 w-4 cursor-pointer hover:text-red-500 transition-colors"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="pointer-events-none h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                </div>
            </x-simple-label>
            <div x-show="isOpen && {{ count($yourItems) }} > 0" x-cloak>
                <ul class="absolute z-20 max-h-75 w-full divide-y overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-2 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                    @foreach ($yourItems as $index => $item)
                        <li
                            data-autocomplete-item
                            @click="selectItem('{{ $item->id }}', '{{ $item->name }}', 'yourIdField', 'yourNameField')"
                            @mouseenter="selectedIndex = {{ $index }}"
                            :class="isSelected({{ $index }}) ? 'bg-indigo-600 text-white' : 'text-gray-900 hover:bg-indigo-100'"
                            class="relative cursor-pointer select-none py-2 pl-3 pr-9 transition-colors"
                            role="option"
                        >
                            <div class="flex items-center">
                                <span class="inline-block h-2 w-2 flex-shrink-0 rounded-full bg-green-400"></span>
                                <span class="ml-3 block truncate font-normal text-xs">{{ $item->name }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @error("yourIdField")
            <x-inputs.error-validate>{{ $message }}</x-inputs.error-validate>
        @enderror
    </div>
</div>
```

### Important Notes:

1. **Replace field names**: Change `yourNameField`, `yourIdField`, and `$yourItems` to match your Livewire component properties
2. **Item properties**: Update `$item->id` and `$item->name` to match your model's properties
3. **Validation**: Update the error field name in `@error()` directive

## Keyboard Shortcuts

- **Arrow Down**: Move to next item
- **Arrow Up**: Move to previous item
- **Enter**: Select highlighted item
- **Escape**: Close dropdown
- **Click Outside**: Close dropdown

## Livewire Component Setup

In your Livewire component, you need:

```php
public $listOfItems = [];
public $selectedItemId = null;
public $selectedItemName = '';

public function updatedSelectedItemName($value)
{
    // Search and filter items based on the name input
    $this->listOfItems = YourModel::where('name', 'like', '%' . $value . '%')
        ->limit(10)
        ->get();
}
```

## Building Assets

After making changes, rebuild your assets:

```bash
npm run build
# or for development
npm run dev
```
