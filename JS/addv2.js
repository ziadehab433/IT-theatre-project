const imgx5 = document.querySelector(".imgx5")
const imgx10 = document.querySelector(".imgx10")
const file5 = document.querySelector(".file5")
const file10 = document.querySelector(".file10")


imgx5.addEventListener("click", () => {
    file5.click()
})

imgx10.addEventListener("click", () => {
    file10.click()
})

file5.addEventListener("change", (evt) => {
    let tgt = evt.target || window.event.srcElement,
        files = tgt.files;
    
    // FileReader support
    if (FileReader && files && files.length) {
        var fr = new FileReader();
        fr.onload = function () {
            imgx5.children[0].src = fr.result;
            imgx5.children[0].style.display = "block"
        }
        fr.readAsDataURL(files[0]);
    }
})

file10.addEventListener("change", (evt) => {
    let tgt = evt.target || window.event.srcElement,
        files = tgt.files;
    
    // FileReader support
    if (FileReader && files && files.length) {
        var fr = new FileReader();
        fr.onload = function () {
            imgx10.children[0].src = fr.result;
            imgx10.children[0].style.display = "block"
        }
        fr.readAsDataURL(files[0]);
    }
})
