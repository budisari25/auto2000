$(document).ready(function(){
    $(".alert").fadeTo(3000, 500).slideUp(500, function(){
        $(".alert").alert('close');
    });

    // Jam Footer
    function updateTime() {
      $('#oclock').html(moment().format("dddd, MMM Do YYYY, HH:mm:ss a"));
    }
    updateTime();
    setInterval(updateTime, 1000);
      
    $('#pagination .pagination_link:first').addClass('active');
    
    var page;
    var slides  = $('#pagination').find(".pagination_link");
    var current = 1;

    // update pagination
    function update() {    
      if(current >= slides.length) {
        current = 1;
        load_data(current);
      } else {
        ++current;
        load_data(current);
      }

      var slider  = $("#pagination");
      var active  = slider.find(".active");
      var index   = active.index();
      
      active.removeClass("active");
      if (index < slides.length - 1){
        active.next().addClass("active")
      } else {
        slider.find(".pagination_link:first").addClass("active")
      }
    };   

    var slideInterval = setInterval(() => {
      update(),
      footer()
    }, 20000);

    // Button Pause
    var playing = true;
    var pauseButton = $('#pause');

    function pauseSlideshow(){
      pauseButton.text('Play');
      playing = false;
      clearInterval(slideInterval);
    }

    function playSlideshow(){
      pauseButton.text('Pause');
      playing = true;
      update();
      slideInterval = setInterval(() => {
        update(),
        footer()
      }, 20000);
    }

    // Event If button pause di klik
    $('#pause').on('click', function(){
      if(playing){ pauseSlideshow() }
      else{ playSlideshow(); }
    });

    // Event Click pagination
    $('.pagination_link').on('click', function(){  
      page = $(this).attr("id");  
      load_data(page);   
      current = page;
      
      if($('.pagination_link').hasClass('active')){
        $('.pagination_link').removeClass('active');
      }
      
      $('#'+current).addClass('active');

      pauseSlideshow();
    });  
});  