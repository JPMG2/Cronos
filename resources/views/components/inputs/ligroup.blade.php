<div>
    <ul
        x-show="open"
        style="display: none"
        x-data="{ 
            dropdownPosition: 'bottom',
            init() {
                this.$nextTick(() => this.checkPosition());
            },
            checkPosition() {
                const rect = this.$el.getBoundingClientRect();
                const windowHeight = window.innerHeight;
                const dropdownHeight = 300; // max-h-75 equivalent
                const spaceBelow = windowHeight - rect.bottom;
                const spaceAbove = rect.top;
                
                this.dropdownPosition = spaceBelow < dropdownHeight && spaceAbove > spaceBelow ? 'top' : 'bottom';
            }
        }"
        x-init="checkPosition()"
        :class="dropdownPosition === 'top' ? 'bottom-full mb-1' : 'top-full mt-1'"
        class="absolute z-20 max-h-75 w-full divide-y overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-2 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
        tabindex="-1"
        role="listbox"
        aria-labelledby="listbox-label"
    >
        {{ $slot }}
    </ul>
</div>
