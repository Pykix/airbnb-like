flatpickr.localize(flatpickr.l10ns.fr);
flatpickr("#rangeDate", {
    mode: "range",
    altInput: true,
    altFormat: "F j, Y",
    minDate: "today",
    dateFormat: "Y-m-d",
})