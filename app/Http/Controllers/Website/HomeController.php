<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\CmsContent;
use App\Models\Faq;
use App\Models\Game;
use App\Models\Sponsor;
use App\Models\Testimonial;
use App\Models\Tournaments;
use DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $banners = Banner::where('is_active', 1)->where('is_deleted', 0)->where('partner', 'lgn')->get();
        $today = date("Y-m-d");
        $upcoming_tournaments = DB::table('tournaments')
            ->join('games', 'tournaments.game_id', '=', 'games.id')
            ->select('tournaments.*', 'games.name as game_name')
            ->where('tournaments.is_active', 1)
            ->where('tournaments.is_deleted', 0)
            ->where('tournaments.start_date', '>', $today)
            ->get();
        $games = Game::where('is_active', 1)->where('is_deleted', 0)->get();
        $current_time = date('Y-m-d H:i:s');
        $tournaments = Tournaments::where('is_active', 1)->where('is_deleted', 0)->latest('id')->limit('6')->where('start_date', '>', $current_time)->get();

//        $news = DB::table('news')
//            ->join('news_categories', 'news.category_id', '=', 'news_categories.id')
//            ->select('news.*', 'news_categories.name as category_name')
//            ->where('news.is_active', 1)
//            ->where('news.is_deleted', 0)
//            ->where('news.partner', "lgn")
//            ->orderBy('id', 'DESC')
//            ->limit('6')
//            ->get();

        $news = DB::table('news')
//            ->join('news_categories', 'news.category_id', '=', 'news_categories.id')
            ->select('news.*')
            ->where('news.is_active', 1)
            ->where('news.is_deleted', 0)
            ->where('news.partner', "lgn")
            ->orderBy('id', 'DESC')
            ->limit('6')
            ->get();

        // $tournaments
        $news_categories = DB::table('news_categories')
            ->select('news_categories.*')
            ->get()
            ->toArray();
        $news_categories_arr = array();
        foreach ($news_categories as $news_category) {
            $news_categories_arr[$news_category->id] = $news_category->name;
        }

        $testimonials = Testimonial::where('is_active', 1)->where('is_deleted', 0)->get();
        $sponsors = Sponsor::where('is_active', 1)->where('is_deleted', 0)->get();
        return view('website.index', compact('banners', 'games', 'tournaments', 'news', 'news_categories', 'news_categories_arr', 'testimonials', 'sponsors', 'upcoming_tournaments'));
    }

    public function about()
    {
        $about_us = CmsContent::where('cms_contents.slug', 'about_us')
            ->first();

        return view('website.home.about', compact('about_us'));
    }

    public function datadeletioninstruction()
    {
        return view('website.home.datadeletioninstruction');
    }

    public function contact()
    {
        return view('website.home.contact');
    }

    public function termsandcond()
    {
        $terms = CmsContent::where('cms_contents.slug', 'terms')
            ->get();

        return view('website.home.termsandcond', compact('terms'));
    }

    public function privacypolicy()
    {
        $privacy = CmsContent::where('cms_contents.slug', 'privacy-policy')
            ->get();

        return view('website.home.privacy', compact('privacy'));
    }

    public function refundcancel()
    {
        $refund = CmsContent::where('cms_contents.slug', 'refunds')
            ->get();

        return view('website.home.refund', compact('refund'));
    }

    public function faqs()
    {
        $faqs = Faq::all();

        return view('website.home.faq', compact('faqs'));
    }

    public function fps()
    {
        //die("fps");
        return redirect("https://letsgamenow.com/tournament-details/551/flipkart-pro-gaming-mega-showdown-cod-mobile-battle-royale-tournament-11-13-th-november");
    }

    public function itl()
    {
        //die("fps");
        return redirect("https://letsgamenow.com/fixture/518");
    }

    public function fps_codm()
    {
        //die("fps");
        return redirect("https://letsgamenow.com/tournament-details/523/cod-mobile-flipkart-pro-gaming-showdown-battle-royale-tournament-");
    }
}
