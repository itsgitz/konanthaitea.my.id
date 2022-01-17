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

  let ordersMain = document.querySelector('#admin-orders-main');

  if (ordersMain) {
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

export function adminOrdersMain() {
  let ordersMain = document.querySelector('#admin-orders-main');

  if (ordersMain) {
    let orderPaymentStatus = document.getElementsByClassName('order-payment-status');
    let orderDeliveryStatus = document.getElementsByClassName('order-delivery-status');

    setOrderPaymentStatusClass(orderPaymentStatus);
    setOrderDeliveryStatusClass(orderDeliveryStatus);
  }
}

function setOrderPaymentStatusClass(statusEl) {
  const paymentStatus = {
    unpaid: 'Unpaid',
    paid: 'Paid',
    canceled: 'Canceled'
  };

  Array.prototype.forEach.call(statusEl, function(el) {
    switch (el.dataset.orderPaymentStatus) {
      case paymentStatus.unpaid:
        el.className += ' bg-danger';
        break;

      case paymentStatus.paid:
        el.className += ' bg-success';
        break;

      case paymentStatus.canceled:
        el.className += ' bg-danger';
        break;
    }
  });
}

function setOrderDeliveryStatusClass(statusEl) {
  const deliveryStatus = {
    waiting: 'Waiting',
    confirmed: 'Confirmed',
    onProgress: 'On Progress',
    ready: 'Ready',
    delivery: 'Delivery',
    finish: 'Finish',
    failed: 'Failed',
    canceled: 'Canceled',
  }

  Array.prototype.forEach.call(statusEl, function(el) {
    switch (el.dataset.orderDeliveryStatus) {
      case deliveryStatus.waiting:
        el.className += ' bg-secondary';
        break;

      case deliveryStatus.confirmed:
        el.className += ' bg-primary';
        break;

      case deliveryStatus.onProgress:
        el.className += ' bg-primary';
        break;

      case deliveryStatus.ready:
        el.className += ' bg-success';
        break;

      case deliveryStatus.delivery:
        el.className += ' bg-warning';
        break;

      case deliveryStatus.finish:
        el.className += ' bg-success';
        break;

      case deliveryStatus.failed:
        el.className += ' bg-danger';
        break;

      case deliveryStatus.canceled:
        el.className += ' bg-danger';
        break;
    }
  });

}
