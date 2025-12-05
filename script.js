// =======================================================
// 1. Gallery Image Management
//    (Easy way to add images from the 'images/' folder)
// =======================================================

// *** IMPORTANT: Add the file names of your service pictures here ***
// Make sure these images exist in your 'images/' folder.
const imageNames = [
    'service1.jpg', // e.g., A picture of a screen repair
    'service2.jpg', // e.g., A new phone case product
    'service3.jpg', // e.g., Tools used for repair
    'service4.jpg'  // e.g., A repaired device working
    // Add more image filenames as needed
];

const galleryContainer = document.getElementById('image-gallery');
const imageBasePath = 'images/';

function loadGallery() {
    // Clear the loading placeholders
    galleryContainer.innerHTML = ''; 

    imageNames.forEach(imageName => {
        const item = document.createElement('div');
        item.classList.add('gallery-item');
        
        const img = document.createElement('img');
        img.src = imageBasePath + imageName;
        img.alt = 'Mobile Repair Service Picture: ' + imageName.replace('.jpg', '');
        
        item.appendChild(img);
        galleryContainer.appendChild(item);
    });
}


// =======================================================
// 2. Testimonial Management
//    (Easy way to add/edit customer testimonials)
// =======================================================

// *** IMPORTANT: Add your customer testimonials here ***
const testimonialsData = [
    {
        quote: "Fastest screen replacement I've ever had. Highly recommend this service!",
        author: "Sarah M."
    },
    {
        quote: "Bought a durable case here. Great quality and fair price. Excellent customer service.",
        author: "John D."
    },
    {
        quote: "My phone was dead from water damage, but they brought it back to life! Amazing work and fair pricing.",
        author: "Mike R."
    }
    // Add more testimonials here
];

const testimonialContainer = document.getElementById('testimonial-container');

function loadTestimonials() {
    // Start fresh with the data defined above
    testimonialContainer.innerHTML = ''; 

    testimonialsData.forEach(data => {
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