import './bootstrap';

window.toggleVisibility = function (selector) {
    const el = document.querySelector(selector);
    const current = el.style.display;

    if (current == "none") {
        // If we toggled to not visible, the previous value should be stored
        // If we didn't then set it to ""
        el.style.display = el['data-toggle-visibility-from'] || "";
        el['data-toggle-visibility-from'] = undefined;
    } else {
        el['data-toggle-visibility-from'] = current;
        el.style.display = 'none';
    }
}