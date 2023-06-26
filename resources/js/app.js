import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import Swal from 'sweetalert';

window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();

window.Swal = Swal;