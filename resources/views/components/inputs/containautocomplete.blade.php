@props(["modelString" => false, "showModel" => false, "modelId" => false])
<div
    x-data="{
        show: false,
        open: $wire.entangle('{{ $showModel }}'),
        stringtofind: $wire.entangle('{{ $modelString }}'),
        modelId: $wire.entangle('{{ $modelId }}'),
        findProinvence() {
            this.seeValues()
            if (this.stringtofind.length >= 2 && this.modelId == null) {
                $wire.searchProvince()
                this.show = true
            } else {
                this.open = false
                this.modelId = null
            }
        },
        findCity() {
            this.seeValues()
            if (this.stringtofind.length >= 2 && this.modelId == null) {
                $wire.searchCity()
                this.show = true
            } else {
                this.open = false
                this.modelId = null
            }
        },
        closeList() {
            this.stringtofind = ''
            this.open = false
            this.show = false
        },
        setValuesProvince(id, name) {
            $wire.selectProvince(id)
            this.setValues(id, name)
        },
        setValuesCity(id, name) {
            $wire.selectCity(id)
            this.setValues(id, name)
        },
        setValues(id, name) {
            this.stringtofind = name
            this.modelId = id
            this.open = false
        },
        closeAway() {
            if (this.modelId == null) {
                this.closeList()
            } else {
                this.open = false
            }
        },
        seeValues() {
            if (this.stringtofind != '') {
                this.show = true
            }
        },
    }"
>
    {{ $slot }}
</div>
