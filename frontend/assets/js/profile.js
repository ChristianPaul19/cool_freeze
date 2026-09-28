// Interactions for the customer profile page (plain JavaScript, no libraries).
document.addEventListener('DOMContentLoaded', function () {
    var body = document.body;

    // ---------- Mobile sidebar ----------
    var sidebar = document.getElementById('sidebar');
    var overlay = document.getElementById('sidebarOverlay');
    var sidebarToggle = document.getElementById('sidebarToggle');

    function setSidebar(open) {
        sidebar.classList.toggle('is-open', open);
        overlay.classList.toggle('is-visible', open);
        body.classList.toggle('cf-no-scroll', open);
    }

    sidebarToggle.addEventListener('click', function () { setSidebar(true); });
    overlay.addEventListener('click', function () { setSidebar(false); });

    // ---------- Modals ----------
    function openModal(id) {
        var modal = document.getElementById(id);
        if (!modal) { return; }
        modal.hidden = false;
        body.classList.add('cf-no-scroll');
        var firstInput = modal.querySelector('input:not([type="hidden"]):not([type="file"])');
        if (firstInput) { firstInput.focus(); }
    }

    function closeModal(modal) {
        modal.hidden = true;
        body.classList.remove('cf-no-scroll');
    }

    document.querySelectorAll('[data-open-modal]').forEach(function (button) {
        button.addEventListener('click', function () { openModal(button.dataset.openModal); });
    });

    document.querySelectorAll('.cf-modal').forEach(function (modal) {
        // X button
        modal.querySelector('[data-close-modal]').addEventListener('click', function () { closeModal(modal); });
        // click on the dark area around the dialog
        modal.addEventListener('mousedown', function (event) {
            if (event.target === modal) { closeModal(modal); }
        });
    });

    document.addEventListener('keydown', function (event) {
        if (event.key !== 'Escape') { return; }
        document.querySelectorAll('.cf-modal:not([hidden])').forEach(closeModal);
        setSidebar(false);
    });

    // ---------- Show / hide password on the profile page ----------
    var secretButton = document.querySelector('[data-toggle-secret]');
    if (secretButton) {
        var secretText = secretButton.parentElement.querySelector('[data-mask]');
        var hideTimer = null;

        function hideSecret() {
            clearTimeout(hideTimer);
            secretText.textContent = secretText.dataset.mask;
            secretButton.setAttribute('aria-pressed', 'false');
            secretButton.setAttribute('aria-label', 'Show password');
            secretButton.innerHTML = eyeSvg;
        }

        secretButton.addEventListener('click', function () {
            if (secretButton.getAttribute('aria-pressed') === 'true') {
                hideSecret();
                return;
            }

            // The password is not in the page. It is requested from the server only now.
            fetch(secretButton.dataset.revealUrl, { method: 'POST' })
                .then(function (response) { return response.json(); })
                .then(function (result) {
                    secretText.textContent = result.success ? result.password : result.message;
                    secretButton.setAttribute('aria-pressed', 'true');
                    secretButton.setAttribute('aria-label', 'Hide password');
                    secretButton.innerHTML = eyeOffSvg;
                    hideTimer = setTimeout(hideSecret, 15000);   // hides itself after 15 seconds
                })
                .catch(function () {
                    secretText.textContent = 'Could not load. Please try again.';
                });
        });
    }

    // ---------- Show / hide password inside the Change password modal ----------
    document.querySelectorAll('[data-toggle-input]').forEach(function (button) {
        var input = document.getElementById(button.dataset.toggleInput);
        button.addEventListener('click', function () {
            var show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            button.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
            button.innerHTML = show ? eyeOffSvg.replace('width="24" height="24"', 'width="20" height="20"')
                                    : eyeSvg.replace('width="24" height="24"', 'width="20" height="20"');
        });
    });

    // ---------- FAQ expand / collapse ----------
    document.querySelectorAll('.cf-faq__q').forEach(function (question) {
        question.addEventListener('click', function () {
            var answer = document.getElementById(question.getAttribute('aria-controls'));
            var open = question.getAttribute('aria-expanded') === 'true';
            question.setAttribute('aria-expanded', open ? 'false' : 'true');
            answer.hidden = open;
        });
    });

    // ---------- Edit Profile ----------
    var columns = document.getElementById('profileColumns');
    var editPanel = document.getElementById('editPanel');

    // Shows or hides the edit column on the right (see the Figma edit view).
    function setEditing(on) {
        editPanel.hidden = !on;
        columns.classList.toggle('is-editing', on);
        if (on && window.matchMedia('(max-width: 1399px)').matches) {
            editPanel.scrollIntoView(); // on small screens the panel appears below
        }
    }

    document.querySelectorAll('[data-open-panel]').forEach(function (button) {
        button.addEventListener('click', function () { setEditing(true); });
    });

    var editForm = editPanel;
    var avatarInput = document.getElementById('editAvatarInput');
    var avatarPreview = document.getElementById('editAvatarPreview');
    var pageAvatar = document.getElementById('profileAvatar');

    avatarInput.addEventListener('change', function () {
        var file = avatarInput.files[0];
        if (!file) { return; }
        var reader = new FileReader();
        reader.onload = function (e) { avatarPreview.src = e.target.result; };
        reader.readAsDataURL(file);
    });

    function setText(name, value) {
        document.querySelectorAll('[data-profile="' + name + '"]').forEach(function (el) {
            el.textContent = (value === null || value === '') ? 'Not set' : value;
        });
    }

    function formatBirthday(iso) {
        if (!iso) { return ''; }
        var p = iso.split('-');
        return new Date(p[0], p[1] - 1, p[2]).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
    }

    var editError = document.getElementById('editError');

    function showError(element, message) {
        element.textContent = message;
        element.hidden = false;
    }

    editForm.addEventListener('submit', function (event) {
        event.preventDefault();
        editError.hidden = true;

        var doneButton = editForm.querySelector('button[type="submit"]');
        doneButton.disabled = true;

        // Sends the form (and the photo) to backend/api/update-profile.php
        fetch(editForm.dataset.action, { method: 'POST', body: new FormData(editForm) })
            .then(function (response) { return response.json(); })
            .then(function (result) {
                if (!result.success) {
                    showError(editError, result.message || 'Could not save your profile.');
                    return;
                }
                // show the values the server saved
                var p = result.profile;
                setText('username', p.username);
                setText('fullName', p.full_name);
                setText('birthday', p.birthday_display);
                setText('address', p.address);
                setText('email', p.email);
                setText('phone', p.phone);
                if (result.profile_image_url) {
                    pageAvatar.src = result.profile_image_url;
                    avatarPreview.src = result.profile_image_url;
                }
                setEditing(false);
            })
            .catch(function () { showError(editError, 'Could not save. Please try again.'); })
            .finally(function () { doneButton.disabled = false; });
    });

    // ---------- Change Password ----------
    var passwordForm = document.getElementById('changePasswordForm');
    var passwordError = document.getElementById('passwordError');

    function showPasswordError(message) {
        passwordError.textContent = message;
        passwordError.hidden = false;
    }

    passwordForm.addEventListener('submit', function (event) {
        event.preventDefault();
        passwordError.hidden = true;

        var current = passwordForm.elements['current_password'].value;
        var next = passwordForm.elements['new_password'].value;
        var confirm = passwordForm.elements['confirm_password'].value;

        // quick checks first (the server checks again)
        if (!current || !next || !confirm) { return showPasswordError('Please fill in all fields.'); }
        if (next.length < 8) { return showPasswordError('New password must be at least 8 characters.'); }
        if (next !== confirm) { return showPasswordError('New password and confirm password do not match.'); }

        var doneButton = passwordForm.querySelector('button[type="submit"]');
        doneButton.disabled = true;

        // Sends to backend/api/change-password.php
        fetch(passwordForm.dataset.action, { method: 'POST', body: new FormData(passwordForm) })
            .then(function (response) { return response.json(); })
            .then(function (result) {
                if (!result.success) {
                    showPasswordError(result.message || 'Could not change the password.');
                    return;
                }
                passwordForm.reset();
                closeModal(document.getElementById('changePasswordModal'));
            })
            .catch(function () { showPasswordError('Could not change the password. Please try again.'); })
            .finally(function () { doneButton.disabled = false; });
    });

    // Icons used when the eye buttons switch (same drawing as the PHP icon() helper).
    var eyeBase = '<svg class="cf-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/>';
    var eyeSvg = eyeBase + '</svg>';
    var eyeOffSvg = eyeBase + '<path d="M3 3l18 18"/></svg>';
});
