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
        //dd(Categories::where('name','Entertainment')->first()->id);
        $feed = \Feeds::make('https://www.lindaikejisblog.com/feed',10,true);
       // $feed = \Feeds::make('http://www.gossipmill.com/feed/',10,true);

        $data = array(
            'title'     => $feed->get_title(),
            'permalink' => $feed->get_permalink(),
            'items'     => $feed->get_items(),
        );
        foreach ($data['items'] as $item)
        {


            print_r($item->get_content());

            $rssfeed=new Rssfeed;


            $rssfeed->categories_id= Categories::where('name','Entertainment')->first()->id;
            $rssfeed->title=$item->get_title();
            $rssfeed->title_url= $item->get_permalink();
            $rssfeed->description=$item->get_content();
            $rssfeed->news_upload_time=$item->get_date('j F Y | g:i a');

            $rssfeed->save();



        }








    }

}
