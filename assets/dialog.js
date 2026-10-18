/* Host-scoped document dialogs. Copyright 2026 David Decker – DECKERWEB. GPL-2.0-or-later. */
(() => {
    'use strict';
    if (window.dtfqDocumentDialogs) return;
    window.dtfqDocumentDialogs = true;
    const openers = new WeakMap();
    const owned = dialog => dialog?.matches('.dtfq-settings dialog.dtfq-document-dialog');
    /** Close our document through the native API and restore its own opener. */
    const close = dialog => {
        if (!owned(dialog)) return;
        try {
            const nativeClose = window.HTMLDialogElement?.prototype.close;
            if (dialog.open && typeof nativeClose === 'function') nativeClose.call(dialog);
        } catch (_) { /* The hidden guard also closes a damaged instance. */ }
        dialog.removeAttribute('open');
        dialog.hidden = true;
        const opener = openers.get(dialog);
        if (opener?.isConnected) opener.focus({preventScroll: true});
    };
    document.addEventListener('click', event => {
        if (!(event.target instanceof Element)) return;
        const closer = event.target.closest('[data-dtfq-close]');
        if (closer) {
            const dialog = closer.closest('dialog');
            if (!owned(dialog)) return;
            event.preventDefault();
            event.stopPropagation();
            close(dialog);
            return;
        }
        const opener = event.target.closest('.dtfq-footer [data-dtfq-dialog]');
        if (opener) {
            const dialog = document.getElementById(opener.dataset.dtfqDialog);
            const nativeShow = window.HTMLDialogElement?.prototype.showModal;
            if (!owned(dialog) || typeof nativeShow !== 'function') return;
            try {
                dialog.hidden = false;
                nativeShow.call(dialog);
                if (!dialog.open) { dialog.hidden = true; return; }
            } catch (_) {
                close(dialog);
                return; // The real document link remains usable if opening fails.
            }
            openers.set(dialog, opener);
            event.preventDefault();
            event.stopPropagation();
            dialog.querySelector('.dtfq-document-content').scrollTop = 0;
            return;
        }
        if (owned(event.target) && event.target.open) {
            const box = event.target.getBoundingClientRect();
            if (event.clientX < box.left || event.clientX > box.right || event.clientY < box.top || event.clientY > box.bottom) close(event.target);
        }
    }, true);
    document.addEventListener('cancel', event => {
        if (!owned(event.target)) return;
        event.preventDefault();
        close(event.target);
    }, true);
    document.addEventListener('close', event => {
        if (!owned(event.target) || event.target.open) return;
        event.target.hidden = true;
        const opener = openers.get(event.target);
        if (opener?.isConnected) opener.focus({preventScroll: true});
    }, true);
})();
