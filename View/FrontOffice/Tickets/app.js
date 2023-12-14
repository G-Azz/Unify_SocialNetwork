const faqs = document.querySelectorAll('.faq');
faqs.forEach((faq) => {
    faq.addEventListener("click", () => {
        faq.classList.toggle("active");
    });
});
function validateDescription(event) {
    const description = document.getElementById('descriptions').value;
    const maxLength = 100;

    if (description.length > maxLength) {
        document.getElementById('charCount').innerText = 'Ticket description should not exceed 100 characters.';
        event.preventDefault(); // Prevent form submission
        return false;
    }

    return true; // Allow form submission
};

