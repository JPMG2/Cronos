@props([
    'idMenu'=>false,
    'idOptionMenu'=> []

])

<div x-data="checkAll({{ $idMenu }},'{{ json_encode($idOptionMenu) }}')">
    <label for="{{'namevalue'.$idMenu}}">
        <input

            wire:model="accesoForm.dataacceso.menu_id"
            @change="handleCheckAll"
            value="{{$idMenu}}"
            id="{{'namevalue'.$idMenu}}" type="checkbox">

    </label>
</div>
@script
<script>
    Alpine.data('checkAll', (idMenu, idOptionMenu) => {

        return {
            valueHeaderMenu: Object.values(JSON.parse(idOptionMenu)),

            init: function () {

            },
            handleCheckAll: function (e) {
                if (e.target.checked) {
                    this.selectAll();
                } else {
                    this.deselectAll();
                }
            },
            selectAll: function () {


                this.valueHeaderMenu.forEach(idMenu => {
                    if (this.$wire.accesoForm.dataacceso.menu_options.map(Number).includes(idMenu)) return
                    this.$wire.accesoForm.dataacceso.menu_options.push(idMenu)
                });

            },
            deselectAll: function () {
               
                this.valueHeaderMenu.forEach(idMenu => {
                    this.$wire.accesoForm.dataacceso.menu_options = this.$wire.accesoForm.dataacceso.menu_options.map(Number).filter(
                        item => item !== idMenu
                    )
                });

            }
        }
    })
</script>
@endscript
