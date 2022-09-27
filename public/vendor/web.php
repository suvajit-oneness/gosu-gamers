<?php

Route::get('lgn/admin/dashboard/login', 'Auth\LoginController@showLoginForm')->name('login/admin');
Route::post('login/admins', 'Auth\LoginController@login')->name('login/admins');
Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', 'HomeController@index')->name('dashboard')->middleware('role:Admin');

    Route::resource('country', 'CountryController')->middleware('role:Admin|User');
    Route::get('country/change-status/{id}', 'CountryController@changeStatus')->middleware('role:Admin');
    Route::post('country/update1', 'CountryController@update1')->name('country.update1')->middleware('role:Admin');
    Route::get('profile', 'HomeController@profile')->name('profile');
    Route::post('saveprofile', 'HomeController@saveprofile')->name('saveprofile');

    Route::get('/change-password', 'HomeController@changePassword')->name('cng_pwd');
    Route::post('/change-password', 'HomeController@changePasswordSave')->name('save_pwd');

    Route::resource('faq', 'FaqController')->middleware('role:Admin|User');
    Route::get('faq/change-status/{id}', 'FaqController@changeStatus')->middleware('role:Admin');
    Route::post('faq/update1', 'FaqController@update1')->name('faq.update1')->middleware('role:Admin');

    Route::resource('game', 'GameController');
    Route::get('game/change-status/{id}', 'GameController@changeStatus')->middleware('role:Admin');
    Route::post('game/update1', 'GameController@update1')->name('game.update1')->middleware('role:Admin');

    Route::resource('gamers', 'GamerController');
    Route::get('gamers/change-status/{id}', 'GamerController@changeStatus')->middleware('role:Admin');
    Route::post('gamers/update1', 'GamerController@update1')->name('gamer.update1')->middleware('role:Admin');

    Route::resource('newscategory', 'NewsCategoryController')->middleware('role:User|Admin');
    Route::get('newscategory/change-status/{id}', 'NewsCategoryController@changeStatus')->middleware('role:User|Admin');
    Route::post('newscategory/update1', 'NewsCategoryController@update1')->name('newscategory.update1')->middleware('role:User|Admin');

    Route::resource('news', 'NewsController')->middleware('role:User|Admin');
    Route::get('news/change-status/{id}', 'NewsController@changeStatus')->middleware('role:User|Admin');
    Route::post('news/update1', 'NewsController@update1')->name('news.update1')->middleware('role:User|Admin');

    Route::resource('cmscontent', 'CmsContentController');
    Route::get('cmscontent/change-status/{id}', 'CmsContentController@changeStatus')->middleware('role:Admin');
    Route::post('cmscontent/update1', 'CmsContentController@update1')->name('cmscontent.update1')->middleware('role:Admin');

    Route::resource('platform', 'PlatformController');
    Route::get('platform/change-status/{id}', 'PlatformController@changeStatus')->middleware('role:Admin');
    Route::post('platform/update1', 'PlatformController@update1')->name('platform.update1')->middleware('role:Admin');

    Route::resource('teams', 'TeamsController');
    Route::get('teams/change-status/{id}', 'TeamsController@changeStatus')->middleware('role:Admin');
    Route::get('teams/edit/{id}', 'TeamsController@edit')->name('teams.edit')->middleware('role:Admin');
    Route::post('teams/update1', 'TeamsController@update1')->name('teams.update1')->middleware('role:Admin');
    Route::post('addteammembers', 'TeamsController@addteammembers')->name('addteammembers.create');
    Route::get('addteamplayers/{id}', 'TeamsController@addteamplayers')->name('addteamplayers');


    Route::resource('banner', 'BannerController');
    Route::get('banner/change-status/{id}', 'BannerController@changeStatus')->middleware('role:Admin');
    Route::post('banner/update1', 'BannerController@update1')->name('banner.update1')->middleware('role:Admin');

    Route::resource('sociallinks', 'SocialLinksController');
    Route::get('sociallinks/change-status/{id}', 'SocialLinksController@changeStatus')->middleware('role:Admin');
    Route::post('sociallinks/update1', 'SocialLinksController@update1')->name('sociallinks.update1')->middleware('role:Admin');


    Route::resource('region', 'RegionController');
    Route::get('region/change-status/{id}', 'regionController@changeStatus')->middleware('role:Admin');
    Route::post('region/update1', 'regionController@update1')->name('region.update1')->middleware('role:Admin');

    Route::resource('seomanagement', 'SeoManagementController');
    Route::get('seomanagement/change-status/{id}', 'SeoManagementController@changeStatus')->middleware('role:Admin');
    Route::post('seomanagement/update1', 'SeoManagementController@update1')->name('seomanagement.update1')->middleware('role:Admin');


    Route::get('tournaments/free', 'TournamentsController@freetournaments')->middleware('role:Admin');
    Route::get('tournaments/paid', 'TournamentsController@paidtournaments')->middleware('role:Admin');
    Route::resource('tournaments', 'TournamentsController')->middleware('role:Admin');
    Route::get('tournaments/stop-joining/{id}', 'TournamentsController@stopjoining')->name('tournament_stop')->middleware('role:Admin');

    Route::get('tournaments/change-status/{id}', 'TournamentsController@changeStatus')->middleware('role:Admin');
    Route::post('tournaments/update1', 'TournamentsController@update1')->name('tournaments.update1')->middleware('role:Admin');
    Route::get('/tournament_user_list/{id}', 'TournamentsController@tournamentUsersList')->name('tournament_user_list');
    Route::get('/view_tournament_rooms/{id}', 'TournamentsController@viewTournamentRoom')->name('view_tournament_rooms');
    Route::get('/view_tournament_schedule/{id}', 'TournamentsController@viewTournamentSchedule')->name('view_tournament_schedule');

    Route::get('/add_schedule/{id}', 'GamerTournamentScheduleController@addSchedule')->name('add_schedule');
    Route::get('/add_teamschedule/{id}', 'TeamTournamentScheduleController@add_teamschedule')->name('add_teamschedule');

    Route::post('/save_schedule', 'GamerTournamentScheduleController@saveSchedule')->name('save_schedule');

    Route::post('tournamentschedule', 'GamerTournamentScheduleController@tournamentschedule')
    ->name('tournamentschedule');

    Route::post('teamtournamentsched', 'TeamTournamentScheduleController@tournamentschedule')
    ->name('teamtournamentsched');

    Route::get('roomtournamentshow/{id}', 'TournamentRoomSlotController@roomwinner')->name('roomtournamentshow');
    Route::post('roomtournamentsave', 'TournamentRoomSlotController@saveroom')->name('roomtournamentsave');

    Route::get('roomtournamentshowteam/{id}', 'TournamentRoomSlotController@roomteamwinner')->name('roomtournamentshowteam');
    Route::post('saveteamroom', 'TournamentRoomSlotController@saveteamroom')->name('saveteamroom');

    Route::post('/assignroom', 'TournamentRoomsController@assignroom')->name('assignroom');
    Route::post('/teamassignroom', 'TournamentRoomsController@teamassignroom')->name('teamassignroom');

    Route::get('/teamassignroomsingle/{id}', 'TournamentRoomsController@teamassignroomsingle')->name('teamassignroomsingle');
    Route::get('/assignroomsingle/{id}', 'TournamentRoomsController@assignroomsingle')->name('assignroomsingle');

    Route::post('/change_tournament_payment_status', 'TournamentController@changeTournamentPaymentStatus')->name('change_tournament_payment_status');

    Route::get('gamerteam/{id}', 'GamersTournamentsController@gamerteam')->name('gamerteam');
    Route::resource('gamerstournaments', 'GamersTournamentsController');
    Route::get('gamerstournaments/change-status/{id}', 'GamersTournamentsController@changeStatus')->middleware('role:Admin');
    Route::post('gamerstournaments/update1', 'GamersTournamentsController@update1')->name('gamerstournaments.update1');
    Route::DELETE('gamertournament/delete/{gtid}', 'GamersTournamentsController@delete')->name('gamertournament.delete');


    Route::resource('gamertournamentpoint', 'GamerTournamentPointController');
    Route::get('gamertournamentpoint/change-status/{id}', 'GamerTournamentPointController@changeStatus')->middleware('role:Admin');
    Route::post('gamertournamentpoint/update1', 'GamerTournamentPointController@update1')->name('gamertournamentpoint.update1')->middleware('role:Admin');

    Route::resource('gamertournamentschedule', 'GamerTournamentScheduleController');
    Route::get('gamertournamentschedule-details/{id}', 'GamerTournamentScheduleController@details');
    Route::post('gamertournamentschedule/update1', 'GamerTournamentScheduleController@update1')->name('gamertournamentschedule.update1')->middleware('role:Admin');

    Route::get('tournamentfixture/{id}', 'GamerTournamentScheduleController@tournamentschedulesinglego')->name('tournamentfixture')->middleware('role:Admin');

    Route::get('team_tournament/create/{id}', 'TeamsTournamentController@create')->name('teamtournament.create')->middleware('role:Admin');
    Route::resource('teamstournament', 'TeamsTournamentController');
    Route:: get('teamstournamentname/{id}', 'TeamsTournamentController@teamname')->name('teamname');
    Route::get('teamstournament/change-status/{id}', 'TeamsTournamentController@changeStatus')->middleware('role:Admin');
    Route::post('teamstournament/update1', 'TeamsTournamentController@update1')->name('teamstournament.update1')->middleware('role:Admin');

    Route::get('teamstournament/changeteams/{id}', 'TeamsTournamentController@changeteams');
    Route::DELETE('teamstournament/delete/{id}', 'TeamsTournamentController@delete')->name('teamstournament.delete');

    Route::get('gamerstournamentschange/{id}', 'GamersTournamentsController@gamerstournamentschange')->name('gamerstournamentschange');

    Route::resource('teamtournamentschedule', 'TeamTournamentScheduleController');
    Route::post('teamtournamentschedule/update1', 'TeamTournamentScheduleController@update1')->name('teamtournamentschedule.update1')->middleware('role:Admin');
    Route::get('teamtournamentfixture/{id}', 'TeamTournamentScheduleController@tournamentschedulesinglego')->name('teamtournamentfixture')->middleware('role:Admin');

    Route::resource('tournamentrooms', 'TournamentRoomsController');
    Route::get('tournamentrooms/change-status/{id}', 'TournamentRoomsController@changeStatus')->middleware('role:Admin');
    Route::post('tournamentrooms/update1', 'TournamentRoomsController@update1')->name('tournamentrooms.update1')->middleware('role:Admin');

    Route::post('sendallgameremail', 'GamerController@sendEmail')->name('sendallgameremail')->middleware('role:Admin');
    Route::post('sendallteamemail', 'TeamsController@sendEmail')->name('sendallteamemail')->middleware('role:Admin');


    Route::get('role/index', 'RoleController@index')->name('role.index')->middleware('role:Admin');
    Route::get('role/create', 'RoleController@create')->name('role.create')->middleware('role:Admin');
    Route::post('role/store', 'RoleController@store')->name('role.store')->middleware('role:Admin');
    Route::get('role/create', 'RoleController@create')->name('role.create')->middleware('role:Admin');
    Route::get('role/{id}/edit', 'RoleController@edit')->middleware('role:Admin');
    Route::PUT('role/{role}', 'RoleController@update')->name('role.update')->middleware('role:Admin');
    Route::DELETE('role/{role}', 'RoleController@destroy')->name('role.destroy')->middleware('role:Admin');
    Route::Post('role/assign', 'RoleController@assign')->name('role.assign')->middleware('role:Admin');
    Route::resource('permissions', 'PermissionController')->middleware('role:Admin');

    Route::post('checkSlugUrl', 'DashboardController@checkSlugUrl')->name('checkSlugUrl');

    Route::resource('genre', 'GenreController');
    Route::resource('platform', 'PlatformController');
    Route::resource('sponsor', 'SponsorController');
    Route::get('sponsor/change-status/{id}', 'SponsorController@changeStatus')->middleware('role:Admin');
    Route::post('sponsor/update1', 'SponsorController@update1')->name('sponsor.update1')->middleware('role:Admin');

    Route::resource('testimonial', 'TestimonialController');
    Route::get('testimonial/change-status/{id}', 'TestimonialController@changeStatus')->middleware('role:Admin');
    Route::post('testimonial/update1', 'TestimonialController@update1')->name('testimonial.update1')->middleware('role:Admin');

    Route::post('roomSchedule', 'GamersTournamentsController@roomSchedule')->name('roomSchedule')->middleware('role:Admin');
    Route::post('roomSchedulemail', 'GamersTournamentsController@roomSchedulemail')->name('roomSchedulemail')->middleware('role:Admin');
    Route::post('sendMail', 'GamersTournamentsController@sendMail')->name('sendMail')->middleware('role:Admin');

    Route::post('teamroomSchedule', 'TeamsTournamentController@roomSchedule')->name('teamroomSchedule')->middleware('role:Admin');
    Route::post('teamroomSchedulemail', 'TeamsTournamentController@teamroomSchedulemail')->name('teamroomSchedulemail')->middleware('role:Admin');
    Route::post('teamsendMail', 'TeamsTournamentController@sendMail')->name('teamsendMail')->middleware('role:Admin');

    Route::get('autocomplete', 'TournamentsController@autocomplete')->name('autocomplete');

    Route::get('gamerpositions/{id}', 'GamerController@gamerpositions')->name('gamerpositions');
    Route::post('positionsteam', 'GamerController@positionsteam')->name('positionsteam.store');
    Route::post('positionsindiv', 'GamerController@positionsindiv')->name('positionsindiv.store');

    Route::resource('transaction', 'TransactionController');
    Route::get('transactions/indiv', 'TransactionController@indivtransac')->name('transactions.gamer');
    Route::get('transactions/team', 'TransactionController@teamtransac')->name('transactions.team');



    Route::get('report/gamer', 'ReportController@gamer_count')->name('report.gamer_count');
    Route::post('/count-user', 'ReportController@countUser')->name('count_user');
    Route::get('report/gamer_detail', 'ReportController@gamer_details')->name('report.gamer_details');
    Route::get('report/team_detail', 'ReportController@team_details')->name('report.team_details');
    Route::get('report/registration_detail', 'ReportController@registration_details')->name('report.registration_details');
    Route::get('report/social_daily_detail', 'ReportController@social_daily_details')->name('report.social_daily_details');
    Route::get('report/social_detail', 'ReportController@social_details')->name('report.social_details');
    Route::get('report/referrer_detail', 'ReportController@referrer_details')->name('report.referrer_details');
    Route::get('report/voucher_detail', 'ReportController@voucher_details')->name('report.voucher_details');
    Route::get('report/gamer_detail/{from_date}/{to_date}/export', 'ReportController@gamer_details_export')->name('report.gamer_detail.export');
    Route::get('report/team_detail/{from_date}/{to_date}/export', 'ReportController@team_details_export')->name('report.team_detail.export');
    Route::get('report/registration_detail/{from_date}/{to_date}/export', 'ReportController@registration_details_export')->name('report.registration_detail.export');
    Route::get('report/referrer_detail/{from_date}/{to_date}/export', 'ReportController@referrer_details_export')->name('report.referrer_detail.export');
    Route::get('report/voucher_detail/{from_date}/{to_date}/export', 'ReportController@voucher_details_export')->name('report.voucher_detail.export');
    Route::get('report/socialmedia_detail/{from_date}/{to_date}/export', 'ReportController@socialmedia_details_export')->name('report.socialmedia_detail.export');
    Route::get('report/social_daily_detail/{from_date}/{to_date}/export', 'ReportController@social_daily_details_export')->name('report.social_daily_detail.export');

