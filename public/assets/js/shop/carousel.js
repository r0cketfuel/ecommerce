const slides    = document.querySelectorAll(".carousel-slide");
let maxSlide    = slides.length - 1;
let curSlide    = 0;

const nextSlide = document.querySelector(".btn-next");
const prevSlide = document.querySelector(".btn-prev");

//======================================//
// NEXT SLIDE BUTTON ADD EVENT LISTENER //
//======================================//
if(nextSlide)
{
    nextSlide.addEventListener("click", function ()
    {
        if(curSlide === maxSlide) curSlide = 0; else ++curSlide;

        // move slide by -100%
        slides.forEach((slide, indx) => {
            slide.style.transform = `translateX(${-100 * curSlide}%)`;
        });

        // switch interval to 6 seconds
        timer.reset(6000);

        // stop the timer
        timer.stop();

        // start the timer
        timer.start();
    });
}

//==========================================//
// PREVIOUS SLIDE BUTTON ADD EVENT LISTENER //
//==========================================//
if(prevSlide)
{
    prevSlide.addEventListener("click", function ()
    {
        if(curSlide === 0) curSlide = maxSlide; else --curSlide;

        // move slide by 100%
        slides.forEach((slide, indx) => {
            slide.style.transform = `translateX(${-100 * curSlide}%)`;
        });

        // switch interval to 6 seconds
        timer.reset(6000);

        // stop the timer
        timer.stop();

        // start the timer
        timer.start();
    });
}

//===========================//
// AUTOMATIC SLIDER FUNCTION //
//===========================//
class Timer {
    constructor(fn, t) {
        var timerObj = setInterval(fn, t);

        this.stop = function () {
            if (timerObj) {
                clearInterval(timerObj);
                timerObj = null;
            }
            return this;
        };

        // start timer using current settings (if it's not already running)
        this.start = function () {
            if (!timerObj) {
                this.stop();
                timerObj = setInterval(fn, t);
            }
            return this;
        };

        // start with new or original interval, stop current interval
        this.reset = function (newT = t) {
            t = newT;
            return this.stop().start();
        };
    }
}

var timer = new Timer(function()
{
    if(curSlide === maxSlide) curSlide = 0; else ++curSlide;

    // move slide by -100%
    slides.forEach((slide, indx) => {

        slide.style.transform = `translateX(${-100 * curSlide}%)`;
    });
}, 6000);