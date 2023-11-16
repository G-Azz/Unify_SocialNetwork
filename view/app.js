const faqs = document.querySelectorAll('.faq');
faqs.forEach((faq) => {
    faq.addEventListener("click", () => {
        faq.classList.toggle("active");
    });
});

const reclamationButton = document.getElementById('reclamationButton');
const reclamationContent = document.getElementById('reclamationContent');
const reclamationForm = document.getElementById('reclamationForm');
const page1 = document.querySelector('.page1');

reclamationButton.addEventListener('click', function() {
    if (reclamationContent.style.display === 'block') {
        reclamationContent.style.display = 'none';
        page1.classList.remove('blurred');
    } else {
        reclamationContent.style.display = 'block';
        page1.classList.add('blurred');
    }
});