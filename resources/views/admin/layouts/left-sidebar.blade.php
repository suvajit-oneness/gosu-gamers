
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

   <!-- Sidebar mobile toggler -->

   <div class="sidebar-mobile-toggler text-center">

      <a href="#" class="sidebar-mobile-main-toggle">

      <i class="icon-arrow-left8"></i>

      </a>

      Navigation

      <a href="#" class="sidebar-mobile-expand">

      <i class="icon-screen-full"></i>

      <i class="icon-screen-normal"></i>

      </a>

   </div>

   <!-- /sidebar mobile toggler -->

   <!-- Sidebar content -->

   <div class="sidebar-content">

      <!-- User menu -->

      <div class="sidebar-user">

         <div class="card-body">

            <div class="media">

               <div class="mr-3">

                  <a href="#"><img src="{{url('new-theme/images/white_logo.png')}}" width="38" height="38" class="rounded-circle" alt=""></a>

               </div>

               <div class="media-body">

                  <div class="media-title font-weight-semibold" style="font-size: 25px;">{{Auth::user()->name}}</div>

                  <div class="font-size-xs opacity-50">

                  </div>

               </div>

               <div class="ml-3 align-self-center">

                  <a href="#" class="text-white"><i class="icon-cog3"></i></a>

               </div>

            </div>

         </div>

      </div>

      <!-- /user menu -->

      <!-- Main navigation -->

      <div class="card card-sidebar-mobile">

         <ul class="nav nav-sidebar" data-nav-type="accordion">

            <!-- Main -->

            <!--<li class="nav-item-header">

               <div class="text-uppercase font-size-xs line-height-xs">Main</div>

               <i class="icon-menu" title="Main"></i>

            </li>-->
            @role('Admin')
            <li class="nav-item">

               <a href="{{route('dashboard')}}" class="nav-link active">

               <i class="icon-home4"></i>

               <span>

               Dashboard

               </span>

               </a>

            </li>
            <li class="nav-item nav-item-submenu">
               <a href="#" class="nav-link"><i class="icon-stack"></i> <span>Product</span></a>
               <ul class="nav nav-group-sub" data-submenu-title="Starter kit">
                  <li class="nav-item"><a href="{{route('game-list.index')}}" class="nav-link"> Games list</a></li>
                  <li class="nav-item"><a href="{{route('category.index')}}" class="nav-link"> All Categories</a></li>
                   <li class="nav-item"><a href="{{route('product.desktop')}}" class="nav-link">All Desktop</a></li>
                   <li class="nav-item"><a href="{{route('product.laptop')}}" class="nav-link">All Laptop</a></li>
                   <li class="nav-item"><a href="{{route('product.create')}}" class="nav-link">New Post</a></li>
               </ul>
            </li>
            
            <li class="nav-item nav-item-submenu">

               <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Tournaments Management</span></a>

               <ul class="nav nav-group-sub" data-submenu-title="Layouts">

                  <li class="nav-item"><a href="{{route('tournaments.index')}}" class="nav-link">View Tournaments</a></li>

                  <!-- <li class="nav-item"><a href="{{route('teamstournament.index')}}" class="nav-link">Teams Tournament</a></li> -->

                  <!-- <li class="nav-item"><a href="{{route('teamtournamentschedule.index')}}" class="nav-link">Team Tournament Schedule</a></li> -->

                  <li class="nav-item"><a href="{{url('tournaments/paid')}}" class="nav-link">Paid Tournaments</a></li>

                  <li class="nav-item"><a href="{{url('tournaments/free')}}" class="nav-link"> 

                     Free Tournaments</a>

                  </li>

                  <!-- <li class="nav-item"><a href="{{route('gamertournamentpoint.index')}}" class="nav-link">Gamer Tournament Point </a></li> -->

                  <!-- <li class="nav-item"><a href="{{route('gamerstournaments.index')}}" class="nav-link">Gamers Tournaments</a></li> -->

               </ul>

            </li>

            <li class="nav-item nav-item-submenu">

               <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Gamers Management</span></a>

               <ul class="nav nav-group-sub" data-submenu-title="Layouts">

                  <li class="nav-item"><a href="{{route('gamers.index')}}" class="nav-link">Gamers</a></li>

               </ul>

            </li>

             <li class="nav-item nav-item-submenu">

               <a href="#" class="nav-link"><i class="icon-users"></i> <span>Teams Management</span></a>

               <ul class="nav nav-group-sub" data-submenu-title="Layouts">

                  <li class="nav-item"><a href="{{route('teams.index')}}" class="nav-link">Teams</a></li>

               </ul>

            </li>
            <li class="nav-item nav-item-submenu">

               <a href="#" class="nav-link"><i class="icon-user"></i> <span>Games</span></a>

               <ul class="nav nav-group-sub" data-submenu-title="Layouts">

                  <li class="nav-item"><a href="{{route('game.index')}}" class="nav-link">Game</a></li>

               </ul>
            </li>
            <li class="nav-item nav-item-submenu">
               <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Transaction</span></a>
               <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                  <li class="nav-item"><a href="{{route('transaction.index')}}" class="nav-link">Transaction</a></li>
               </ul>
            </li>
            @endrole
            	@role('User|Admin')
            <li class="nav-item nav-item-submenu">

               <a href="#" class="nav-link"><i class="icon-stack"></i> <span>News Management</span></a>

               <ul class="nav nav-group-sub" data-submenu-title="Starter kit">

                  <li class="nav-item"><a href="{{route('news.index')}}" class="nav-link">All News</a></li>

                  <li class="nav-item"><a href="{{route('newscategory.index')}}" class="nav-link">News Categories</a></li>

               </ul>

            </li>
            	@endrole
            	@role('Admin')
            <li class="nav-item nav-item-submenu">

               <a href="#" class="nav-link"><i class="icon-color-sampler"></i> <span>Site Settings</span></a>

               <ul class="nav nav-group-sub" data-submenu-title="Themes">

                  <li class="nav-item"><a href="{{route('banner.index')}}" class="nav-link">Banners</a></li>

                   <li class="nav-item"><a href="{{route('cmscontent.index')}}" class="nav-link">Cms Content</a></li>

                  <li class="nav-item"><a href="{{route('seomanagement.index')}}" class="nav-link">Seo Managements</a></li>

                  <li class="nav-item"><a href="{{route('faq.index')}}" class="nav-link">FAQS</a></li>

                   <li class="nav-item"><a href="{{route('sociallinks.index')}}" class="nav-link">Social Links</a></li>

               </ul>

            </li>

            <li class="nav-item nav-item-submenu">

               <a href="#" class="nav-link"><i class="icon-stack"></i> <span>Testimonials</span></a>

               <ul class="nav nav-group-sub" data-submenu-title="Starter kit">

                  <li class="nav-item"><a href="{{route('testimonial.index')}}" class="nav-link">Testimonial</a></li>

               </ul>

            </li>

            <li class="nav-item nav-item-submenu">

               <a href="#" class="nav-link"><i class="icon-stack"></i> <span>Sponsors</span></a>

               <ul class="nav nav-group-sub" data-submenu-title="Starter kit">

                  <li class="nav-item"><a href="{{route('sponsor.index')}}" class="nav-link">Sponsor</a></li>

               </ul>

            </li>
             <li class="nav-item nav-item-submenu">

               <a href="#" class="nav-link"><i class="icon-stack"></i> <span>Reports</span></a>

               <ul class="nav nav-group-sub" data-submenu-title="Starter kit">

                  <li class="nav-item"><a href="{{route('report.gamer_count')}}" class="nav-link"> Count Reports</a></li>

                  <li class="nav-item"><a href="{{route('report.gamer_details')}}" class="nav-link">Gamers Report</a></li>

                   <li class="nav-item"><a href="{{route('report.team_details')}}" class="nav-link">Teams Report</a></li>
                   <li class="nav-item"><a href="{{route('report.registration_details')}}" class="nav-link">Registration Report</a></li>
                   <li class="nav-item"><a href="{{route('report.referrer_details')}}" class="nav-link">Referrer Report</a></li>
                   <li class="nav-item"><a href="{{route('report.voucher_details')}}" class="nav-link">Voucher Redeemed Report</a></li>
                   <li class="nav-item"><a href="{{route('report.social_details')}}" class="nav-link">Social Report(User)</a></li>
                   <li class="nav-item"><a href="{{route('report.social_daily_details')}}" class="nav-link">Social Report(Date)</a></li>
                   {{-- <li class="nav-item"><a href="{{route('report.import_form')}}" class="nav-link">Gift Voucher Import</a></li> --}}

               </ul>

            </li>


             <li class="nav-item nav-item-submenu">

               <a href="#" class="nav-link"><i class="icon-copy"></i> <span>Platforms</span></a>

               <ul class="nav nav-group-sub" data-submenu-title="Layouts">

                  <li class="nav-item"><a href="{{route('platform.index')}}" class="nav-link">Platform</a></li>

               </ul>

            </li>

           

            <li class="nav-item nav-item-submenu">

               <a href="#" class="nav-link"><i class="icon-users"></i> <span>Role Management</span></a>

               <ul class="nav nav-group-sub" data-submenu-title="Themes">

                  <li class="nav-item"><a href="{{route('role.index')}}" class="nav-link">Role</a></li>

                  <li class="nav-item"><a href="{{route('permissions.index')}}" class="nav-link">Permissions</a></li>

               </ul>

            </li>

            

            <li class="nav-item nav-item-submenu">

               <a href="#" class="nav-link"><i class="icon-sphere"></i> <span>Regions</span></a>

               <ul class="nav nav-group-sub" data-submenu-title="Themes">

                  <li class="nav-item"><a href="{{route('country.index')}}" class="nav-link">

                     <i class="icon-map5"></i>Countries List</a>

                  </li>

                  <li class="nav-item"><a href="{{route('region.index')}}" class="nav-link">

                     <i class="icon-sphere"></i>Regions</a>

                  </li>

               </ul>

            </li>
            <li class="nav-item nav-item-submenu">

               <a href="#" class="nav-link"><i class="icon-sphere"></i> <span>Import</span></a>

               <ul class="nav nav-group-sub" data-submenu-title="Themes">

                  <li class="nav-item"><a href="{{route('report.import_file')}}" class="nav-link">

                     <i class="icon-map5"></i>Gift Voucher</a>

                  </li>
               </ul>

            </li>
            @endrole
            <!-- /main -->

         </ul>

      </div>

      <!-- /main navigation -->

   </div>

   <!-- /sidebar content -->

</div>

<!-- /main sidebar -->
