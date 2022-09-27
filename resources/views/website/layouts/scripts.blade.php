<!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script> --}}
    {{-- <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script> --}}
    <!--<script type="text/javascript" src="{!! asset('letsgamenow/js/jquery-3.3.1.min.js')!!}?<?=time()?>"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js?<?=time()?>"></script>
    <script type="text/javascript" src="{!! asset('letsgamenow/js/bootstrap.min.js')!!}?<?=time()?>"></script>    
    <script type="text/javascript" src="{!! asset('letsgamenow/js/slick.min.js')!!}?<?=time()?>"></script>
    <script type="text/javascript" src="{!! asset('letsgamenow/js/jquery.carouselTicker.min.js')!!}?<?=time()?>"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    {{-- <script type="text/javascript" src="{!! asset('letsgamenow/js/main.js')!!}?"></script> --}}
    {{-- <script src="{{ asset('new-theme/ckeditor/ckeditor.js') }}"></script> --}}
    <script src="{{ asset('js/typehead.js') }}"></script>
    <script src="{{ asset('new-theme/js/fSelect.js') }}"></script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5cd27e682846b90c57ad6ff5/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->

    <!-- Zoho code -->
    <script>var w=window;var p = w.location.protocol;if(p.indexOf("http") < 0){p = "http"+":";}var d = document;var f = d.getElementsByTagName('script')[0],s = d.createElement('script');s.type = 'text/javascript'; s.async = false; if (s.readyState){s.onreadystatechange = function(){if (s.readyState=="loaded"||s.readyState == "complete"){s.onreadystatechange = null;try{loadwaprops("2573bc7da3e92eab5d0752b8163cb190e","2194019f0bfc62c50b96dc536cc209968","2ca7f5b54d201de5f4be6db29bc9d60fcd71b62c3142be692","2689a548d8bf8d3375ed79a326801f59f","0.0");}catch(e){}}};}else {s.onload = function(){try{loadwaprops("2573bc7da3e92eab5d0752b8163cb190e","2194019f0bfc62c50b96dc536cc209968","2ca7f5b54d201de5f4be6db29bc9d60fcd71b62c3142be692","2689a548d8bf8d3375ed79a326801f59f","0.0");}catch(e){}};};s.src =p+"//marketinghub.zoho.in/hub/js/WebsiteAutomation.js";f.parentNode.insertBefore(s, f);</script>
