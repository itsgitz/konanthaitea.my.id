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
