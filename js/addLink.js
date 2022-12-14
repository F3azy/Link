const originalLinkInput = document.getElementById("originalLink");
const customLinkInput = document.getElementById("customLink");
const cutButton = document.getElementById("shortenLinkButton");
const passwordCheck = document.getElementById("passwordCheck");
const password = document.getElementById("password");

cutButton.disabled = true;

if(password && passwordCheck) {
    password.disabled = true;

    password.addEventListener("input", function() {
        if(this.value.length >= 8) {
            cutButton.disabled = false;
        } else {
            cutButton.disabled = true;
        }
    });

    passwordCheck.addEventListener("click", function() {
        if(this.checked) {
            password.disabled = false;
            if(password.value.length < 8) {
                cutButton.disabled = true;
            }
        }
        else {
            password.disabled = true;
            cutButton.disabled = false;
        }
    });
}

originalLinkInput.addEventListener("input", function() {
    this.value = this.value.trim();
    this.value = this.value.split(" ").join("");
    if(this.value.length == 0) {
        cutButton.disabled = true;
    } else {
        cutButton.disabled = false;
    }
});

customLinkInput.addEventListener("input", function() {
    this.value = this.value.trim();
    this.value = this.value.split(" ").join("");
    if((this.value.length == 0 || this.value.length >= 4) && originalLinkInput.value.length != 0) {
        cutButton.disabled = false;
    } else {
        cutButton.disabled = true;
    }
});