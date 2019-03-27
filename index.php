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
        $('#navbar').css("background","#222E4F" );
      }
      else{
        $('#navbar').css("background","transparent" );
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

