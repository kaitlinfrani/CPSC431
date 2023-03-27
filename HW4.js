const form = document.querySelector("form");
const outputList = document.querySelector("#univlist");
const defaultListItem = document.querySelector("#univitem");
const defaultRemoveButton = defaultListItem.querySelector(".remove_btn");
defaultRemoveButton.disabled = true;

function addItemToList(univname, location, photo, description) {
  const listItem = document.createElement("li");
  listItem.innerHTML = `
    <img src="${photo}" alt="${univname}">
    <h3>${univname}</h3>
    <p>${location}</p>
    <p>${description}</p>
    <button class="remove_btn">Remove</button>
  `;
  if (outputList.firstElementChild == defaultListItem) {
    outputList.removeChild(defaultListItem);
  }
  outputList.appendChild(listItem);
  if (defaultRemoveButton.disabled) {
    defaultRemoveButton.disabled = false;
  }
}

function removeItemFromList(listItem) {
  outputList.removeChild(listItem);
  if (outputList.children.length === 0) {
    outputList.appendChild(defaultListItem);
    defaultRemoveButton.disabled = true;
  }
}

form.addEventListener("submit", (event) => {
  event.preventDefault();
  const univname = form.elements["univname"].value;
  const location = form.elements["location"].value;
  const photo = form.elements["photo"].value;
  const description = form.elements["description"].value;
  addItemToList(univname, location, photo, description);
  form.reset();
});

outputList.addEventListener("click", (event) => {
  if (event.target.classList.contains("remove_btn")) {
    const listItem = event.target.closest("li");
    if (listItem !== defaultListItem) {
      removeItemFromList(listItem);
    }
  }
});