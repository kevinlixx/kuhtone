const date = new Date();

const renderCalendar = (dates) => {
  date.setDate(1);

  const monthDays = document.querySelector(".days");

  const lastDay = new Date(
    date.getFullYear(),
    date.getMonth() + 1,
    0
  ).getDate();

  const prevLastDay = new Date(
    date.getFullYear(),
    date.getMonth(),
    0
  ).getDate();

  const firstDayIndex = date.getDay();

  const lastDayIndex = new Date(
    date.getFullYear(),
    date.getMonth() + 1,
    0
  ).getDay();

  const nextDays = 7 - lastDayIndex - 1;

  const months = [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre",
  ];

  document.querySelector(".date h1").innerHTML = months[date.getMonth()];

  document.querySelector(".date p").innerHTML = date.toLocaleDateString('es-ES', {day: 'numeric', month: 'long', year: 'numeric'});

  let days = "";

  for (let x = firstDayIndex; x > 0; x--) {
    days += `<div class="prev-date">${prevLastDay - x + 1}</div>`;
  }

  for (let i = 1; i <= lastDay; i++) {
    let foundDate = false;
    for (let j = 0; j < dates.length; j++) {
        let d = new Date(dates[j]);

        if (i == d.getDate()+1 && date.getMonth() == d.getMonth() && date.getFullYear() == d.getFullYear()) {
            days += `<div class="today">${i}</div>`;
            foundDate = true;
            break;
            
        }
    }
    if (!foundDate) {
        days += `<div>${i}</div>`;
    }
}

  for (let j = 1; j <= nextDays; j++) {
    days += `<div class="next-date">${j}</div>`;
  }

  monthDays.innerHTML = days;
};

document.querySelector(".prev").addEventListener("click", () => {
  date.setMonth(date.getMonth() - 1);
  fetchDatesAndRenderCalendar();
});

document.querySelector(".next").addEventListener("click", () => {
  date.setMonth(date.getMonth() + 1);
  fetchDatesAndRenderCalendar();
});

const fetchDatesAndRenderCalendar = () => {
  fetch('conexion_fecha.php')
    .then(response => response.json())
    .then(data => {
      renderCalendar(data);
    })
    .catch(error => console.error(error));
};

fetchDatesAndRenderCalendar();

