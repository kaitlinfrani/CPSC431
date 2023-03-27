// Select the form and output list elements
const form = document.querySelector("form");
const outputList = document.querySelector("#univlist");

// Select the default list item and remove button
const defaultListItem = document.querySelector("#univitem");
const defaultRemoveButton = defaultListItem.querySelector(".remove_btn");

// Disable the remove button
defaultRemoveButton.disabled = true;

// Function to add a new item to the list
function addItemToList(univname, location, photo, description) {
  // Create a new list item element
  const listItem = document.createElement("li");

  // Create a structure for the list item
  const listItemHtml = `
    <img src="${photo}" alt="${univname}">
      <h3>${univname}</h3>
      <p>${location}</p>
      <p>${description}</p>
      <button class="remove_btn">Remove</button>
  `;

  // Set the HTML of the new list item
  listItem.innerHTML = listItemHtml;

  // Remove default list item if adding a new list item
  if (outputList.firstElementChild == defaultListItem) {
    outputList.removeChild(defaultListItem);
  }
  // Add the new list item to the output list
  outputList.appendChild(listItem);

  // Enable the default remove button if it was disabled
  if (defaultRemoveButton.disabled) {
    defaultRemoveButton.disabled = false;
  }
}

// Function to remove an item from the list
function removeItemFromList(listItem) {
  // Remove the list item from the output list
  outputList.removeChild(listItem);

  // If there are no more list items, show the default list item and disable its remove button
  if (outputList.children.length === 0) {
    outputList.appendChild(defaultListItem);
    defaultRemoveButton.disabled = true;
  }
}

// Event listener to the form to handle form submissions
form.addEventListener("submit", function (event) {
  // Prevent the default form submission behavior
  event.preventDefault();

  // Get the form input values
  const univname = form.elements["univname"].value;
  const location = form.elements["location"].value;
  const photo = form.elements["photo"].value;
  const description = form.elements["description"].value;

  // Add a new item to the list with the form input values
  addItemToList(univname, location, photo, description);

  // Reset the form
  form.reset();
});

// Add an event listener to the output list to handle remove button clicks
outputList.addEventListener("click", function (event) {
  // If the clicked element is a remove button, remove its list item
  if (event.target.classList.contains("remove_btn")) {
    const listItem = event.target.closest("li");
    if (listItem !== defaultListItem) {
      removeItemFromList(listItem);
    }
  }
});
