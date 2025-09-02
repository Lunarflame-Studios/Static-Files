const INTERACTABLE = document.querySelectorAll(".interactable");
let overlay = document.getElementById("overlay");
let zoomIn = document.getElementById("zoom-in");

INTERACTABLE.forEach(function(image) {
    image.addEventListener('click', function() {
        zoomIn.src = image.src;

        overlay.style.display = 'block';
        zoomIn.style.display = 'block';
    });
});

overlay.addEventListener('click', function() {
    overlay.style.display = 'none';
    zoomIn.style.display = 'none';
});
