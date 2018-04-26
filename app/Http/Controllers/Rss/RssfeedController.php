<?php

namespace App\Http\Controllers\Rss;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use willvincent\Feeds\Facades\FeedsFacade;
use App\Models\Rssfeed;
use App\Models\Categories;


class RssfeedController extends Controller
{
    //

    public function demo() {


        //$feed = \Feeds::make('http://markets.businessinsider.com/rss/news');
        $feed = \Feeds::make('http://feeds.feedburner.com/entrepreneur/latest');
        $feed = \Feeds::make('http://rss.cnn.com/rss/money_news_international.rss');
        $feed = \Feeds::make('https://www.cnbcafrica.com/feed/');
        $feed = \Feeds::make('https://nairametrics.com/feed/');

        $feed= \Feeds::make(['http://feeds.feedburner.com/entrepreneur/latest','http://rss.cnn
        .com/rss/money_news_international.rss','https://nairametrics.com/feed/','http://markets.businessinsider.com/rss/news','https://www.cnbcafrica.com/feed/'],20,true);


//       dd($feed);
        $data = array(
            'title'     => $feed->get_title(),
            'permalink' => $feed->get_permalink(),
            'items'     => $feed->get_items(),
        );

//        dd($data);

        foreach ( $data['items'] as $item)
        {


//            if ($enclosure = $item->get_enclosure())
//            {
//                echo $enclosure->get_category();
//                echo "<br>";
//            }
           // print_r($item);
            dd($item);

//            foreach($item->get_categories() as $category)
//            {
//                echo $category->get_label();
//            }
        }
    die();

       return view('rssfeed',compact('data'));

    }

    public function updateRssfeeds()
    {
        //Entertainment Feed
        // ==================================================================================================
        $entertenmainfeed= \Feeds::make(['https://www.lindaikejisblog.com/feed','http://www.gossipmill.com/feed/','http://misspetitenaijablog.com/feed/','https://www.kemifilani.com/feed','https://lailasnews.com/feed/'],3,true);
        $feed=$entertenmainfeed;
        $data = array(
            'title'     => $feed->get_title(),
            'permalink' => $feed->get_permalink(),
            'items'     => $feed->get_items(),
        );
        foreach ($data['items'] as $item)
        {
            if(Rssfeed::where('title', $item->get_title())->first())
            {
                continue;
            }
             else
             {
                 $rssfeed=new Rssfeed;
                 $rssfeed->categories_id= Categories::where('name','Entertainment')->first()->id;
                 $rssfeed->title=$item->get_title();
                 $rssfeed->title_url= $item->get_permalink();
                 $rssfeed->description=$item->get_content();
                 $rssfeed->news_upload_time=$item->get_date('j F Y | g:i a');
                 $rssfeed->save();
             }

        }
        //////////======================================================================

        //Business Feed
        // ==================================================================================================
        $businessfeed= \Feeds::make(['http://feeds.feedburner.com/entrepreneur/latest','http://rss.cnn
        .com/rss/money_news_international.rss','https://nairametrics.com/feed/','http://markets.businessinsider.com/rss/news','https://www.cnbcafrica.com/feed/'],3,true);
        $feed=$businessfeed;
        $data = array(
            'title'     => $feed->get_title(),
            'permalink' => $feed->get_permalink(),
            'items'     => $feed->get_items(),
        );
        foreach ($data['items'] as $item)
        {
            if(Rssfeed::where('title', $item->get_title())->first())
            {
                continue;
            }
            else
            {
                $rssfeed=new Rssfeed;
                $rssfeed->categories_id= Categories::where('name','Business')->first()->id;
                $rssfeed->title=$item->get_title();
                $rssfeed->title_url= $item->get_permalink();
                $rssfeed->description=$item->get_content();
                $rssfeed->news_upload_time=$item->get_date('j F Y | g:i a');
                $rssfeed->save();
            }

        }
        //////////Sports Feeds======================================================================

        $sportfeed= \Feeds::make(['http://www.goal.com/en/feeds/news?fmt=rss&ICID=HP','https://www.completesportsnigeria.com/feed/','http://www.espnfc.com/rss','https://www.fourfourtwo.com/rss-settat/rss','https://www.thesportreview.com/feed/'],3,true);


        $feed=$sportfeed;
        $data = array(
            'title'     => $feed->get_title(),
            'permalink' => $feed->get_permalink(),
            'items'     => $feed->get_items(),
        );
        foreach ($data['items'] as $item)
        {
            if(Rssfeed::where('title', $item->get_title())->first())
            {
                continue;
            }
            else
            {
                $rssfeed=new Rssfeed;
                $rssfeed->categories_id= Categories::where('name','Sports')->first()->id;
                $rssfeed->title=$item->get_title();
                $rssfeed->title_url= $item->get_permalink();
                $rssfeed->description=$item->get_content();
                $rssfeed->news_upload_time=$item->get_date('j F Y | g:i a');
                $rssfeed->save();
            }

        }
        //////////======================================================================
        ///
        $newsfeed= \Feeds::make(['http://rss.cnn.com/rss/edition.rss','https://static01.nyt.com/services/xml/rss','https://www.naija.ng/rss/all.rss','https://www.vanguardngr.com/news/feed/','https://www.vanguardngr.com/news/feed/'],3,true);

        $feed=$newsfeed;
                $data = array(
                    'title'     => $feed->get_title(),
                    'permalink' => $feed->get_permalink(),
                    'items'     => $feed->get_items(),
                );
                foreach ($data['items'] as $item)
                {
                    if(Rssfeed::where('title', $item->get_title())->first())
                    {
                        continue;
                    }
                    else
                    {
                        $rssfeed=new Rssfeed;
                        $rssfeed->categories_id= Categories::where('name','News')->first()->id;
                        $rssfeed->title=$item->get_title();
                        $rssfeed->title_url= $item->get_permalink();
                        $rssfeed->description=$item->get_content();
                        $rssfeed->news_upload_time=$item->get_date('j F Y | g:i a');
                        $rssfeed->save();
                    }

                }
        //        //////////======================================================================



        $techfeed= \Feeds::make(['https://techcrunch.com/feed/','https://techmoran.com/feed/','https://www.techinasia.com/feed','https://techpoint.ng/feed/','http://disrupt-africa.com/feed/'],3,true);


        $feed=$techfeed;
        $data = array(
            'title'     => $feed->get_title(),
            'permalink' => $feed->get_permalink(),
            'items'     => $feed->get_items(),
        );
        foreach ($data['items'] as $item)
        {
            if(Rssfeed::where('title', $item->get_title())->first())
            {
                continue;
            }
            else
            {
                $rssfeed=new Rssfeed;
                $rssfeed->categories_id= Categories::where('name','Tech')->first()->id;
                $rssfeed->title=$item->get_title();
                $rssfeed->title_url= $item->get_permalink();
                $rssfeed->description=$item->get_content();
                $rssfeed->news_upload_time=$item->get_date('j F Y | g:i a');
                $rssfeed->save();
            }

        }
        //        //////////======================================================================







    }

    public function updateFeeds()
    {

        $businessfeed= \Feeds::make(['http://feeds.feedburner.com/entrepreneur/latest','http://rss.cnn
        .com/rss/money_news_international.rss','https://nairametrics.com/feed/','http://markets.businessinsider.com/rss/news','https://www.cnbcafrica.com/feed/'],100,true);

        $techfeed= \Feeds::make(['https://techcrunch.com/feed/','https://techmoran.com/feed/','https://www.techinasia.com/feed','https://techpoint.ng/feed/','http://disrupt-africa.com/feed/']);
        $newsfeed= \Feeds::make(['http://rss.cnn.com/rss/edition.rss','https://static01.nyt.com/services/xml/rss','https://www.naija.ng/rss/all.rss','https://www.vanguardngr.com/news/feed/','https://www.vanguardngr.com/news/feed/']);
        $sportfeed= \Feeds::make(['http://www.goal.com/en/feeds/news?fmt=rss&ICID=HP','https://www.completesportsnigeria.com/feed/','http://www.espnfc.com/rss','https://www.fourfourtwo.com/rss-settat/rss','https://www.thesportreview.com/feed/']);
        $entertenmainfeed= \Feeds::make(['https://www.lindaikejisblog.com/feed','http://www.gossipmill.com/feed/','http://misspetitenaijablog.com/feed/','https://www.kemifilani.com/feed','https://lailasnews.com/feed/']);


        $feed = \Feeds::make('https://www.lindaikejisblog.com/feed',100,true);

        $feed=$entertenmainfeed;

        $data = array(
            'title'     => $feed->get_title(),
            'permalink' => $feed->get_permalink(),
            'items'     => $feed->get_items(),
        );

        foreach ($data['items'] as $item)
        {
            print_r($item->get_content());
        }



    }

}
