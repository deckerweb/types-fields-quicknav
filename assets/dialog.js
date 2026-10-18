/* Local changelog dialog. Copyright 2026 David Decker – DECKERWEB. GPL-2.0-or-later. */
(() => {
    'use strict';
    const dialog = document.getElementById('dtfq-history');
    if (!dialog || dialog.dataset.bound || typeof HTMLDialogElement === 'undefined') return;
    dialog.dataset.bound = '1';
    let opener;
    const nativeShow = HTMLDialogElement.prototype.showModal;
    const nativeClose = HTMLDialogElement.prototype.close;
    document.querySelectorAll('[data-dtfq-dialog="dtfq-history"]').forEach(link => {
        link.addEventListener('click', event => {
            try {
                dialog.hidden = false;
                nativeShow.call(dialog);
                if (dialog.open) {
                    opener = link;
                    event.preventDefault();
                } else dialog.hidden = true;
            } catch (_) { dialog.hidden = true; }
        });
    });
    dialog.addEventListener('click', event => {
        if (event.target !== dialog) return;
        const box = dialog.getBoundingClientRect();
        if (event.clientX < box.left || event.clientX > box.right || event.clientY < box.top || event.clientY > box.bottom) nativeClose.call(dialog);
    });
    dialog.addEventListener('close', () => { dialog.hidden = true; if (opener) opener.focus(); });
})();
