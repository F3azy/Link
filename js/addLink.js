const originalLinkInput = document.getElementById("originalLink");
const customLinkInput = document.getElementById("customLink");
const cutButton = document.getElementById("shortenLinkButton");
const passwordCheck = document.getElementById("passwordCheck");
const password = document.getElementById("password");

cutButton.disabled = true;

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