// import file
    Route::get('report/import_file', 'ReportController@importFile')->name('report.import_file');
    Route::post('report/voucher-import', 'ReportController@VoucherImport')->name('report.voucher-import');


});
Route::post('optloginpost', 'Auth\GamerOtpController@otploginpost')->name('optloginpost');
Route::get('/home', 'Website\HomeController@index')->name('home.index');
Route::get('about-us', 'Website\HomeController@about')->name('home.about');
Route::get('data-deletion-instruction', 'Website\HomeController@datadeletioninstruction')->name('home.datadeletioninstruction');
Route::get('terms-conditions', 'Website\HomeController@termsandcond')->name('home.terms.conditions');
Route::get('privacy-policy', 'Website\HomeController@privacypolicy')->name('home.privacy.policy');
Route::get('refund-cancellation', 'Website\HomeController@refundcancel')->name('home.refund.cancel');
Route::get('faqs', 'Website\HomeController@faqs')->name('home.faqs');
Route::get('contact-us', 'Website\HomeController@contact')->name('home.contact');
Route::get('games', 'Website\GamesController@index')->name('site.game');
Route::get('game-details/{id}/{slug}', 'Website\GamesController@gamedetails')->name('detail.game');
Route::get('upcoming-tournaments', 'Website\TournamentsController@index')->name('site.tournaments');
Route::get('user-created-tournaments', 'Website\TournamentsController@user_created_tournaments')->name('user_created_tournaments');
Route::get('completed-tournaments', 'Website\TournamentsController@complete')->name('complete.tournaments');
Route::get('tournament-details/{id}/{slug}', 'Website\TournamentsController@detail')
           ->name('site.tournamentsdetail');
