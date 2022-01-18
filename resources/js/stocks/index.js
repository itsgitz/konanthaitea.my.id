export function setStockStatusClass() {
  let stockIndex = document.querySelector('#admin-stock-index');

  if (stockIndex) {
    let stockStatusElement = document.getElementsByClassName('stock-status');

    const stockStatus = {
      available: 'Available',
      notAvailable: 'Not Available',
      limited: 'Limited',
    };


    Array.prototype.forEach.call(stockStatusElement, function(el) {
      switch (el.dataset.stockStatus) {
        case stockStatus.available:
          el.className += ' text-success';
          break;
        case stockStatus.notAvailable:
          el.className += ' text-danger';
          break;

        case stockStatus.limited:
          el.className += ' text-warning';
      }
    })
  }
}
