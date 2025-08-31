@props(["isdisabled" => false, "error" => false])
@php
    $errorColor = $error ? "border-red-300" : "border-gray-300";

        $disableatributs = $isdisabled ? "disabled:cursor-not-allowed disabled:bg-gray-100" : "";

@endphp

<div x-data="checkRequiredSelect" x-id="['select']">
    <select
        {{ $attributes }}
        {{ $isdisabled }}
        x-ref="select"
        x-on:blur="touched = true; checkInput($el)"
        :class="hasError ? 'border-red-300' : '{{ $errorColor }}'"
        class="{{ $disableatributs }} {{ $errorColor }}
            block border-1 w-full appearance-none rounded-lg bg-transparent
            px-2.5 pt-3 pb-1.5 text-sm   {{ $isdisabled ? 'disabled:text-gray-950 opacity-100' : 'text-gray-900' }}
            focus:outline-none focus:ring-0 "

    >

        {{ $slot }}
    </select>
</div>
@script
<script>
    Alpine.data('checkRequiredSelect', () => ({
        hasError: false,
        touched: false,

        init() {
            window.addEventListener('clear-errors', () => {
                this.hasError = false;
                this.touched = false;
            });

            this.$el.addEventListener('reinitialize-alpine', () => {
                const select = this.$refs.select;
                if (!select) return;

                setTimeout(() => {
                    const isEmpty = !select.value || select.value === '';
                    const isRequired = select.hasAttribute('required');

                    if (isEmpty) {
                        if (!this.touched) {
                            this.hasError = false;
                        }
                        this.touched = false;
                    }

                    if (this.touched) {
                        this.checkInput(select);
                    }
                }, 30);
            });
        },

        checkInput(select) {
            const isRequired = select.hasAttribute('required');
            const isEmpty = !select.value || select.value === '';
            this.hasError = isRequired && isEmpty;
        }
    }));
</script>

@endscript
