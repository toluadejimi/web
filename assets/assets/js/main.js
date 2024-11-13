/*=== Javascript function indexing hear===========

01. swiperActivation()
02. wowActive()
03. videoActivation()
05. counterUp()
06. backToTopInit()
07. stickyHeader()
08. stickySidebar()
09. sideMenu()
10. metismenu()
11. preloader()
12. tabActive()

==================================================*/

(function ($) {
    'use strict';
   
    var rtsJs = {
      m: function (e) {
        rtsJs.d();
        rtsJs.methods();
      },
      d: function (e) {
        this._window = $(window),
          this._document = $(document),
          this._body = $('body'),
          this._html = $('html')
      },
      methods: function (e) {
        rtsJs.swiperActivation();
        rtsJs.wowActive();
        rtsJs.videoActivation();
        rtsJs.counterUp();
        rtsJs.backToTopInit();
        rtsJs.stickyHeader();
        rtsJs.stickySidebar();      
        rtsJs.sideMenu();
        rtsJs.metismenu();
        rtsJs.preloader();
        rtsJs.tabActive();
        rtsJs.countDown();
      },
  
      swiperActivation: function(){
        $(document).ready(function(){

          // BRAND SLIDER
            var swiper = new Swiper(".rts-brand__slider", {
                slidesPerView: 7,
                spaceBetween: 40,
                pagination: {
                  el: ".swiper-pagination",
                  clickable: true,
                },
                loop:true,
                breakpoints: {
                  1200: {
                    slidesPerView: 7,
                  },
                  900: {
                    slidesPerView:6,
                  },
                  768: {
                    slidesPerView: 5,
                  },
                  580: {
                    slidesPerView: 4,
                  },
                  450: {
                    slidesPerView: 3,
                  },
                  0: {
                    slidesPerView: 3,
                  }
                },
            });
  
        });
        $(document).ready(function(){
          var swiper = new Swiper(".banner-slider-active", {
            slidesPerView: 1,
            speed: 1800,
            loop:true,
            navigation: {
              nextEl: ".swiper-btn-next",
              prevEl: ".swiper-btn-prev",
            },
            pagination:{
              el: ".slider-dots",
              clickable: true,
            }
          });
        });
        //Testimonial Slider
        $(document).ready(function(){
          var swiper_1 = new Swiper(".testimonial__slider--first", {
            slidesPerView: 1,
            spaceBetween: 0,
            speed: 1800,
            loop: true,
            navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
            },
            pagination: {
              el: '.swiper-pagination',
              type: 'progressbar',
              clickable: 'true',
            }
          });
         });
         $(document).ready(function(){
          var swiper = new Swiper(".testimonial__slider--second", {
            slidesPerView: 3,
            spaceBetween: 30,
            speed: 1800,
            loop:true,
            navigation: {
              nextEl: ".swiper-btn-next",
              prevEl: ".swiper-btn-prev",
            },
            breakpoints: {
              1200: {
                slidesPerView: 3,
              },
              900: {
                slidesPerView:2,
              },
              768: {
                slidesPerView: 2,
              },
              580: {
                slidesPerView: 1,
              },
              450: {
                slidesPerView: 1,
              },
              0: {
                slidesPerView: 1,
              }
            },
            pagination:{
              el: ".rts-dot__button",
              clickable: true,
            }
          });
        });

        /*============ accordion style ======== */
        document.addEventListener("DOMContentLoaded", function () {
          var accordionHeaders = document.querySelectorAll(".accordion-header");
          accordionHeaders.forEach(function (header, index) {
            header.addEventListener("click", function () {
              var accordionItems = document.querySelectorAll(".accordion-item");
              accordionItems.forEach(function (item) {
                item.classList.remove("active");
              });
              var clickedItem = document.querySelectorAll(".accordion-item")[index];
              clickedItem.classList.add("active");
            });
          });
        });

      },  
      wowActive: function () {
        new WOW().init();
      },
      videoActivation: function (e) {
        $(document).ready(function(){
          $('.popup-youtube, .popup-video').magnificPopup({
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
          });
        });
      },
      preloader:function(){
        window.addEventListener('load',function(){
          document.querySelector('body').classList.add("loaded")  
        });          
      },
      stickySidebar: function (e) {
        // stickySidebar
        if (typeof $.fn.theiaStickySidebar !== "undefined") {
          $(".sticky-coloum-wrap .sticky-coloum-item").theiaStickySidebar({
            additionalMarginTop: 130,
          });
        }
      },

      counterUp: function (e) {
        $('.counter').counterUp({
          delay: 10,
          time: 1000
        });
      },
      countDown: function(){
        $(function() {
          countDown.init();
          updateCountdowns();
          setInterval(updateCountdowns, 1000);
        
          function updateCountdowns() {
            countDown.validElements.forEach((element, i) => {
              countDown.changeTime(element, countDown.endDate[i], i);
            });
          }
        });
        
        const countDown = {
          endDate: [],
          validElements: [],
          display: [],
          initialHeight: undefined,
          initialInnerDivMarginTop: undefined,
          originalBorderTopStyle: undefined,
        
          init: function() {
            $('.countDown').each(function() {
              const regex_match = $(this).text().match(/([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4}) ([0-9]{2}):([0-9]{2}):([0-9]{2})/);
              if (!regex_match) return;
        
              const end = new Date(regex_match[3], regex_match[2] - 1, regex_match[1], regex_match[4], regex_match[5], regex_match[6]);
        
              if (end > new Date()) {
                countDown.validElements.push($(this));
                countDown.endDate.push(end);
                countDown.changeTime($(this), end, countDown.validElements.length - 1);
                $(this).html(countDown.display.next.map(item => `<div class='container'><div class='a'><div>${item}</div></div></div>`).join(''));
              } else {
                // Display your message when the countdown expires
                $(this).html("<p class='end'>Sorry, your session has expired.</p>");
              }
            });
          },
        
          reset: function(element) {
            // This function appears to be incomplete, as it currently doesn't do anything.
          },
        
          changeTime: function(element, endTime) {
            if (!endTime) return;
        
            const today = new Date();
            if (today.getTime() <= endTime.getTime()) {
              countDown.display = {
                'last': this.calcTime(endTime.getTime() - today.getTime() + 1000),
                'next': this.calcTime(endTime.getTime() - today.getTime())
              };
              countDown.display.next = countDown.display.next.map(item => item.toString().padStart(2, '0'));
              countDown.display.last = countDown.display.last.map(item => item.toString().padStart(2, '0'));
        
              element.find('div.container div.a div').each((index, div) => {
                $(div).text(countDown.display.last[index]);
              });
        
              this.reset(element.find('div.container'));
            } else {
              element.html("<p class='end'>Sorry, your session has expired.</p>");
            }
          },
        
          calcTime: function(milliseconds) {
            const secondsTotal = Math.floor(milliseconds / 1000);
            const days = Math.floor(secondsTotal / 86400);
            const hours = Math.floor((secondsTotal % 86400) / 3600);
            const minutes = Math.floor((secondsTotal % 3600) / 60);
            const seconds = secondsTotal % 60;
            return [days, hours, minutes, seconds];
          }
        };
        
      },

    
    // BACK TO TOP BUTTON JS
      backToTopInit: function () {
        $(document).ready(function(){
        "use strict";
    
        var progressPath = document.querySelector('.progress-wrap path');
        var pathLength = progressPath.getTotalLength();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
        progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
        progressPath.style.strokeDashoffset = pathLength;
        progressPath.getBoundingClientRect();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';		
        var updateProgress = function () {
          var scroll = $(window).scrollTop();
          var height = $(document).height() - $(window).height();
          var progress = pathLength - (scroll * pathLength / height);
          progressPath.style.strokeDashoffset = progress;
        }
        updateProgress();
        $(window).scroll(updateProgress);	
        var offset = 50;
        var duration = 550;
        jQuery(window).on('scroll', function() {
          if (jQuery(this).scrollTop() > offset) {
            jQuery('.progress-wrap').addClass('active-progress');
            jQuery('.rts-switcher').addClass('btt__visible');
          } else {
            jQuery('.progress-wrap').removeClass('active-progress');
            jQuery('.rts-switcher').removeClass('btt__visible');
          }
        });				
        jQuery('.progress-wrap').on('click', function(event) {
          event.preventDefault();
          jQuery('html, body').animate({scrollTop: 0}, duration);
          return false;
        })
        
        
      }); 
  
      },
      // sticky header activation
      stickyHeader: function (e) {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 150) {
                $('.header--sticky').addClass('sticky')
            } else {
                $('.header--sticky').removeClass('sticky')
            }
        })
      },  
      
      // svg inject js
      tabActive: function(){
      },
  
  
      // side menu desktop
      sideMenu:function(){
        $(document).on('click', '#menu-btn', function () {
          $("#side-bar").addClass("show");
          $("#anywhere-home").addClass("bgshow");
        });
        $(document).on('click', '.close-icon-menu', function () {
          $("#side-bar").removeClass("show");
          $("#anywhere-home").removeClass("bgshow");
        });
        $(document).on('click', '#anywhere-home', function () {
          $("#side-bar").removeClass("show");
          $("#anywhere-home").removeClass("bgshow");
        });
        $(document).on('click', '.onepage .mainmenu li a', function () {
          $("#side-bar").removeClass("show");
          $("#anywhere-home").removeClass("bgshow");
        });
      },

      metismenu:function(){
        $('#mobile-menu-active').metisMenu();
      },
      // THEME MODE SWITCHER JS
    }
    rtsJs.m(); 

    $(document).ready(function() {
      $('select').niceSelect();
    });

    $(window).on("scroll", function() {
      var ScrollBarPostion = $(window).scrollTop();
      if (ScrollBarPostion > 100) {
        $(".rts-header").addClass("header-sticky");      
      } else {
        $(".rts-header").removeClass("header-sticky");
        $(".rts-header .rts-ht").removeClass("remove-content");     
      }
    });

    $(document).ready(function() {
      // Listen for the collapse show event
      $('.working-process-accordion-one .accordion-collapse').on('show.bs.collapse', function () {
        // Find the parent .accordion-item and add the 'show' class
        $(this).closest('.accordion-item').addClass('show');
      });
    
      // Listen for the collapse hide event
      $('.working-process-accordion-one .accordion-collapse').on('hide.bs.collapse', function () {
        // Find the parent .accordion-item and remove the 'show' class
        $(this).closest('.accordion-item').removeClass('show');
      });
    });
    $(document).ready(function(){
        /*=========== Tab Js ===========*/
        try {
          $(".tab__btn").click(function () {
            const tabId = $(this).data("tab");
            $(".tab__btn").removeClass("active");
            $(this).addClass("active");
            $(".tab__content").removeClass("open").hide();
            $("#" + tabId)
              .addClass("open")
              .show();
          });
          $('.tab__btn[data-tab="tab1"]').click();
        } catch (error) {
          console.error("Tab Button not enable this page", error);
        }

        try {
          $(".tab__btn1").click(function () {
            const tabId = $(this).data("tab");
            $(".tab__btn1").removeClass("active");
            $(this).addClass("active");
            $(".tab__content1").removeClass("open").hide();
            $("#" + tabId)
              .addClass("open")
              .show();
          });
          $('.tab__btn1[data-tab="tab1"]').click();
        } catch (error) {
          console.error("Tab Button not enable this page", error);
        }

        try {
          $(".tab__btn2").click(function () {
            const tabId = $(this).data("tab");
            $(".tab__btn2").removeClass("active");
            $(this).addClass("active");
            $(".tab__content2").removeClass("open").hide();
            $("#" + tabId)
              .addClass("open")
              .show();
          });
          $('.tab__btn2[data-tab="tab1"]').click();
        } catch (error) {
          console.error("Tab Button not enable this page", error);
        }

        // PRICING-TABLE-TAB
        try {
          $(".tab__price").click(function () {
            const tabId = $(this).data("tab");
            $(".tab__price").removeClass("active");
            $(this).addClass("active");
            $(".price__content").removeClass("open").hide();
            $("#" + tabId)
              .addClass("open")
              .show();
          });
          $('.tab__price[data-tab="tab1"]').click();
        } catch (error) {
          console.error("Tab Button not enable this page", error);
        }       
        
        // PRICING-TABLE-TAB
        try {
          $(".tab__affiliate").click(function () {
            const tabId = $(this).data("tab");
            $(".tab__affiliate").removeClass("active");
            $(this).addClass("active");
            $(".affiliate__content").removeClass("open").hide();
            $("#" + tabId)
              .addClass("open")
              .show();
          });
          $('.tab__affiliate[data-tab="tab1"]').click();
        } catch (error) {
          console.error("Tab Button not enable this page", error);
        }
    })
    
    // BOOTSTRAP TOOLTIPS
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    // PRICING FEATURE SHOW HIDE
    try {
      $(document).ready(function () {
        $(".card-plan__feature--list-trigered").click(function () {
          $('.card-plan__feature--list-trigered').toggleClass('active').animate(100);
          $(".card-plan__feature--list.more__feature").slideToggle();
          $(".card-plan__feature--list.more__feature").css({
            display: "flex",
            marginTop: "25px"
          });
        });
      });
    } catch (error) {
      console.log('Feature show hide js code not working this page')
    }
   
  
  })(jQuery, window)  