<!--End of Zoho code Script-->

    <script type="text/javascript">
      $(window).on("load", function() {
        $("#carouselTicker").carouselTicker();
      });
      $(window).on("scroll", function () {
        if ($(window).scrollTop() > 104) {
          $("header").addClass("top");
        } else {
          $("header").removeClass("top");
        }
      });
    </script>

    <script>

     $(window).on('load', function () {
       AOS.refresh();
     });

     $(function () {
       AOS.init();
     });

   </script>

    <script type="text/javascript">

      $.fn.extend({
          equalizer: function() {
              var minHeight = 0;
              $(this).each(function() {
                  if($(this).outerHeight() > minHeight) {
                      minHeight = $(this).outerHeight();
                  }
              });
              $(this).css('min-height', minHeight + 'px');
          }
      });
      $('.upcoming_tournament .news__blocks__body').equalizer();
      $(document).ready(function(){
        $('.banner').slick({
          dots: true,
          infinite: false,
          speed: 300,
          autoplay: true,
          autoplaySpeed: 2000,
          slidesToShow: 1,
          slidesToScroll: 1
        });

        $('.slide__wrapper').slick({
          dots: false,
          infinite: false,
          speed: 300,
          autoplay: true,
          autoplaySpeed: 2000,
          slidesToShow: 5,
          slidesToScroll: 1,
          infinite: true,
          cssEase: 'ease-in-out',
          touchThreshold: 100,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 636,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                dots: false
              }
            }
            // {
            //   breakpoint: 480,
            //   settings: {
            //     slidesToShow: 1,
            //     slidesToScroll: 1
            //   }
            // }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ]
        });
        $('.testimonial_slider').slick({
          dots: false,
          infinite: false,
          speed: 300,
          autoplay: true,
          autoplaySpeed: 2000,
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
          cssEase: 'ease-in-out',
          touchThreshold: 100,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ]
        });
        $('.provider_logo').slick({
          dots: false,
          infinite: false,
          speed: 300,
          autoplay: true,
          autoplaySpeed: 1000,
          slidesToShow: 6,
          slidesToScroll: 1,
          infinite: true,
          cssEase: 'ease-in-out',
          touchThreshold: 100,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 6,
                slidesToScroll: 1,
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1
              }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ]
        });
         $(document).on('click', '.filter-option a', function(){
          $('.filter-option a').removeClass('active');
            $(this).addClass('active');
            var cat = $(this).attr('data-category');
            if(cat !== 'all'){
              $('.slide__wrapper').slick('slickUnfilter');
              $('.slide__wrapper li').each(function(){
                $(this).removeClass('slide-shown');
              });
              $('.slide__wrapper li[data-match='+ cat +']').addClass('slide-shown');
              $('.slide__wrapper').slick('slickFilter', '.slide-shown');
            }
            else{
              $('.slide__wrapper li').each(function(){
                $(this).removeClass('slide-shown');
              });
              $('.slide__wrapper').slick('slickUnfilter');
            }
            $('.turnament_alert_box_btn').on('click', function(){
                $.confirm({
                    icon: 'fa fa-question',
                    theme: 'white',
                    closeIcon: true,
                    animation: 'scale',
                    type: 'orange',
                });
            });
          });

          $('.upadate_field.custom_layout input').focus(function () {
              $(this).parent().addClass('focused');
          }).blur(function () {
              $(this).parent().removeClass('focused');
          });

          $('.upadate_field.custom_layout textarea').focus(function () {
              $(this).parent().addClass('focused');
          }).blur(function () {
              $(this).parent().removeClass('focused');
          });

          $('.accordian_content').hide();
          $('.accordian_content:first').show();
          $('.accordian_heading:first').addClass('active');
          $('.accordian_heading').click(function(){
              if(!$(this).hasClass('active')) {
                  $('.accordian_heading.active').removeClass('active');
                  $(this).addClass('active');
              } else {
                  $(this).removeClass('active');
              }
              $(this).next().slideToggle();
              $('.accordian_content').not($(this).next()).slideUp();
          });

          // $('.news__list__horizon').slick({
          //   dots: false,
          //   infinite: false,
          //   speed: 300,
          //   autoplay: true,
          //   autoplaySpeed: 5000,
          //   slidesToShow: 1,
          //   slidesToScroll: 1,
          //   arrows: false,
          //   asNavFor: '.news__list'
          // });

          // $('.news__list').slick({
          //   vertical: true,
          //   infinite: true,
          //   verticalSwiping: true,
          //   slidesToShow: 4,
          //   slidesToScroll: 1,
          //   arrows: false,
          //   focusOnSelect: true,
          //   asNavFor: '.news__list__horizon'
          // });

          // $('.news__list').slick({
          //   dots: false,
          //   infinite: false,
          //   speed: 300,
          //   autoplay: true,
          //   autoplaySpeed: 5000,
          //   slidesToShow: 2,
          //   slidesToScroll: 1,
          //   arrows: false,
          // });

          $('.upcoming_tournament').slick({
            dots: false,
            infinite: false,
            speed: 300,
            autoplay: true,
            autoplaySpeed: 5000,
            slidesToShow: 3,
            slidesToScroll: 1,
            arrows: false,
            responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
          });

          $('.video__list').slick({
            dots: false,
            infinite: false,
            speed: 300,
            autoplay: true,
            autoplaySpeed: 2000,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
              {
                breakpoint: 1024,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 3,
                  infinite: true,
                  dots: true
                }
              },
              {
                breakpoint: 600,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2
                }
              },
              {
                breakpoint: 480,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1
                }
              }
              // You can unslick at a given breakpoint now by adding:
              // settings: "unslick"
              // instead of a settings object
            ]
          });

          $('.testimonials').slick({
            dots: false,
            infinite: true,
            speed: 300,
            centerMode: true,
            arrows: false,
            centerPadding: '60px',
            autoplay: true,
            autoplaySpeed: 5000,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
              {
                breakpoint: 1024,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 3,
                  infinite: true,
                  dots: true
                }
              },
              {
                breakpoint: 600,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2
                }
              },
              {
                breakpoint: 480,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  centerPadding: '0px',
                }
              }
              // You can unslick at a given breakpoint now by adding:
              // settings: "unslick"
              // instead of a settings object
            ]
          });
      });

    </script>
    {{-- <script type="text/javascript">
      CKEDITOR.replace('description');
      CKEDITOR.replace('rulesdescription');
      CKEDITOR.replace('metadescription');
    </script> --}}
    <script type="text/javascript">

