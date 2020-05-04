/* Insert your javascript here */
document.addEventListener('DOMContentLoaded', function () {

  const main_secs = document.querySelectorAll(".main-section");
  const nav_links = document.querySelectorAll(".nav-item a");

  const makeActive = (item) => nav_links[item].classList.add("active");
  const removeActive = (item) => nav_links[item].classList.remove("active");
  const removeAllActive = () => [...main_secs.keys()].forEach((item) => removeActive(item));

  const sectionMargin = 200;

  var nowActive = 0;

  window.onscroll = () => {

    var currentSec = main_secs.length - [...main_secs].reverse().findIndex((section) => window.scrollY >= section.offsetTop - sectionMargin) - 1

    if (currentSec !== nowActive) {
      removeAllActive();
      nowActive = currentSec;
      makeActive(currentSec);
    }
  };
});

const days = { 'MON': 'Monday', 'TUE': 'Tuesday', 'WED': 'Wednesday', 'THU': 'Thursday', 'FRI': 'Friday', 'SAT': 'Saturday', 'SUN': 'Sunday' };
const weekDays = ['MON','TUE', 'WED','THU','FRI'];
const movieID = { 'ACT': 'Avengers: Endgame', 'RMC': 'Top End Wedding', 'ANM': 'Dumbo', 'AHF': 'The Happy Prince' };
const timeConvert = { 'T12': '12pm', 'T15': '3pm', 'T18': '6pm', 'T21': '9pm' };
const seatPrice = { 'STA': 19.80, 'STP': 17.50, 'STC': 15.30, 'FCA': 30.00, 'FCP': 27.00, 'FCC': 24.00 };
const seatDiscount = { 'STA': 14.00, 'STP': 12.50, 'STC': 11.00, 'FCA': 24.00, 'FCP': 22.50, 'FCC': 21.00 };
var currentMovieID;
var currentMovieName;
var showtime;
var dayShort;

function toggleSynopsis(whichID) {
  var whichMovie = document.getElementById("synopsis" + whichID);
  var synopsisDisplay = whichMovie.style.display;

  for (var i = 0; i < Object.keys(movieID).length; i++) {
    if (Object.keys(movieID)[i] == whichID) {
      if (synopsisDisplay == 'block') {
        whichMovie.style.display = 'none';
      }
      else {
        whichMovie.style.display = 'block';
      }
    }
    else {
      var whichMovie2 = document.getElementById("synopsis" + Object.keys(movieID)[i]);
      whichMovie2.style.display = 'none';
    }
  }
  currentMovieID = whichID;
  currentMovieName = movieID[whichID];
}

const bookingBtn = [...document.querySelectorAll(".booking-btn")];
const bookSection = document.getElementById("Booking-collapse");
bookingBtn.forEach((btnElement) => btnElement.addEventListener('click', toggleBooking));

function toggleBooking() {
  showtime = this.innerHTML;
  document.getElementById('auto-info').innerHTML = currentMovieName + " - " + showtime;
  bookSection.style.display = 'block';
  document.getElementById('movie-id').value = currentMovieID;
  for (var i = 0; i < Object.values(days).length; i++) {
    if (showtime.includes(Object.values(days)[i])) {
      document.getElementById('movie-day').value = Object.keys(days)[i];
    }
  }
  for (var i = 0; i < Object.values(timeConvert).length; i++) {
    if (showtime.includes(Object.values(timeConvert)[i])) {
      document.getElementById('movie-hour').value = Object.keys(timeConvert)[i];
    }
  }
  calcPrice();
  console.log(document.getElementById('movie-id').value + " " + document.getElementById('movie-day').value + " " + document.getElementById('movie-hour').value);
}

const closeBook = document.getElementById("close-booking");
closeBook.addEventListener('click', closeBooking);

function closeBooking() {
  bookSection.style.display = 'none';
  console.log(document.getElementById('movie-id').value + " " + document.getElementById('movie-day').value + " " + document.getElementById('movie-hour').value);
}

var selections = [...document.querySelectorAll(".seat-select")];
selections.forEach(addList);

function addList(selection) {
  for (var i = 1; i <= 10; i++) {
    var options = document.createElement('option');
    options.text = options.value = i;
    options.style.fontWeight = "bold";
    selection.add(options);
  }
}
selections.forEach((seatItem) => seatItem.addEventListener('change', calcPrice));

function calcPrice() {
  var totalPrice = 0;
  for (let i = 0; i < selections.length; i++) {
      if (document.getElementById('movie-day').value == 'MON' || document.getElementById('movie-day').value == 'WED' ||
      (weekDays.includes(document.getElementById('movie-day').value) && document.getElementById('movie-hour').value == 'T12')) {
        totalPrice += seatDiscount[selections[i].id.slice(-3)] * selections[i].value;
      }
      else {
        totalPrice += seatPrice[selections[i].id.slice(-3)] * selections[i].value;
      }
  }
  document.getElementById('total').innerHTML = totalPrice.toFixed(2);
}

function checkCustName(){
  var nameInput = document.getElementById('cust-name');
  var pattern = /^[a-zA-Z\'\.\-]+[\s]?([a-zA-Z\'\.\-]+[\s]?)+$/;
  if (pattern.test(nameInput.value)){
    nameInput.style.border = '2px solid #008040';
    console.log('name valid');
    return true;
  }
  else{
    nameInput.style.border = '2px solid #C00000';
    console.log('name invalid');
    return false;
  }
}

function checkCustMobile() {
  var mobileInput = document.getElementById('cust-mobile');
  var pattern = /^(\(04\)|04|\+61[\s]?4)[\s]?(\d[\s]?){8}$/;
  if (pattern.test(mobileInput.value)){
    mobileInput.style.border = '2px solid #008040';
    console.log('mobile valid');
    return true;
  }
  else{
    mobileInput.style.border = '2px solid #C00000';
    console.log('mobile invalid');
    return false;
  }
}

function checkCustCard() {
  var cardInput = document.getElementById('cust-card');
  var pattern = /^(\d[\s]?){14,19}$/;
  if (pattern.test(cardInput.value)){
    cardInput.style.border = '2px solid #008040';
    console.log('card valid');
    return true;
  }
  else{
    cardInput.style.border = '2px solid #C00000';
    console.log('card invalid');
    return false;
  }
}

document.getElementById('cust-expiry').min = new Date().toISOString().slice(0,7);

function checkAllCustInput(){
  var submitButton = document.getElementById('order');

  if (checkCustName() && checkCustMobile() && checkCustCard()){
    submitButton.disabled = false;
    console.log('All inputs are valid');
  }
  else{
    submitButton.disabled = true;
    console.log('Some inputs are invalid');
  }
}