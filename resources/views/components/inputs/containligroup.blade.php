@props([
    "tangleValue" => $tangleValue,
    "stringFind" => $stringFind,
    "modelid" => false,
])

<div
    x-data="{
        stringtofind: $wire.entangle('{{ $stringFind }}'),
        open: $wire.entangle('{{ $tangleValue }}'),
        show: false,
        modelid: $wire.entangle('{{ $modelid }}'),
        count: function () {
            if (this.stringtofind.length > 0) {
                this.show = true
            } else {
                this.open = false
                this.show = false
            }
        },
        closeList: function () {
            this.open = false
            this.show = false
        },
        selectValue: function (inputName, listSelected) {
            ;(this.stringtofind.value = listSelected), (this.open = false)
        },
        resetProvince: function () {
            this.stringtofind = ''
            $wire.resetValuesProvince()
        },
        resetCity: function () {
            this.stringtofind = ''
            $wire.resetValuesCity()
        },
        seeValues: function () {
            if (this.modelid === 0) {
                this.stringtofind = ''
                this.open = false
                this.show = false
            }
        },
    }"
>
    {{ $slot }}
</div>
