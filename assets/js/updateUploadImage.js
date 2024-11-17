document.getElementById('image').addEventListener('change', function(event) {
    const fileInput = event.target;
    const file = fileInput.files[0];

    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            document.querySelector('img').src = e.target.result;
        }
        
        reader.readAsDataURL(file);
    }
});
