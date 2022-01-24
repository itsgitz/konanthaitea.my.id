export function delivery() {
  let cartDeliveryElement = document.querySelector('#cart-delivery');

  if (cartDeliveryElement) {
    // Total order
    let totalOrderElement = document.querySelector('#total-order');

    // Address alert message
    let addressAlertElement = document.querySelector('#address-alert');
    let phoneAlertElement = document.querySelector('#phone-alert');

    if (addressAlertElement || phoneAlertElement) {
      cartDeliveryElement.value = 'Delivery';
    }

    // Total price
    let selectedValue = cartDeliveryElement.options[cartDeliveryElement.selectedIndex].value;
    let cartAddressBoxElement = document.querySelector('#cart-address-box');
    let cartAddressElement = document.querySelector('#cart-address');
    let cartPhoneElement = document.querySelector('#cart-phone');
    let totalPriceElement = document.querySelector('#total-price');
    let hiddenTotalPriceElement = document.querySelector('#hidden-total-price')
    let hiddentTotalOrderElement = document.querySelector('#hidden-total-order');

    // Delivery fee
    let deliveryFeeBoxElement = document.querySelector('#delivery-fee-box');
    let deliveryElement = document.querySelector('#delivery-fee');
    //let deliveryFeeNum = 11000;

    let kecamatanKelurahanElement = document.querySelector('#kecamatanKelurahan');
    let selectedValueKecamatanKelurahan = kecamatanKelurahanElement.options[kecamatanKelurahanElement.selectedIndex].value;
    let regionFee = selectedValueKecamatanKelurahan.split('|')[0];
    let regionName = selectedValueKecamatanKelurahan.split('|')[1];

    let hiddenRegionElement = document.querySelector('#regionName');


    totalOrderElement.innerHTML = `Rp. ${convertToMoney(hiddentTotalOrderElement.value)},00`;

    // Onload
    if (selectedValue == 'Delivery') {
      cartAddressBoxElement.classList.remove('d-none');
      cartAddressElement.disabled = false;
      cartPhoneElement.disabled = false;
      kecamatanKelurahanElement.disabled = false;
      deliveryFeeBoxElement.classList.remove('d-none');

      deliveryElement.innerHTML = `Rp. ${convertToMoney(regionFee)},00`;
      totalPriceElement.innerHTML = `Rp. ${convertToMoney(hiddentTotalOrderElement.value, regionFee)},00`;
    } else {
      cartAddressBoxElement.classList.add('d-none');
      cartAddressElement.disabled = true;
      cartPhoneElement.disabled = true;
      kecamatanKelurahanElement.disabled = true;
      hiddenTotalPriceElement.value = hiddentTotalOrderElement.value;
      totalPriceElement.innerHTML = `Rp. ${convertToMoney(hiddentTotalOrderElement.value)},00`;
    }

    // On change or selected
    cartDeliveryElement.addEventListener('change', function() {
      if (this.value == 'Delivery') {
        cartAddressBoxElement.classList.remove('d-none');
        cartAddressElement.disabled = false;
        cartPhoneElement.disabled = false;
        kecamatanKelurahanElement.disabled = false;
        deliveryFeeBoxElement.classList.remove('d-none');

        // deliveryElement.innerHTML = `Rp. ${convertToMoney(deliveryFeeNum)},00`;
        // totalPriceElement.innerHTML = `Rp. ${convertToMoney(hiddentTotalOrderElement.value, deliveryFeeNum)},00`
        // hiddenTotalPriceElement.value = parseInt(hiddentTotalOrderElement.value) + parseInt(deliveryFeeNum);
      } else {
        cartAddressBoxElement.classList.add('d-none');
        cartAddressElement.disabled = true;
        cartPhoneElement.disabled = true;
        kecamatanKelurahanElement.disabled = true;
        deliveryFeeBoxElement.classList.add('d-none');

        hiddenTotalPriceElement.value = hiddentTotalOrderElement.value;
        totalPriceElement.innerHTML = `Rp. ${convertToMoney(hiddentTotalOrderElement.value)},00`;
      }
    })

    kecamatanKelurahanElement.addEventListener('change', function() {
      let deliveryFeeNum = this.value.split('|')[0];

      deliveryElement.innerHTML = `Rp. ${convertToMoney(deliveryFeeNum)},00`;
      totalPriceElement.innerHTML = `Rp. ${convertToMoney(hiddentTotalOrderElement.value, deliveryFeeNum)},00`
      hiddenTotalPriceElement.value = parseInt(hiddentTotalOrderElement.value) + parseInt(deliveryFeeNum);
    });
  }
}

function convertToMoney(num, fee = 0) {
  let rupiah = Intl.NumberFormat('id-ID')
  let totalWithFee = parseInt(num) + parseInt(fee);
  let totalPriceMoneyFormat = rupiah.format(totalWithFee);

  return totalPriceMoneyFormat;
}