Route::get('tournament-sorting/{id}/{slug}', 'Website\TournamentsController@tournamentSorting')
           ->name('site.tournamentSorting');
Route::get('complete-sorting/{id}/{slug}', 'Website\TournamentsController@completetournamentSorting')
           ->name('site.completeSorting');
Route::get('leaderboards', 'Website\LeaderboardsController@index')->name('site.leaderboards');
Route::get('site-news', 'Website\NewsController@index')->name('site.news');
Route::get('news-details/{id}/{slug}', 'Website\NewsController@details')->name('detail.news');
Route::get('news-sorting/{id}/{slug}', 'Website\NewsController@newsSorting')
           ->name('site.newsSorting');
Route::get('game-wise-leaderboard/{id}/{slug}', 'Website\LeaderboardsController@game_wise_leaderboard')
           ->name('site.game_wise_leaderboard');
Route::get('gamer/mytournament/{id}', 'Website\TournamentsController@mygame')->name('mytournament');

/* Add Tournament For Gamer*/
Route::prefix('gamer')->name('gamer.')->group(function() {
	Route::prefix('tournaments')->name('tournaments.')->group(function() {
		Route::get('show/{id}','Website\TournamentsController@show')->name('show');
		Route::get('create/{id}','Website\TournamentsController@create')->name('create');
		Route::POST('store/{id}','Website\TournamentsController@store')->name('store');
		Route::get('{id}/edit','Website\TournamentsController@edit')->name('edit');
		Route::POST('update','Website\TournamentsController@update')->name('update');
		Route::get('change-status/{id}','Website\TournamentsController@changeStatus')->name('change-status');
		Route::DELETE('destroy/{id}','Website\TournamentsController@destroy')->name('destroy');
		Route::get('stop-joining/{id}','Website\TournamentsController@stopjoining')->name('stop-joining');

		Route::get('view-tournament-rooms/{id}','Website\TournamentsController@viewTournamentRoom')->name('view-tournament-rooms');
		Route::get('user_list/{id}','Website\TournamentsController@tournamentUsersList')->name('user_list');
		Route::get('autocomplete', 'Website\TournamentsController@autocomplete')->name('autocomplete');
	});	
});