$(document).ready(function(){

  $('.zone_type').change(function(){

    if( $(this).is(":checked") ){ // check if the radio is checked

          var zone = $(this).val(); // retrieve the value

          if(zone == '1')

          {

            $('#regn').show();

            $('#con').hide();

          }

          else if(zone == '2')

          {

            $('#con').show();

            $('#regn').hide();

          }

      }

  });

});

</script>



<script type="text/javascript">

$(document).ready(function(){

  $('.tournament_type').change(function(){

    if( $(this).is(":checked") ){ // check if the radio is checked

          var tourtype = $(this).val(); // retrieve the value

          if(tourtype == '1')

          {

            $('#roomk').show();

            $('#kout').hide();

          }

          else if(tourtype == '2')

          {

            $('#kout').show();

            $('#roomk').hide();

          }

      }

  });

});

</script>



<script type="text/javascript">

// $( function() {

//       $("#start_date").datepicker();

//       $("#end_date").datepicker();

//       $("#reg_start_date").datepicker();

//       $("#reg_end_date").datepicker(); 

// });

</script>

<script type="text/javascript">

$(document).ready(function(){

  $('.prize_type').change(function(){

    if( $(this).is(":checked") ){ // check if the radio is checked

          var ptype = $(this).val(); // retrieve the value

          if(ptype == '1')

          {

            $('#money').show();

            $('#reward').hide();

          }

          else if(ptype == '2')

          {

            $('#reward').show();

            $('#money').hide();

          }

      }

  });

});

</script>

<script type="text/javascript">

function TournamentDateCheck()

{

  var StartDate= $('#start_date').val();

  var EndDate= $('#end_date').val();

  var eDate = new Date(EndDate);

  var sDate = new Date(StartDate);

  if(StartDate!= '' && StartDate!= '' && sDate > eDate)

    {

    alert("Please ensure that the End Date is greater than or equal to the Start Date.");

    $('#end_date').val('');

    return false;

    }

}

</script>

<script type="text/javascript">

