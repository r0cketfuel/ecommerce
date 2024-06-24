@extends("shop.layout.master")

@php
    $title = "Pagina de pruebas";
@endphp

@section("title", $title)

@section("css")
@endsection

@section("js")
@endsection

@section("inlineCSS")
    <style>
		.carousel-container {
			overflow: 				hidden;
            position:               relative;
            max-height:             400px;
		}

		.carousel-slider {
			display: 				flex;
			flex-flow: 				row nowrap;
			width: 					400%;
		}

		.carousel-slide {
			flex: 					1;
			transition: 			all 0.5s ease-in-out;
		}

        .carousel-slide img {
            width:                  100%;
        }

        .btn.btn-next,
        .btn.btn-prev
        {
            position: 				absolute;
            width: 					40px;
            height: 				40px;
            padding: 				10px;
            border: 				none;
            border-radius: 			50%;
            z-index: 				5;
            cursor: 				pointer;
            background-color: 		#fff;
            color:					black;
            border:                 1px solid rgb(230, 230, 230);
            font-size: 				18px;
        }

        .btn:active {
            transform: 				scale(1.1);
        }

        .btn-prev {
            top: 					45%;
            left: 					2%;
        }

        .btn-next {
            top: 					45%;
            right: 					2%;
        }
    </style>
@endsection

@section("body")

    <div class="carousel-container">
        <div class="carousel-slider">
            <div class="carousel-slide">
                <img src="/images/banners/1.png" alt="imagen1">
            </div>
            <div class="carousel-slide">
                <img src="/images/banners/2.png" alt="imagen2">
            </div>
            <div class="carousel-slide">
                <img src="/images/banners/3.png" alt="imagen3">
            </div>
            <div class="carousel-slide">
                <img src="/images/banners/4.png" alt="imagen4">
            </div>
        </div>
        <button class="btn btn-next"><i class="fa-solid fa-chevron-right"></i></button>
        <button class="btn btn-prev"><i class="fa-solid fa-chevron-left"></i></button>
    </div>

@endsection

@section("scripts")
    <script>
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
    </script>
@endsection