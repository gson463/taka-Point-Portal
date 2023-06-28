// Fetch house addresses from the database and populate the select element
var houseAddresses = ['123 Main St', '456 Elm St', '789 Oak St']; // Example data

var houseAddressSelect = document.getElementById('houseAddressSelect');
for (var i = 0; i < houseAddresses.length; i++) {
  var option = document.createElement('option');
  option.value = houseAddresses[i];
  option.text = houseAddresses[i];
  houseAddressSelect.appendChild(option);
}

// Handle tab switching
function changeTab(tabId) {
  var tabs = document.getElementsByClassName('tab-pane');
  for (var i = 0; i < tabs.length; i++) {
    tabs[i].classList.remove('show', 'active');
  }

  var selectedTab = document.getElementById(tabId);
  selectedTab.classList.add('show', 'active');
}

// Handle form submissions
var registrationForm = document.getElementById('registrationForm');
registrationForm.addEventListener('submit', function(event) {
  event.preventDefault();
  // Process registration form submission
  var houseHolder = document.getElementById('houseHolder').value;
  var houseAddress = document.getElementById('houseAddress').value;
  var houseType = document.getElementById('houseType').value;
  var contactAddress = document.getElementById('contactAddress').value;

  // Perform further processing or submit data to the server

  // Clear form inputs
  registrationForm.reset();
});

var paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener('submit', function(event) {
  event.preventDefault();
  // Process payment form submission
  var selectedHouseAddress = document.getElementById('houseAddressSelect').value;
  var amount = document.getElementById('amount').value;
  var paymentType = document.getElementById('paymentType').value;
  var date = document.getElementById('date').value;

  // Perform further processing or submit data to the server

  // Clear form inputs
  paymentForm.reset();
});

// Show the initial tab (register form)
changeTab('registerTab');