/* Add Gamer Tournament Schedule*/
Route::prefix('gamer')->name('gamer.')->group(function() {
	Route::prefix('tournaments')->name('tournaments.')->group(function() {

		Route::get('gamertournamentschedule/index','Website\GamerTSController@index')->name('gamertournamentschedule.index');
		Route::get('gamertournamentschedule/edit/{id}','Website\GamerTSController@edit')->name('gamertournamentschedule.edit');
		Route::post('gamertournamentschedule/update1','Website\GamerTSController@update1')->name('gamertournamentschedule.update1');
		Route::get('schedule-details/{id}', 'Website\GamerTSController@details')->name('schedule-details');
		Route::get('tournamentfixture/{id}','Website\GamerTSController@tournamentschedulesinglego')->name('tournamentfixture');
		Route::get('add_schedule/{id}','Website\GamerTSController@addSchedule')->name('add_schedule');
		Route::post('gamertournamentschedule','Website\GamerTSController@tournamentschedule')->name('gamertournamentschedule');
	});
});

/* Add Team Tournament Schedule*/
Route::prefix('gamer')->name('gamer.')->group(function(){
	Route::prefix('tournaments')->name('tournaments.')->group(function(){
		Route::get('teamtournamentschedule/index', 'Website\TeamTournamentScheduleController@index')->name('teamtournamentschedule.index');
		Route::get('teamtournamentschedule/create', 'Website\TeamTournamentScheduleController@create')->name('.teamtournamentschedule.create');

		Route::get('teamtournamentschedule/show/{id}', 'Website\TeamTournamentScheduleController@show')->name('teamtournamentschedule.show');
		Route::get('teamtournamentschedule/edit/{id}', 'Website\TeamTournamentScheduleController@edit')->name('teamtournamentschedule.edit');
		Route::post('teamtournamentschedule/update1', 'Website\TeamTournamentScheduleController@update1')->name('teamtournamentschedule.update1');
		Route::get('teamtournamentfixture/{id}','Website\TeamTournamentScheduleController@tournamentschedulesinglego')->name('teamtournamentfixture');
		Route::get('/add_teamschedule/{id}','Website\TeamTournamentScheduleController@add_teamschedule')->name('add_teamschedule');
		Route::post('/teamtournamentschedule','Website\TeamTournamentScheduleController@tournamentschedule')->name('teamtournamentschedule');
	});
});

