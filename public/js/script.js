const menuIcon = document.getElementById("menu-icon");
const nav = document.querySelector("#nav-right");

menuIcon.addEventListener("click", () => {
    console.log("clicked");
    nav.classList.toggle("open");
});


let btnOk = document.getElementById('#ok_btn');
let textarea = document.querySelectorAll('textarea');
let editbtn = document.querySelectorAll('#edit_btn');
// console.log(editbtn);
for (i of editbtn) {
    i.addEventListener('click', () => {
        console.log('clicker');
        for (i of textarea) {
            i.removeAttribute('readonly');
            i.style.backgroundColor = '#F28B50'
        }

    })
}

