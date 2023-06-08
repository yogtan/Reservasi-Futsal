const navlink = document.querySelectorAll(".nav-link");

navlink.forEach((e) => {
    console.log(e.target);
}) 

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        
        if(entry.isIntersecting){
            entry.target.classList.add('show');
        }else{
            entry.target.classList.remove('show');
        }
    });
});

const hiddenElements = document.querySelectorAll('.hidden');
hiddenElements.forEach((el) => observer.observe(el));

const nav =  document.querySelectorAll(".nav-link");

nav.addEventListener('click',(e) => {
    console.log(e.target)
})


