const modal = document.getElementById("editModal");
const closeModal = document.getElementById("closeModal");
const saveChanges = document.getElementById("saveChanges");
const modalTextarea = document.getElementById("modalTextarea");

document.querySelectorAll(".edit-button").forEach(button => {
    button.onclick = function() {
        const targetId = button.getAttribute("data-target");
        currentEditableElement = document.getElementById(targetId);
        if (currentEditableElement) {
            modalTextarea.value = currentEditableElement.textContent;
            modal.style.display = "flex";
        }
    };
});

closeModal.onclick = function() {
    modal.style.display = "none";
};

saveChanges.onclick = function() {
    if (currentEditableElement) {
        currentEditableElement.textContent = modalTextarea.value;
    }
    modal.style.display = "none";
};

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};
