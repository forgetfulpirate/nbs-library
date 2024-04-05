const form = document.querySelector("form");
const nextBtn = form.querySelector(".nextBtn");
const backBtn = form.querySelector(".backBtn");
const allInput = form.querySelectorAll(".first input");

nextBtn.addEventListener("click", () => {
    let isFilled = true;
    allInput.forEach(input => {
        if (input.value === "") {
            isFilled = false;
        }
    });
    if (isFilled) {
        form.querySelector('.form.first').style.opacity = 0;
        form.querySelector('.form.first').style.pointerEvents = 'none';
        form.querySelector('.form.second').style.opacity = 1;
        form.querySelector('.form.second').style.pointerEvents = 'auto';
    } else {
      
    }
});

backBtn.addEventListener("click", () => {
    form.querySelector('.form.second').style.opacity = 0;
    form.querySelector('.form.second').style.pointerEvents = 'none';
    form.querySelector('.form.first').style.opacity = 1;
    form.querySelector('.form.first').style.pointerEvents = 'auto';
});
