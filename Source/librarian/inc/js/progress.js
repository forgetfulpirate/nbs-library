document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll('.form');
    const backButton = document.querySelectorAll('.backBtn');
    const nextButton = document.querySelectorAll('.nextBtn');
    const submitButton = document.querySelector('button[name="submit"]');
    let currentFormIndex = 0;

    function showForm(index) {
        forms.forEach(form => {
            form.style.display = 'none';
        });
        forms[index].style.display = 'block';
    }

    function validateForm(index) {
        const currentForm = forms[index];
        const inputs = currentForm.querySelectorAll('input[required], textarea[required], select[required]');
        let isValid = true;
        inputs.forEach(input => {
            if (!input.value.trim()) {
                isValid = false;
            }
        });
        return isValid;
    }

    function goToNextForm() {
        const currentForm = forms[currentFormIndex];
        const nextForm = forms[currentFormIndex + 1];
        if (validateForm(currentFormIndex)) {
            if (nextForm) {
                currentForm.style.display = 'none';
                nextForm.style.display = 'block';
                currentFormIndex++;
                if (currentFormIndex === forms.length - 1) {
                    submitButton.style.display = 'block'; // Show submit button when reaching the last form
                }
                nextForm.querySelector('input, select, textarea').focus();
            }
        } else {
            const invalidInputs = currentForm.querySelectorAll('input:invalid, select:invalid, textarea:invalid');
            if (invalidInputs.length > 0) {
                invalidInputs[0].focus();
                invalidInputs.forEach(input => {
                    input.style.borderColor = 'red';
                });
            }
        }
    }
    
    

    function goToPreviousForm() {
        currentFormIndex--;
        if (currentFormIndex >= 0) {
            showForm(currentFormIndex);
            submitButton.style.display = 'none'; // Hide submit button when going back
        }
    }

    // Event listeners for next and back buttons
    nextButton.forEach(button => {
        button.addEventListener('click', function () {
            goToNextForm();
        });
    });

    backButton.forEach(button => {
        button.addEventListener('click', function () {
            goToPreviousForm();
        });
    });

    // Event listener for form submission
    submitButton.addEventListener('click', function () {
        // Add form submission logic here
        // Example: document.querySelector('form').submit();
        alert('Form submitted!');
    });

    // Show the first form initially
    showForm(0);
});
