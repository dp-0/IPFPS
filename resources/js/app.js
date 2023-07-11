import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

import Toastr from 'toastr';


window.Alpine = Alpine;
window.toastr = Toastr;

Alpine.plugin(focus);

Alpine.start();

toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
  window.addEventListener('toast.success', event => {
    toastr[event.detail.type](event.detail.message, event.detail.title);  
  });
 