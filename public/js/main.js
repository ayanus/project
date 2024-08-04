// document.addEventListener('DOMContentLoaded', function () {
//     const links = document.querySelectorAll('.navigation ul li a');

//     links.forEach(link => {
//         link.addEventListener('click', function () {
//             // ลบคลาส active จากลิงค์ทั้งหมด
//             links.forEach(l => l.classList.remove('active'));

//             // เพิ่มคลาส active ให้กับลิงค์ที่ถูกคลิก
//             this.classList.add('active');
//         });

//         link.addEventListener('mouseenter', function () {
//             this.classList.add('hovered');
//         });

//         link.addEventListener('mouseleave', function () {
//             this.classList.remove('hovered');
//         });
//     });
// });

const activePage = wimdow.location.pathname;
const navlinks = document.querySelectorAll('.navigation ul li a');
ForEach(link => {
    if(link.href.includes(activePage)){
    console.log('$active');  
}
})