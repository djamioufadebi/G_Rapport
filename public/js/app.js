import { end } from '@popperjs/core';
import Swal from 'sweetalert2'

window.Swal = Swal;

  function showDropdown(element) {
    var dropdown = $(element).find('.dropdown-menu');
    if (dropdown.hasClass('show') === false) {
      $('.dropdown-menu').removeClass('show');
      dropdown.addClass('show');
    }
  }

  $(document).on('click', function (e) {
    if (!$(e.target).closest('.navbarDropdownMenuLink').length) {
      $('.dropdown-menu').removeClass('show');
    }
  });
