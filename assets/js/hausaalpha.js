var slideIndex = 0; // Start the index at 0
showSlides(slideIndex);

// Navigate slides
function plusSlides(n) {
    showSlides(slideIndex += n);
}

// Show current slide
function showSlides(n) {
    var slides = document.getElementsByClassName("mySlides");
    if (n >= slides.length) { slideIndex = 0; }
    if (n < 0) { slideIndex = slides.length - 1; }

    for (var i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[slideIndex].style.display = "block";

    // Auto-play sounds
    let letterSound = document.getElementById('letter' + slideIndex);
    let objectSound = document.getElementById('object' + slideIndex);
    letterSound.play();
    setTimeout(() => objectSound.play(), 2000);
}

// Auto-swipe every 3 minutes
setInterval(function () {
    plusSlides(1);
}, 180000); // 3 minutes

// Play sound manually
function playSound(id) {
    document.getElementById(id).play();
}
