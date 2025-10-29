import './bootstrap';
import mask from '@alpinejs/mask';
import collapse from '@alpinejs/collapse';
import flatpickr from 'flatpickr';
import { Spanish } from 'flatpickr/dist/l10n/es.js';
import autocomplete from './components/autocomplete.js';

flatpickr.localize(Spanish);
window.flatpickr = flatpickr;

document.addEventListener('livewire:init', () => {
    window.Alpine.plugin(mask);
    window.Alpine.plugin(collapse);
    window.Alpine.data('autocomplete', autocomplete);
});
