function plus() {
    console.log('plus button click');
    var whichQty = document.getElementById('counter');
    whichQty.value = Number(whichQty.value) + 1;
    console.log(whichQty.name + ' quantity is: ' + whichQty.value);
}

function minus() {
    console.log('minus button click');
    var whichQty = document.getElementById('counter');
    if (whichQty.value > 0) {
        whichQty.value = Number(whichQty.value) - 1;
    }
    console.log(whichQty.name + ' quantity is: ' + whichQty.value);
}

function updateQuantity() {
    console.log('Update Quantity Function');
    var whichQty = document.getElementById('counter');
    var re = new RegExp("^[0-9]+$");
    if (!re.test(whichQty.value)) {
        alert('wrong quantity');
        return;
    }
    var price = whichQty.value * prices[whichID];
    console.log(whichQty.name + 'quantity is: ' + whichQty.value);
}