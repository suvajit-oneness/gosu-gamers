<!doctype html>
<html lang="en">
    {{--include styles--}}
   @include("website.layouts.flipkart.flipkart-header")

  <body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NLTDLR9"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
   {{--include sub-header--}}
   @include("website.layouts.flipkart.flipkart-sub-header")

  @section("content")
  @show

      {{--include footer--}}
   @include("website.layouts.flipkart.flipkart-footer")

      {{--include scripts--}}
   @include("website.layouts.scripts")
    
   @include('sweetalert::alert')
  </body>
</html>