flatpickr.localize(flatpickr.l10ns.fr);
flatpickr("#start_date", {
    altInput: true,
    altFormat: "F j, Y",
    minDate: "today",
    dateFormat: "Y-m-d",
})

flatpickr("#end_date", {
    altInput: true,
    altFormat: "F j, Y",
    minDate: "today",
    dateFormat: "Y-m-d",
})
