export default function autocomplete(config = {}) {
    return {
        selectedIndex: -1,
        isOpen: false,

        init() {
            // Watch for list changes to reset selected index
            this.$watch('isOpen', (value) => {
                if (!value) {
                    this.selectedIndex = -1;
                }
            });
        },

        handleKeydown(event, itemCount) {
            if (itemCount === 0) return;

            switch (event.key) {
                case 'ArrowDown':
                    event.preventDefault();
                    this.selectedIndex = Math.min(this.selectedIndex + 1, itemCount - 1);
                    this.scrollToSelected();
                    break;

                case 'ArrowUp':
                    event.preventDefault();
                    this.selectedIndex = Math.max(this.selectedIndex - 1, -1);
                    this.scrollToSelected();
                    break;

                case 'Enter':
                    event.preventDefault();
                    if (this.selectedIndex >= 0) {
                        this.selectByIndex(this.selectedIndex);
                    }
                    break;

                case 'Escape':
                    event.preventDefault();
                    this.close();
                    break;
            }
        },

        selectByIndex(index) {
            const items = this.$el.querySelectorAll('[data-autocomplete-item]');
            if (items[index]) {
                items[index].click();
            }
        },

        scrollToSelected() {
            this.$nextTick(() => {
                const items = this.$el.querySelectorAll('[data-autocomplete-item]');
                if (items[this.selectedIndex]) {
                    items[this.selectedIndex].scrollIntoView({
                        block: 'nearest',
                        behavior: 'smooth'
                    });
                }
            });
        },

        isSelected(index) {
            return this.selectedIndex === index;
        },

        selectItem(id, name, idField, nameField) {
            this.$wire.set(idField, id);
            this.$wire.set(nameField, name);
            this.close();
        },

        close() {
            this.selectedIndex = -1;
            this.isOpen = false;

            // If config has clearField, clear it
            if (config.clearField) {
                this.$wire.set(config.clearField, '');
            }

            // If config has clearIdField, clear it
            if (config.clearIdField) {
                this.$wire.set(config.clearIdField, '');
            }
        },

        clear(nameField, idField) {
            this.$wire.set(nameField, '');
            this.$wire.set(idField, '');
            this.selectedIndex = -1;
        }
    };
}