$( function() {

$('#setPercentage').on('click', function() {

  var _prCurrency = $.trim($('#prize_currency').val());

  var _prMoney = parseInt( $.trim($('#prize_money').val()) );

  var _getNOU = parseInt( $.trim($('#noufpmd').val()) );

  //alert(_getNOU);

  if( _prMoney != '' && _prMoney != 'undefined' && _prCurrency != '' && _prCurrency != 'undefined' && _getNOU !='' && !isNaN(_getNOU)) {

    

    var _html = '';

        _html += '<table class="table table-bordered table-sm table_custom_layout">';

        _html += '<thead>';

          _html += '<tr>';

            _html += '<th>Rank</th>';

            _html += '<th>Amount</th>';

          _html += '</tr>';

        _html += '</thead>';

        _html += '<tbody>';

        for( var i = 1; i <= _getNOU; i++ ) {

          _html += '<tr>';

            _html += '<td>Prize Amount Percentage For <strong>Rank-'+ i +'</strong></td>';

            // _html += '<td><input type="text" name="percVal[]" class="percVal artxtb onlyNumber"> %</td>';

            _html += '<td><input type="text" name="percAmt[]" class="percAmt artxtb"></td>';

          _html += '</tr>';

        }

        _html += '</tbody>';

        _html += '</table>';



        $('#AridynaBox').html( _html );

      } else {

        alert('Please enter prize money, currency, No of distribution');

      }

} ); 



$('body').on('blur', '.percVal', function() { 

  var totPerc = 0;

  $('.percVal').each( function() { 

    if( !isNaN(parseInt($.trim($(this).val()))) ) {

      totPerc = totPerc + parseInt($.trim($(this).val()));

    }

  } );

  if(totPerc <= 100) {

    var _getPrMoney = parseInt( $.trim($('#prize_money').val()) );

    var _getPrcVal = parseInt($.trim($(this).val()));

    var _getAmt = ( _getPrMoney * _getPrcVal ) / 100 ;

    $(this).closest('tr').find('td:eq(2)').find('.percAmt').val( _getAmt );

  } else {

    alert('Total Percentage Should Not Grater Than 100%');

    $(this).val('');

    $(this).closest('tr').find('td:eq(2)').find('.percAmt').val('');

  }

} ); 



$('body').on('blur', '.percAmt', function() { 

  var totAmt = 0;

  $('.percAmt').each( function() { 

    if( !isNaN(parseInt($.trim($(this).val()))) ) {

      totAmt = totAmt + parseInt($.trim($(this).val()));

    }

  } );

  var price = $('#prize_money').val()
  price ++
 if(totAmt >= price) {
   price --
  
    alert(`Total distribution price Should Not Grater Than ${price}`);

    $(this).val('');

    $(this).closest('tr').find('td:eq(2)').find('.percAmt').val('');

  }

} );

} );

</script>

<script type="text/javascript">

$(document).ready(function(){

  $('.is_free').change(function(){

    if( $(this).is(":checked") ){ // check if the radio is checked

          var free = $(this).val(); // retrieve the value

          if(free == '0')

          {

            $('#part_amount').show();

          }

          else

          {

            $('#part_amount').hide();

          }

      }

  });

});

</script> 

<script type="text/javascript">
// $('#frmx').validate({
//   errorElement: 'span',
//   errorClass : 'roy-vali-error',
//   rules: {
//     tournament_name: {

//       required: true

//     },

//     slug: {

//       required: true,

//       nowhitespace: true,

//       pattern: /^[A-Za-z\d-.]+$/,

//       remote:{

//         url: "{{ route('checkSlugUrl') }}",

//         type: "post",

//         data: {

//           "slug_url": function() {

//             return $( "#pgSlug" ).val();

//           },

//           "_token": function() {

//             return "{{ csrf_token() }}";

//           },

//           "id": function() {

//             return $( "#table_id" ).val();

//           },

//           "row_id": function() {

//             return $( "#row_id" ).val();

//           }

//         }

//       } 

//     },

//     game_id: {

//       required: true

//     },

//     user_type: {

//       required: true

//     },

//     start_date: {

//       required: true

//     },

//     end_date: {

//       required: true

//     },

//     start_time: {

//       required: true

//     },

//     end_time: {

//       required: true

//     },

//    reg_start_date: {

//       required: true

//     },

//     reg_end_date: {

//       required: true

//     },

//     reg_start_time: {

//       required: true

//     },

//     reg_end_time: {

//       required: true

//     },

//     prize_type : {

//       required: true

//     },

//     zone_type: {

//       required :true

//     },

//     max_players: {

//       required: true,

//       number: true

//     },

//     room_size: {

//       required: true,

//       number: true

//     },

//     is_free: {

//       required :true

//     }

//   },



//   messages: {



//       tournament_name: {

//           required: 'Please Enter a name.'

//       },

//       slug: {

//         required: 'Please Enter Page URL or Link.',

//         nowhitespace: 'White Space or Blank Space Not Allowed, Use Hyphen.',

//         pattern: 'Any Special Character Not Allowed, Except Hyphen.',

//         remote: 'This URL Already Exist, Try Another.'

//       },

//       game_id: {

//           required: 'Please Select a game.'

//       },

//       user_type: {

//         required: 'Please Select a user type.'

//       },

//       start_date: {

//           required: 'Please Select a Start Date.'

//       },

//       end_date: {

//           required: 'Please Select a End Date.'

