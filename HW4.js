/*Kaitlin Frani
CPSC431-02
HW#4
3/27/23
*/
// form, list, remove button variables
const form = document.querySelector("form");
const outputList = document.querySelector("#univlist");
const defaultList = document.querySelector("#univitem");
const defaultRemoveButton = defaultList.querySelector(".remove_btn");

// add item to list
function addItem(data) {
  // create element list
  const listItem = document.createElement("li");

  // list format
  const listHtml = `
    <img src="${data.photo}" alt="${data.univname}">
      <h3>${data.univname}</h3>
      <p>${data.location}</p>
      <p>${data.description}</p>
      <button class="remove_btn">Remove</button>
  `;

  // html to list 
  listItem.innerHTML = listHtml;

  // replace new item
  if (outputList.firstElementChild == defaultList) {
    outputList.removeChild(defaultList);
  }

  // append item to the list
  outputList.appendChild(listItem);
}

// remove items from list
function removeItem(listItem) {
  // update the list on the page
  outputList.removeChild(listItem);

  // show default item of csuf
  if (outputList.children.length === 0) {
    outputList.appendChild(defaultList);
  }
}

// check when submit is clicked
form.addEventListener("submit", function (event) {
  // prevent default
  event.preventDefault();

  // receive input values and put it onto list
  addItem({
    univname: form.elements["univname"].value,
    location: form.elements["location"].value,
    photo: form.elements["photo"].value,
    description: form.elements["description"].value
  });

  // reload form
  form.reset();
});

// check when remove button is clicked
outputList.addEventListener("click", function (event) {
  // remove the items
  if (event.target.classList.contains("remove_btn")) {
    const listItem = event.target.closest("li");
    if (listItem !== defaultList) {
      removeItem(listItem);
    }
  }
});
