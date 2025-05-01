@props([
    'nameinput'=>false,
    'idinput'=>false,
])
<input
    {{$attributes}}
    x-data="timeValidation"
    x-model="time"
    @input="formatTime($event)"
    maxlength="5"
    type="text"
    name="{{$nameinput}}"
    id="{{$idinput}}"
    class="flex-1 py-1 pr-2 w-1 border-gray-300 rounded focus:outline-none focus:ring-0 focus:border-gray-300"
    placeholder="00:00"
    autocomplete="off"
>
<button type="button"
        disabled
        class="absolute right-1 bg-transparent flex items-center justify-center"
>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
         stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
    </svg>

</button>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('timeValidation', () => ({
            time: '',
            formatTime(event) {
                let input = event.target.value.replace(/\D/g, ''); // Remove non-numeric characters
                let hours = input.substring(0, 2); // Get first two digits
                let minutes = input.substring(2, 4); // Get next two digits

                // Ensure hours are valid (00-24)
                if (hours.length === 2) {
                    let h = parseInt(hours, 10);
                    if (h > 24) hours = '24';
                }

                // Ensure minutes are valid (00-59)
                if (minutes.length === 2) {
                    let m = parseInt(minutes, 10);
                    if (m > 59) minutes = '59';
                }

                // Automatically format time as HH:MM
                this.time = hours + (hours.length === 2 ? ':' : '') + minutes;
            }
        }));
    });
</script>