//       },

//       start_time: {

//           required: 'Please Enter a Start Time.'

//       },

//       end_time: {

//           required: 'Please Enter a End Time.'

//       },

//       reg_start_date: {

//           required: 'Please Enter Registration Start Date.'

//       },

//       reg_end_date: {

//           required: 'Please Enter Registration End Date.'

//       },

//       reg_start_time: {

//           required: 'Please Enter Registration Start Time.'

//       },

//       reg_end_time: {

//           required: 'Please Enter Registration End Time.'

//       },

//       prize_type:{

//         required: 'Please Enter Prize Type.'

//       },

//       zone_type: {

//         required : 'Please select zone type.'

//       },

//       max_players: {

//         required: 'Please enter maximum number of players.',

//         number: 'Please enter numeric value'

//       },

//       room_size: {

//         required: 'Please enter room size.',

//         number: 'Please enter numeric value'

//       },

//       is_free:{

//         required: 'Please Enter Participation Amount.'

//       }

//   }

// });






function string_to_slug(str) {

str = str.replace(/^\s+|\s+$/g, "");

str = str.toLowerCase();

var from = "åàáãäâèéëêìíïîòóöôùúüûñç·/_,:;";

var to = "aaaaaaeeeeiiiioooouuuunc------";

for (var i = 0, l = from.length; i < l; i++) {

  str = str.replace(new RegExp(from.charAt(i), "g"), to.charAt(i));

}

str = str

  .replace(/[^a-z0-9 -]/g, "") // remove invalid chars

  .replace(/\s+/g, "-") // collapse whitespace and replace by -

  .replace(/-+/g, "-") // collapse dashes

  .replace(/^-+/, "") // trim - from start of text

  .replace(/-+$/, ""); // trim - from end of text

return str;

}

</script>

<script type="text/javascript">

  var path = "{{ route('autocomplete') }}";

  $('input.typeahead').typeahead({

      source:  function (query, process) {

      return $.get(path, { query: query }, function (data) {

              return process(data);

          });

      }

  });

</script>


<script>
(function($) {
  $(function() {
      window.fs_test = $('.multiselect').fSelect();
  });
})(jQuery);
</script>

<script>
  $(document).ready(function(){ 
    var userId = $("#userid").val(); 
    $('.counter').click(function(){ 
      var recievedData = $(this).attr('data-value'); 
      $.ajax({
        url : '{{ route("flipkart.click-count") }}',
        method : 'POST',
        data : {
          '_token' : '{{csrf_token()}}',
          'userid' : userId,
          'recievedData' : recievedData,
          // 'whatsapp' : whatsapp,
          // 'email' : email,
          // 'linkedin' : linkedin
        },
        // success : function(response) {
        //   // console.log(response);
        //   /* if (response.status == 200) {
        //     alert('ok');
        //   } else {
        //     alert('wrong');
        //   } */

        //   window.location.href = "{{URL::to('/')}}"+"/flipkart/images/banners/join-flipkart-gaming-conclave-lgn-banner.jpg";
        // }
      });
    });
  });
</script>


{{-- <script type="text/javascript">
  CKEDITOR.replace('message');
  CKEDITOR.replace('message1');
</script> --}}

<script type="text/javascript">
  jQuery(window).ready(function($, window){
     var emailArr = [];
  var allEmails = '';
  $("#checkAll").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
  });

  $('#sendEmail').click(function () {
     emailArr = [];
     allEmails = '';
     total = 0;
     var $boxes = $('input[type="checkbox"]:checked');

     $boxes.each(function () {
        // Do stuff here with this
        emailArr.push({
           "email": $(this).val()
        });
        if (allEmails == '') {
           if ($(this).val() != 'on' && $(this).val() != '') {
              allEmails += $(this).val();
           }
        } else {
           if ($(this).val() != 'on' && $(this).val() != '') {
              allEmails += ',' + $(this).val();
           }
        }
     });

     $('#to').val(allEmails);
     console.log("arr>" + JSON.stringify(emailArr));
     $('#myModals2').modal('show');
  })
  }(jQuery, window))
</script>
