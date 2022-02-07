import datePicker from 'js-datepicker';

export function myDatePicker() {
  const months = [
    'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  ];

  const days = [
    'Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'
  ];

  let restockMain = document.querySelector('#admin-restock-main');

  if (restockMain) {
    const start = datePicker('#date-from', {
      id: 1,
      showAllDates: true,
      customDays: days,
      customMonths: months,
      formatter: (input, date, instance) => {
        let year = date.getFullYear();
        let customMonth = '';
        let customDate = '';

        if (date.getMonth() < 10) {
          customMonth = '0' + parseInt(date.getMonth() + 1);
        } else {
          customMonth = parseInt(date.getMonth() + 1);
        }

        if (date.getDate() < 10) {
          customDate = '0' + date.getDate();
        } else {
          customDate = date.getDate();
        }

        const value = `${year}-${customMonth}-${customDate}`;
        input.value = value;
      }
    });

    start.calendarContainer.style.setProperty('width', '100%');

    const end = datePicker('#date-to', {
      id: 1,
      showAllDates: true,
      customDays: days,
      customMonths: months,
      formatter: (input, date, instance) => {
        let year = date.getFullYear();
        let customMonth = '';
        let customDate = '';

        if (date.getMonth() < 10) {
          customMonth = '0' + parseInt(date.getMonth() + 1);
        } else {
          customMonth = parseInt(date.getMonth() + 1);
        }

        if (date.getDate() < 10) {
          customDate = '0' + date.getDate();
        } else {
          customDate = date.getDate();
        }

        const value = `${year}-${customMonth}-${customDate}`;
        input.value = value;
      }
    });
    end.calendarContainer.style.setProperty('width', '100%');


    let exportPdfButton = document.querySelector('#export-pdf-button');
    let datePickerBox = document.querySelector('#datepicker-box');

  exportPdfButton.addEventListener('click', function() {
    if (datePickerBox.classList.contains('d-none')) {
      datePickerBox.classList.remove('d-none');
    } else {
      datePickerBox.classList.add('d-none');
    }
  });
  }
}
