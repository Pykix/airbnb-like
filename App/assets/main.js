// Calendrier en js pour gerer les dates

flatpickr.localize(flatpickr.l10ns.fr);
flatpickr("#start_date", {
    altInput: true,
    altFormat: "j F, Y",
    minDate: "today",
    dateFormat: "Y-m-d",
})

flatpickr("#end_date", {
    altInput: true,
    altFormat: "j F, Y",
    minDate: "today",
    dateFormat: "Y-m-d",
})
