<?php $link=1 ?>
<?php require_once("inc/header_links.php");
require_once('layout/nav.php');
require_once('layout/header.php');
require_once('layout/mainsection.php');
require_once('layout/footer.php');
require_once("inc/footer_links.php");
?>
<script>
  $(document).ready(function(){
    $('.menu-toggle').click(function () {

      $('.site-nav').toggleClass('site-nav--open', 500);
      $(this).toggleClass('open');

    });
    $(window).scroll(function(){
      let scroll= $(window).scrollTop();
      if (scroll>50) {
        $('#navbar').css({"background":"#222E4F", "opacity": ".85", "height":"70px", "font-size":"15px"} );
        $('.logo').css({"font-size":"20px"});
        $('.sign_up_btn').css({"font-size":"10px"});
      }
      else{
        $('#navbar').css({"background":"transparent", "font-size":"20px"} );
        $('.logo').css({"font-size":"30px"});
        $('.sign_up_btn').css({"font-size":"18px"});
      }
    });
  });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="./plugins/jquery.nice-number.min.js"></script>
<script>
  $(function () {

    $('input[type="number"]').niceNumber();

  });</script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
  <script>
    $(document).ready(function () {

      $("#testimonial-slider").owlCarousel({

        items: 2,
        itemsDesktop: [1000, 2],
        itemsDesktopSmall: [979, 2],
        itemsTablet: [768, 1],
        itemsMobile: [550, 1],
        pagination: true,
        autoPlay: true
      });

    });
  </script>