Route::prefix('gamer')->name('gamer.')->group(function(){
    Route::get('roomtournamentshow/{id}','Website\TournamentRoomSlotController@roomwinner')->name('roomtournamentshow');
    Route::post('roomtournamentsave','Website\TournamentRoomSlotController@saveroom')->name('roomtournamentsave');
    Route::get('roomtournamentshowteam/{id}','Website\TournamentRoomSlotController@roomteamwinner')->name('roomtournamentshowteam');

    Route::post('saveteamroom','Website\TournamentRoomSlotController@saveteamroom')->name('saveteamroom');
});

/*Gamer List */
Route::prefix('gamer')->name('gamer.')->group(function(){
    Route::resource('teamstournament','Website\TeamsTournamentController');
    Route:: get('teamstournamentname/{id}','Website\TeamsTournamentController@teamname')->name('teamname');
    Route::get('teamstournament/change-status/{id}', 'Website\TeamsTournamentController@changeStatus');
    Route::post('teamstournament/update1', 'Website\TeamsTournamentController@update1')->name('teamstournament.update1');
    Route::get('teamassignroomsingle/{id}', 'Website\TournamentRoomsController@teamassignroomsingle')->name('teamassignroomsingle');
    Route::get('teamstournament/changeteams/{id}', 'Website\TeamsTournamentController@changeteams');
    Route::get('gamerstournamentschange/{id}', 'Website\GamersTournamentsController@gamerstournamentschange')->name('gamerstournamentschange');
    Route::post('roomSchedule', 'Website\GamersTournamentsController@roomSchedule')->name('roomSchedule');
    Route::post('teamroomSchedule', 'Website\TeamsTournamentController@roomSchedule')->name('teamroomSchedule');
    Route::post('teamroomSchedulemail', 'Website\TeamsTournamentController@teamroomSchedulemail')->name('teamroomSchedulemail');
    Route::post('teamsendMail', 'Website\TeamsTournamentController@sendMail')->name('teamsendMail');
    Route::get ('gamerpositions/{id}','Website\GamerController@gamerpositions')->name('gamerpositions');
    Route::post ('positionsteam','Website\GamerController@positionsteam')->name('positionsteam.store');
    Route::post ('positionsindiv','Website\GamerController@positionsindiv')->name('positionsindiv.store');
    Route::post('sendallgameremail', 'Website\GamerController@sendEmail')->name('sendallgameremail');
});

