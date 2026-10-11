(function () {
  var BLUE = '#2563eb', RED = '#dc2626', GRAY = '#6b7280';

  // Match the site font
  var style = document.createElement('style');
  style.textContent = '.swal2-popup { font-family: "Manrope", system-ui, sans-serif; }';
  document.head.appendChild(style);

  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true
  });

  window.cfAlert = {
    // Small non-blocking message in the corner: cfAlert.toast('success', 'Saved')
    toast: function (icon, title) {
      return Toast.fire({ icon: icon, title: title });
    },

    error: function (text, title) {
      return Swal.fire({ icon: 'error', title: title || 'Something went wrong', text: text, confirmButtonColor: BLUE });
    },

    warning: function (text, title) {
      return Swal.fire({ icon: 'warning', title: title || 'Please check', text: text, confirmButtonColor: BLUE });
    },

    // Two-button dialog. Resolves to true if the customer confirms.
    // Options: icon, title, text, confirmText, cancelText, danger (red confirm button)
    confirm: function (o) {
      return Swal.fire({
        icon: o.icon || 'question',
        title: o.title,
        text: o.text || '',
        showCancelButton: true,
        confirmButtonText: o.confirmText || 'Yes',
        cancelButtonText: o.cancelText || 'Cancel',
        confirmButtonColor: o.danger ? RED : BLUE,
        cancelButtonColor: GRAY,
        reverseButtons: true,
        focusCancel: !!o.danger
      }).then(function (r) { return r.isConfirmed; });
    }
  };
})();