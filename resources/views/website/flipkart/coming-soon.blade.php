@if(Auth::guard('gamer')->check())
    @php $user =Auth::guard('gamer')->user(); @endphp
@endif

@extends("website.layouts.flipkart.flipkart-master")
@section("content")
    <style type="text/css">
        .videoWrapper {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 */
            height: 0;
        }

        .videoWrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>


    <section class="testimonial_bg pt-5 pb-5">

        <section class="bluedark_bg pt-5 pb-5">
            <div class="title__area text-center">
            </div>
        </section>


        <div class="container">

            <div class="title__area text-center">
                <div class="section__title">Coming soon...</div>
            </div>

            <div class="clearfix"></div>

            <div class="container-fluid mt-5">

                <div class="row">
                    <div class="col-sm-12">
                        <h4 style="color: white">Coming soon!</h4>
                    </div>
                </div>


            </div>
        </div>


    </section>





@endsection
