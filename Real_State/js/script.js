// mouseover in img
document.addEventListener('mousemove',move);
function move(e){
this.querySelectorAll('.move').forEach(layer=> {
    const speed =layer.getAttribute('data-speed')
    const x=(window.innerWidth - e.pageX*speed)/120
    const y=(window.innerWidth - e.pageY*speed)/120

    layer.style.transform =`translateX(${x}px) translateY(${y}px)`
});
}

// animation delay in second
gsap.from('.logo',{opacity:0,duration:1,delay:.9,y:10})
gsap.from('.navbar .nav-menu',{opacity:0,duration:1,delay:1.1,y:15,stagger:0.2})

gsap.from('.title',{opacity:0,duration:1,delay:1.6,y:30})
gsap.from('.description',{opacity:0,duration:1,delay:1.8,y:30})
gsap.from('.btn',{opacity:0,duration:1,delay:2.1,y:10})
gsap.from('.image',{opacity:0,duration:1,delay:2.6,y:10})





//scrolling animation 

const the_animation = document.querySelectorAll('.animation')

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add('scroll-animation')
        }
            else {
                entry.target.classList.remove('scroll-animation')
            }
        
    })
},
   { threshold: 0.5
   });
//
  for (let i = 0; i < the_animation.length; i++) {
   const elements = the_animation[i];

    observer.observe(elements);
  } 
