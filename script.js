// script.js

// Note: This script relies on constants defined in data.js 
// (IMAGE_BASE_PATH, GALLERY_DATA_SOURCE, TESTIMONIALS_DATA)

// =======================================================
// 1. Carousel Logic (Image Gallery)
// =======================================================

const carouselTrack = document.getElementById('carousel-track');
const prevButton = document.querySelector('.prev-btn');
const nextButton = document.querySelector('.next-btn');

let currentSlideIndex = 0;
let slideCount = 0;

function updateCarousel() {
    if (carouselTrack) {
        // Calculate the distance to move the track (in percent)
        const trackTranslateX = -currentSlideIndex * 100; 
        carouselTrack.style.transform = `translateX(${trackTranslateX}%)`;
    }
    
    // Manage button visibility
    if (prevButton) prevButton.style.display = (currentSlideIndex === 0) ? 'none' : 'block';
    if (nextButton) nextButton.style.display = (currentSlideIndex === slideCount - 1) ? 'none' : 'block';
}

function showNextSlide() {
    if (currentSlideIndex < slideCount - 1) {
        currentSlideIndex++;
        updateCarousel();
    }
}

function showPreviousSlide() {
    if (currentSlideIndex > 0) {
        currentSlideIndex--;
        updateCarousel();
    }
}

function loadGallery() {
    fetch(GALLERY_DATA_SOURCE)
        .then(response => {
            if (!response.ok) throw new Error("Could not fetch gallery_data.json.");
            return response.json();
        })
        .then(imageNames => {
            carouselTrack.innerHTML = '';
            slideCount = imageNames.length;
            
            if (slideCount === 0) {
                carouselTrack.innerHTML = '<p style="text-align:center;">No images configured for the carousel.</p>';
                if (prevButton) prevButton.style.display = 'none';
                if (nextButton) nextButton.style.display = 'none';
                return;
            }

            imageNames.forEach(imageName => {
                const slide = document.createElement('div');
                slide.classList.add('carousel-slide');
                
                const img = document.createElement('img');
                img.src = IMAGE_BASE_PATH + imageName;
                // Removes file extension for cleaner alt text
                img.alt = 'Mobile Repair Work: ' + imageName.replace(/\.[^/.]+$/, ""); 
                
                slide.appendChild(img);
                carouselTrack.appendChild(slide);
            });
            
            // Initialize event listeners only if we have more than one slide
            if (slideCount > 1) {
                if (prevButton) prevButton.addEventListener('click', showPreviousSlide);
                if (nextButton) nextButton.addEventListener('click', showNextSlide);
            } else {
                // Hide buttons if only one image is present
                if (prevButton) prevButton.style.display = 'none';
                if (nextButton) nextButton.style.display = 'none';
            }

            updateCarousel(); // Initial position update
        })
        .catch(error => {
            console.error("Error during carousel setup:", error);
            if (carouselTrack) carouselTrack.innerHTML = '<p style="text-align:center; color: red;">Error loading carousel images.</p>';
        });
}


// =======================================================
// 2. Testimonial Management
// =======================================================

const testimonialContainer = document.getElementById('testimonial-container');

function loadTestimonials() {
    // Uses TESTIMONIALS_DATA defined in data.js
    if (typeof TESTIMONIALS_DATA === 'undefined') {
        console.error("Testimonial data not loaded! Check if data.js is linked correctly.");
        return;
    }

    testimonialContainer.innerHTML = ''; 

    TESTIMONIALS_DATA.forEach(data => {
        const card = document.createElement('div');
        card.classList.add('testimonial-card');

        const quote = document.createElement('p');
        quote.classList.add('quote');
        quote.textContent = `"${data.quote}"`;

        const author = document.createElement('p');
        author.classList.add('author');
        author.textContent = `- ${data.author}`;

        card.appendChild(quote);
        card.appendChild(author);
        testimonialContainer.appendChild(card);
    });
}


// =======================================================
// 3. Initialize on Page Load
// =======================================================
document.addEventListener('DOMContentLoaded', () => {
    loadGallery();
    loadTestimonials();
});