/*Gamer List */
Route::prefix('gamer')->name('gamer.')->group(function(){
    Route::get('gamerteam/{id}','Website\GamersTournamentsController@gamerteam')->name('gamerteam');
    Route::resource('gamerstournaments','Website\GamersTournamentsController');
    Route::get('gamerstournaments/change-status/{id}', 'Website\GamersTournamentsController@changeStatus');
    Route::post('gamerstournaments/update1', 'Website\GamersTournamentsController@update1')->name('gamerstournaments.update1');
});

Route::resource('gamerplatfrom', 'Website\GamerPlatfromDetailController');
Route::post('gameringameidsave', 'Website\GamerPlatfromDetailController@gameringameidsave')->name('gameringameidsave');
Route::post('gamerstournaments/update2', 'Website\GamerPlatfromDetailController@update2')->name('gamerstournaments.update2');
Route::get('mytransactions/{id}', 'Website\LeaderboardsController@mytransactions')->name('mytransactions');
Route::get('tournamentwon/{id}', 'Website\LeaderboardsController@tournamentwon')->name('tournamentwon');

Route::get('fixture/{id}', 'Website\TournamentsController@fixture')->name('fixture');


Route::get('gamer/register', 'Auth\GamerLoginController@register')->name('gamer.register');
Route::post('gamer/register', 'Auth\GamerLoginController@registersave')->name('gamer.register.submit');
Route::post('team/register', 'Auth\GamerLoginController@registerteamsave')->name('team.register.submit');
Route::post('team/addplayers', 'Auth\GamerLoginController@addteamplayer')->name('addteamplayer');
Route::get('home/otplogin', 'Auth\GamerOtpController@otplogin')->name('home.login');
Route::get('gamer/profile/{id}', 'Auth\GamerLoginController@profile')->name('gamer.profile');
Route::get('gamer/edit', 'Auth\GamerLoginController@edit')->name('gamer.edit');
Route::post('gamer/edit/save', 'Auth\GamerLoginController@editsave')->name('gamer.edit.save');
Route::post('gamer/login', 'Auth\GamerLoginController@login')->name('gamer.login.submit');
Route::post('gamer/otplogin', 'Auth\GamerOtpController@otploginsubmit')->name('gamer.otplogin.submit');
Route::post('team/login', 'Auth\GamerLoginController@teamlogin')->name('team.login.submit');
Route::post('gamer/logout', 'Auth\GamerLoginController@logout')->name('gamer.logout');
Route::get('verifyotpfirst', 'Auth\GamerLoginController@verifyotpfirst')->name('verifyotpfirst');
Route::post('otpverify', 'Auth\GamerLoginController@sendemaildone')->name('otpverify');
Route::post('deleteteamplayer', 'Auth\GamerLoginController@deleteteamplayer')->name('deleteteamplayer');
Route::post('updateteamplayer', 'Auth\GamerLoginController@updateteamplayer')->name('updateteamplayer');
Route::post('forgetpassword', 'Auth\GamerLoginController@forgetpassword')->name('forgetpassword');
Route::post('otpverifyforget', 'Auth\GamerLoginController@otpverifyforget')->name('otpverifyforget');
Route::get('home/passwordreset/{id}', 'Auth\GamerLoginController@passwordreset')->name('home.passwordreset');
Route::post('passwordresetstore', 'Auth\GamerLoginController@passwordresetstore')->name('passwordresetstore');


