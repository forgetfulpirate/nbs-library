const form = document.querySelector("form");
const nextBtn = form.querySelectorAll(".nextBtn");
const backBtn = form.querySelectorAll(".backBtn");

nextBtn.forEach(btn => {
    btn.addEventListener("click", () => {
        const currentForm = btn.closest('.form');
        const nextForm = currentForm.nextElementSibling;
        currentForm.style.opacity = 0;
        currentForm.style.pointerEvents = 'none';
        nextForm.style.opacity = 1;
        nextForm.style.pointerEvents = 'auto';
    });
});

backBtn.forEach(btn => {
    btn.addEventListener("click", () => {
        const currentForm = btn.closest('.form');
        const prevForm = currentForm.previousElementSibling;
        currentForm.style.opacity = 0;
        currentForm.style.pointerEvents = 'none';
        prevForm.style.opacity = 1;
        prevForm.style.pointerEvents = 'auto';
    });
});