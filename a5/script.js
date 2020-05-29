var qty = document.getElementById("quantity");
var addToCart = document.getElementById("Add to Cart");
function plus() {
  console.log('plus button click');
  qty.value = Number(qty.value) + 1;
}

function minus() {
  console.log('minus button click');
  if (qty.value > 0) {
      qty.value = Number(qty.value) - 1;
  }
}

function updateQuantity() {
  var re = new RegExp("^[0-9]+$");
  if (!re.test(qty.value)) {
      alert('wrong quantity');
      addToCart.disabled = true;
      return;
  }
  else{
    addToCart.disabled = false;
  }
}

function checkCustInfo(){
  var submitButton = document.getElementById('order');
  var nameInput = document.getElementById('name');
  var mobileInput = document.getElementById('mobile')
  var addressInput =  document.getElementById('address');

  var namePattern = /^[a-zA-Z\'\.\-]+[\s]?([a-zA-Z\'\.\-]+[\s]?)+$/;
  var mobilePattern = /^(\(04\)|04|\+61[\s]?4)[\s]?(\d[\s]?){8}$/;

  if (namePattern.test(nameInput.value) && mobilePattern.test(mobileInput.value) && addressInput.value != ''){
    submitButton.disabled = false;
  }
}
function displayThank(){
  alert('Thank you for shopping with us!');
}