const slider = document.querySelector(".premier")
const imgs = slider.querySelectorAll("img")
const left = document.querySelector(".slider-left")
const right = document.querySelector(".slider-right")
var img = 0;

function det() {
    if(img == 0) {
        imgs[0].style.opacity = 1
        imgs[1].style.opacity = 0
        imgs[2].style.opacity = 0
    } else if(img == 1) {
        imgs[0].style.opacity = 0
        imgs[1].style.opacity = 1
        imgs[2].style.opacity = 0
    } else {
        imgs[0].style.opacity = 0
        imgs[1].style.opacity = 0
        imgs[2].style.opacity = 1
    }
}

let inter = setInterval(() => {
    img++;
    if(img > 2) img = 0
    det()
    
}, 3000)

right.addEventListener("click", () => {
    clearInterval(inter)
    img += 1
    if(img > 2) img = 0
    det()
    inter = setInterval(() => {
        img++
        if(img > 2) img = 0
        det()
    }, 3000)
})

left.addEventListener("click", () => {
    clearInterval(inter)
    img -= 1
    if(img < 0) img = 2
    det()
    inter = setInterval(() => {
        img++
        if(img > 2) img = 0
        det()
    }, 3000)
})
