<!doctype html>
<html lang="en">
    {{--include styles--}}
   @include("website.layouts.header")

  <body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NLTDLR9"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
   {{--include sub-header--}}
   @include("website.layouts.sub-header")

  @section("content")
  @show

      {{--include footer--}}
   @include("website.layouts.footer")

      {{--include scripts--}}
   @include("website.layouts.scripts")
    
   @include('sweetalert::alert')
  </body>
</html>