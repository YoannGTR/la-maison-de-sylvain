anciennePos = this.window.scrollY;
window.addEventListener("scroll", function(){
    console.log(this.window.scrollY);
    if(this.window.scrollY>anciennePos || this.window.scrollY==0)
    {
        console.log("bas");
        var i = this.document.getElementsByClassName("header");
        for (let index = 0; index < i.length; index++) {
            // i[index].style.transition = "0.5s";
            i[index].style.top = "0px";
            i[index].style.position = "absolute";
            i[index].style.backgroundColor = "rgba(0,0,0,0)";
            
        }
    }
    else if(this.window.scrollY<anciennePos)
    {
        console.log("haut");
        var i = this.document.getElementsByClassName("header");
        for (let index = 0; index < i.length; index++) {
            // i[index].style.transition = "0.5s";
            i[index].style.top = this.window.scrollY+"px";
            i[index].style.position = "fixed";
            i[index].style.top = "0px";

            i[index].style.backgroundColor = "rgba(0,0,0,0.5)";
            
        }
    }
    anciennePos = this.window.scrollY;
    
}, false);