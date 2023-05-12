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
      if (i === d.getUTCDate() && date.getUTCMonth() === d.getUTCMonth() && date.getUTCFullYear() === d.getUTCFullYear()) {
        days += `<div class="today" data-date="${d.getUTCFullYear()}-${d.getUTCMonth() + 1}-${d.getUTCDate()}">${i}</div>`;
        foundDate = true;
        break;
      }
    }
    if (!foundDate) {
      days += `<div data-date="${date.getFullYear()}-${date.getMonth() + 1}-${i}">${i}</div>`;
    }
  }
  
  

  for (let j = 1; j <= nextDays; j++) {
    days += `<div class="next-date">${j}</div>`;
  }

  monthDays.innerHTML = days;
  const dayElements = monthDays.querySelectorAll('[data-date]');
  dayElements.forEach(day => {
    day.addEventListener('click', () => {
      const selectedDate = day.dataset.date;
      fetchAvailableHours(selectedDate);
    });
  });
};
const fetchAvailableHours = (selectedDate) => {
  fetch(`conexion_horas.php?fecha=${selectedDate}`)
    .then(response => response.json())
    .then(data => {
      showAvailableHours(data);
    })
    .catch(error => console.error(error));
};

const showAvailableHours = (hours) => {
  const availableHoursElement = document.querySelector('#available-hours');

  // Limpiar cualquier contenido anterior del div
  availableHoursElement.innerHTML = '';

  // Si no hay horas disponibles, mostrar un mensaje indicando que no hay horas disponibles
  if (hours.length === 0) {
    availableHoursElement.textContent = 'No hay horas disponibles para esta fecha.';
    return;
  }

    // Agregar event listener a los elementos con la clase "today"
const todayElements = document.querySelectorAll('.today');
todayElements.forEach(todayElement => {
  todayElement.addEventListener('click', () => {
    const selectedFechaElement = document.getElementById('selected-fecha');
    selectedFechaElement.value = todayElement.getAttribute('data-date');
  });
});
  // Iterar sobre las horas disponibles y agregar un div para cada hora
  hours.forEach(hour => {
    const hourDiv = document.createElement('div');
    hourDiv.textContent = hour;
    /* hourDiv.classList.add('hora_dispo');/* para agregar clase a los div */ 
    availableHoursElement.appendChild(hourDiv);
  });
};
document.addEventListener("DOMContentLoaded", function() {
  // Obtener el elemento input
  const hiddenInput = document.querySelector('#selectedHour');

  // Obtener los divs de horas disponibles
  const availableHours = document.querySelectorAll('#available-hours');

  // Agregar un event listener a cada div
  availableHours.forEach(hourDiv => {
    hourDiv.addEventListener('click', () => {
      // Obtener el valor de la hora y asignarlo al valor del input
      hiddenInput.value = hourDiv.textContent;
    });
  });
});

document.addEventListener('DOMContentLoaded', () => {
  const monthDays = document.querySelector('.days');
  const dayElements = monthDays.querySelectorAll('[data-date]');
  dayElements.forEach(day => {
    day.addEventListener('click', () => {
      const selectedDate = day.dataset.date;
      fetchAvailableHours(selectedDate);
    });
  });
});

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

const days = document.querySelectorAll('.days div');

days.forEach(day => {
  day.addEventListener('click', () => {
    const dateStr = day.dataset.date;
    const date = new Date(dateStr);
    const year = date.getFullYear();
    const month = date.getMonth() + 1;
    const dayOfMonth = date.getDate() + 1;
    const selectedDate = `${year}-${month}-${dayOfMonth}`;
    fetchAvailableHours(selectedDate);
  });
});




fetchDatesAndRenderCalendar();

