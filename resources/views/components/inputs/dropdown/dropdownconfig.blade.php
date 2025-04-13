@props([
    'jsonvalues' =>[],
    'wireidvalue'=>false
])
<div
    x-data="{
         open: false,
         activeIndex: -1,
         selected: null,
         isUsingKeyboard: true,
         valuedText: '',
         filterText: '',

         options: {{ $jsonvalues}},
            init() {
                this.$wire.$watch('{{$wireidvalue}}', (value) => {
                 if(value){
                    this.selected = value;
                    const selectedOption = this.options.find(option => option.id === value);
                    if (selectedOption) {
                        this.valuedText = selectedOption.name;
                    } else {
                        this.valuedText = '';
                    }
                 }else{
                    this.selected = null;
                    this.valuedText = '';
                 }
                })

            },
         showoption() {
           this.open = !this.open;
           this.filterText = '';
           this.activeIndex = 0;
           this.$nextTick(() => this.$refs.inputFilet.focus());
        },
        close() {
           this.open = false;
           this.isUsingKeyboard = true;
        },
        keyDown(){
            this.isUsingKeyboard = true;
            this.activeIndex = (this.activeIndex + 1) % this.filteredOptions().length;
        },
        keyUp(){
            this.isUsingKeyboard = true;
            this.activeIndex = (this.activeIndex - 1 + this.filteredOptions().length) % this.filteredOptions().length;
        },
        select(index) {
            const item = this.filteredOptions()[index];
            if (!item) return;

            this.selected = item.id;
            this.valuedText = item.name;
            this.$wire.{{$wireidvalue}} = this.selected;
            this.close();
        },
        filteredOptions() {
            if (this.filterText === '') return this.options;
            return this.options.filter(opt => opt.name.toLowerCase().includes(this.filterText.toLowerCase()));
        }
    }"
    @keydown.escape.prevent.stop="close()"
    @keydown.arrow-down.prevent="keyDown()"
    @keydown.arrow-up.prevent="keyUp()"
    @keydown.enter.prevent="select(activeIndex)"
>
    {{$slot}}
</div>
