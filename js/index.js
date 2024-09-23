var a = document.querySelector('ul');
var btn = document.querySelector('button');
btn.addEventListener('click',()=>{
    if(a.style.display == 'none'){
        a.style.display = 'block';
        // console.log('display');
    }else{
        a.style.display = 'none';
        // console.log('none');
        const unhide = setInterval(()=>{
            if(window.innerWidth > 680){
                a.style.display = 'block';
            }
        },0)
    }
});


