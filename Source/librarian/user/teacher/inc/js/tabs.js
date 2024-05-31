const buttons = document.querySelectorAll(".button");
const contents = document.querySelectorAll(".content");

buttons.forEach((button, index) => {
    button.addEventListener('click', () => {
        buttons.forEach((removebtn) => {
            removebtn.classList.remove("active");
        });
        button.classList.add("active");
        
        contents.forEach((content, contentIndex) => {
            if (contentIndex === index) {
                content.classList.add("active");
            } else {
                content.classList.remove("active");
            }
        });
    });
});

