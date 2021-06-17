require("./bootstrap");

const Form = document.querySelectorAll(".deleted");
console.log(Form);

Form.forEach(form => {
    form.addEventListener("submit", function(element) {
        const resp = confirm("You sure you wish to delete this post?");

        if (!resp) {
            element.preventDefault();
        }
    });
});