Route::get('fps', 'Website\HomeController@fps')->name('home.fps');
Route::get('itl', 'Website\HomeController@itl')->name('home.itl');
Route::get('fps/codm', 'Website\HomeController@fps_codm')->name('home.fps_codm');
Route::get('test_email', 'Auth\GamerOtpController@test_email')->name('home.test_email');

Route::post('socialloginpost', 'Auth\GamerOtpController@socialLogin')->name('gamer.sociallogin.submit');
Route::get('team_fixture/{id}', 'Website\TournamentsController@team_fixture')->name('team_fixture');



// FlipKart
Route::get('flipkart-gaming', 'Website\FlipKart\FlipKartController@index')->name('flipkart.gaming');
Route::get('flipkart-gaming/tournament-details/{id}/{slug}', 'Website\FlipKart\FlipKartController@detail')->name('site.tournamentsdetail');

Route::get('flipkart-gaming/register/{ref_code?}', 'Website\FlipKart\FlipKartController@register')->name('flipkart.register');
Route::post('flipkart-gaming/register', 'Website\FlipKart\FlipKartController@registerSave')->name('flipkart.register.submit');

Route::get('flipkart-gaming/verify-account', 'Website\FlipKart\FlipKartController@verifyAccount')->name('flipkart.verify.account');
Route::post('flipkart-gaming/verify-account', 'Website\FlipKart\FlipKartController@verifyAccountDo')->name('flipkart.verify.account.submit');
Route::get('flipkart-gaming/verify-account/{random_multiplier}/{multiplied_gamer_id}/{otp_sha256_hash}', 'Website\FlipKart\FlipKartController@verifyAccountDirect')->name('flipkart.verify.account.direct');
Route::get('flipkart-gaming/resend-otp', 'Website\FlipKart\FlipKartController@resendOTP')->name('flipkart.resend.otp');
Route::post('flipkart-gaming/resend-otp', 'Website\FlipKart\FlipKartController@resendOTPDo')->name('flipkart.resend.otp.submit');


Route::get('flipkart-gaming/login', 'Website\FlipKart\FlipKartController@login')->name('flipkart.login');
Route::post('flipkart-gaming/login', 'Website\FlipKart\FlipKartController@loginDo')->name('flipkart.login.submit');
Route::post('flipkart-gaming/logout', 'Website\FlipKart\FlipKartController@logoutDo')->name('flipkart.logout');

Route::get('flipkart-gaming/forgot-password', 'Website\FlipKart\FlipKartController@forgotPassword')->name('flipkart.forgot.password');
Route::post('flipkart-gaming/forgot-password', 'Website\FlipKart\FlipKartController@forgotPasswordDo')->name('flipkart.forgot.password.submit');
Route::get('flipkart-gaming/reset-password/{forgot_password_hash}', 'Website\FlipKart\FlipKartController@resetPassword')->name('flipkart.reset.password');
Route::post('flipkart-gaming/reset-password', 'Website\FlipKart\FlipKartController@resetPasswordDo')->name('flipkart.reset.password.submit');

Route::get('flipkart/profile/{id}', 'Website\FlipKart\FlipKartController@profile')->name('flipkart.profile');
Route::get('flipkart-gaming/profile-edit', 'Website\FlipKart\FlipKartController@profileEdit')->name('flipkart.profile-edit');
Route::post('flipkart-gaming/profile-edit', 'Website\FlipKart\FlipKartController@profileEditSave')->name('flipkart.profile-edit.submit');

Route::get('flipkart-gaming/news', 'Website\FlipKart\FlipKartController@newsIndex')->name('flipkart.news');

Route::get('flipkart-gaming/upcoming-tournaments', 'Website\FlipKart\FlipKartController@upcomingTournaments')->name('flipkart.upcoming-tournaments');
Route::get('flipkart-gaming/completed-tournaments', 'Website\FlipKart\FlipKartController@completedTournaments')->name('flipkart.completed-tournaments');

Route::get('flipkart-gaming/earn-points', 'Website\FlipKart\FlipKartController@earnPoints')->name('flipkart.earn.points');
Route::get('flipkart-gaming/redeem-points', 'Website\FlipKart\FlipKartController@redeemPoints')->name('flipkart.redeem.points');
Route::get('flipkart-gaming/redeem-points/{points}', 'Website\FlipKart\FlipKartController@redeemPointsDo')->name('flipkart.redeem.points.do');

