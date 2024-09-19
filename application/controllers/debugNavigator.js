// Create input field and button elements
const inputField = document.createElement("input");
inputField.type = "text";
inputField.id = "inputField";
inputField.placeholder = "Enter command...";

const goButton = document.createElement("button");
goButton.id = "goButton";
goButton.textContent = "Go";

const debugNavHolder = document.createElement("div");

// Append input field and button to the document body
document.body.appendChild(debugNavHolder);
debugNavHolder.appendChild(inputField);
debugNavHolder.appendChild(goButton);

var spacing = "5px";

// Style the input field and button
debugNavHolder.style.position = "fixed";
debugNavHolder.style.width = "100%";
debugNavHolder.style.display = "flex";
debugNavHolder.style.bottom = spacing;


inputField.style.width = "100%";
inputField.style.opacity = "0.4";
inputField.style.marginLeft = spacing;
inputField.style.marginRight = spacing;


goButton.style.width = "100px";
goButton.style.marginRight = spacing;
goButton.style.opacity = "0.4";

// Add click event listener to the button
goButton.addEventListener("click", function() {
  const inputValue = inputField.value.trim().toLowerCase();

  switch (inputValue) {
    case 'home':
      window.location.href = 'homepage.html';
      break;
    case 'about':
      window.location.href = 'about.html';
      break;
    case 'contact':
      window.location.href = 'contact.html';
      break;
    default:
      alert('Command not recognized');
  }
});

// Trigger button click on Enter key press
inputField.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    event.preventDefault();
    goButton.click();
  }
});