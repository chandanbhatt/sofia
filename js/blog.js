var sofiaBlog = (function () {

    var isInViewport = function (el) {
        var top = el.offsetTop;
        var left = el.offsetLeft;
        var width = el.offsetWidth;
        var height = el.offsetHeight;

        while(el.offsetParent) {
            el = el.offsetParent;
            top += el.offsetTop;
            left += el.offsetLeft;
        }

        return (
            top < (window.pageYOffset + window.innerHeight) &&
            left < (window.pageXOffset + window.innerWidth) &&
            (top + height) > window.pageYOffset &&
            (left + width) > window.pageXOffset
        );
    };

    var slideInUpAnimation = function () {
       var el = document.getElementsByClassName('animate');
       Array.prototype.forEach.call(el,function (ele) {
           if(isInViewport(ele)){
               if(!ele.classList.contains('animated')) {
                   ele.classList.add('slideInUp');
                   ele.classList.add('animated');
               }
           } else{
               ele.classList.remove('slideInUp');
               ele.classList.remove('animated');
           }
       })
   }

   return {
       slideInUpAnimation: slideInUpAnimation
   }

})();

document.addEventListener('DOMContentLoaded', function(){
    sofiaBlog.slideInUpAnimation();
    document.addEventListener('scroll', function () {
        sofiaBlog.slideInUpAnimation();
    })
}, false);