Route::get('flipkart-gaming/spread-the-word', 'Website\FlipKart\FlipKartController@spreadTheWord')->name('flipkart.spread.the.word');
Route::get('flipkart-gaming/refer-a-friend', 'Website\FlipKart\FlipKartController@referAFriend')->name('flipkart.refer.a.friend');

Route::get('flipkart-gaming/coming-soon', 'Website\FlipKart\FlipKartController@comingSoon')->name('flipkart.coming.soon');

Route::get('flipkart-gaming/test-email-k29veopsh28bd', 'Website\FlipKart\FlipKartController@testEmail')->name('flipkart.test.email');
Route::get('flipkart-gaming/test-sms-k29veopsh28bd', 'Website\FlipKart\FlipKartController@testSMS')->name('flipkart.test.sms');
Route::post('flipkart-gaming/team/register', 'Website\FlipKart\FlipKartController@registerteamsave')->name('flipkark.team.register.submit');








// Game For Sale
Route::prefix('game-list')->name('game-list.')->group(function() {
	Route::get('/', 'GameSalesController@index')->name('index')->middleware('role:Admin');
	Route::get('/create', 'GameSalesController@create')->name('create')->middleware('role:Admin');
	Route::post('/store', 'GameSalesController@store')->name('store')->middleware('role:Admin');
	Route::get('/{id}/edit', 'GameSalesController@edit')->name('edit')->middleware('role:Admin');
	Route::post('/update', 'GameSalesController@update')->name('update')->middleware('role:Admin');
	Route::get('/change-status/{id}', 'GameSalesController@changeStatus')->name('change-status')->middleware('role:Admin');
	Route::DELETE('/{id}/destroy', 'GameSalesController@destroy')->name('destroy')->middleware('role:Admin');
});

// Category
Route::prefix('category')->name('category.')->group(function() {
	Route::get('/', 'ProductCategoryController@index')->name('index')->middleware('role:Admin');
	Route::get('/create', 'ProductCategoryController@create')->name('create')->middleware('role:Admin');
	Route::post('/store', 'ProductCategoryController@store')->name('store')->middleware('role:Admin');
	Route::get('/{id}/edit', 'ProductCategoryController@edit')->name('edit')->middleware('role:Admin');
	Route::post('/update', 'ProductCategoryController@update')->name('update')->middleware('role:Admin');
	Route::get('/change-status/{id}', 'ProductCategoryController@changeStatus')->name('change-status')->middleware('role:Admin');
	Route::DELETE('/{id}/destroy', 'ProductCategoryController@destroy')->name('destroy')->middleware('role:Admin');
});

// Products
Route::prefix('product')->name('product.')->group(function() {
	Route::get('/', 'ProductController@index')->name('index')->middleware('role:Admin');
	Route::get('/desktop', 'ProductController@desktop')->name('desktop')->middleware('role:Admin');
	Route::get('/laptop', 'ProductController@laptop')->name('laptop')->middleware('role:Admin');
	Route::get('/create', 'ProductController@create')->name('create')->middleware('role:Admin');
	Route::post('/store', 'ProductController@store')->name('store')->middleware('role:Admin');
	Route::get('/show/{id}', 'ProductController@show')->name('show')->middleware('role:Admin');
	Route::get('/edit/{id}', 'ProductController@edit')->name('edit')->middleware('role:Admin');
	Route::post('/update', 'ProductController@update')->name('update')->middleware('role:Admin');
	Route::get('/change-status/{id}', 'ProductController@changeStatus')->name('change-status')->middleware('role:Admin');
	Route::DELETE('/{id}/destroy', 'ProductController@destroy')->name('destroy')->middleware('role:Admin');
    Route::get('pc-export', 'ProductController@pc_details_export')->name('pc-export')->middleware('role:Admin');
    Route::get('laptop-export', 'ProductController@laptop_details_export')->name('laptop-export')->middleware('role:Admin');
});

// Front End Product View
Route::prefix('products')->name('products.')->group(function() {
    Route::get('/pc','Website\ProductController@desktop')->name('pc');
    Route::get('/laptop','Website\ProductController@laptop')->name('laptop');
    Route::get('/pc-details/{id}','Website\ProductController@desktopdetails')->name('pc-details');
    Route::get('/laptop-details/{id}','Website\ProductController@laptopdetails')->name('laptop-details');
    Route::get('/savings','Website\ProductController@saving')->name('savings');
    Route::post('/click-count','Website\ProductController@clickcount')->name('click-count');
});
Route::post('flipkart-gaming/click-count', 'Website\FlipKart\FlipKartController@socialmediacount')->name('flipkart.click-count');