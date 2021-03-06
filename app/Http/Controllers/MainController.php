<?php

namespace emutoday\Http\Controllers;

use Illuminate\Http\Request;

use emutoday\Http\Requests;

use emutoday\Story;
use emutoday\Page;
use emutoday\Announcement;
use emutoday\Event;
use emutoday\Tweet;
use Carbon\Carbon;
use JavaScript;

class MainController extends Controller
{
    protected $pages;

    public function __construct(Page $page, Story $story, Announcement $announcement, Event $event)
    {
        $this->page = $page;
        $this->story = $story;
        $this->announcement = $announcement;
        $this->event = $event;


    }
        public function preview($stype, Story $story)
        {
            return 'need to recreate or reroute to correct preview page' . $stype . $story;
        }

    public function index()
    {
        $currentDateTimeStart = Carbon::now()->startOfDay();
        $currentDateTimeEnd = Carbon::now()->endOfDay();

        // $page = $this->page->where([
        //     ['start_date', '<=', $currentDateTime],
        //     ['end_date', '>=', $currentDateTime],
        // ])->first();
        $page = $this->page->where([
            ['is_ready', 1],
            ['is_archived', 0],
            ['start_date', '<=', $currentDateTimeStart],
            ['end_date', '>=',  $currentDateTimeEnd]
        ])->first();

        $currentStorysBasic = $this->story->where([
            ['is_approved', 1],
            ['is_archived', 0],
            ['start_date', '<=', $currentDateTimeStart],
            ['end_date', '>=', $currentDateTimeEnd]
            ])
            ->orderBy('start_date','desc')
            ->paginate(3);

        $currentAnnouncements = $this->announcement->where([
            ['is_approved', 1],
            ['is_archived', 0],
            ['start_date', '<=', $currentDateTimeStart],
            ['end_date', '>=', $currentDateTimeEnd]
        ])
        ->orderBy('priority','desc')
        ->orderBy('start_date','desc')
        ->paginate(3);

        $events = $this->event->where([
            ['is_approved', 1],
            ['priority', '>', 0],
            ['end_date', '>=', $currentDateTimeStart]
        ])
        ->orderBy('priority','desc')

        ->paginate(4);




        // $currentAnnouncements = $this->announcement->where('is_approved', 1)->orderBy('priority','desc')->paginate(3);
        $barImgs = collect();
        $storys = $page->storys()->get();

        foreach ($storys as $story) {
            if ($story->pivot->page_position === 0) {
                $heroImg = $story->storyImages()->where('image_type', 'front')->first();
            } else {
                $barImgs[$story->pivot->page_position] = $story->storyImages()->where('image_type', 'small')->first();
                // $barImgs->push( $story->storyImages()->where('image_type', 'imagesmall')->first() );
            }

        }
       //$events = $this->event->where(['start_date', '>=', $currentDateTime])->orderBy('start_date','desc')->get();
    //   $fakeDate = Carbon::now()->subYear();


        $storyImages = $page->storyImages();
      //  $tweets = Tweet::orderBy('created_at','desc')->paginate(4);
        $tweets = Tweet::where('approved',1)->orderBy('created_at','desc')->take(4)->get();

        $allStorysWithVideoTag = Story::whereHas('tags', function ($query) {
            $query->where('name', 'video');
        })->where([
            ['is_approved',1],
            ['story_type', 'external'],
            ['start_date', '>=', Carbon::now()->startOfDay()]
        ])
        ->with('storyImages')->get();

        if(count($allStorysWithVideoTag)> 0) {
            $currentStoryWithVideoTag = $allStorysWithVideoTag->first();
            $currentStoryImageWithVideoTag = $currentStoryWithVideoTag->storyImages()->first();
        } else {
            $currentStoryImageWithVideoTag = null;
        }

        JavaScript::put([
            'jsis' => 'hi',
            'cdnow' => Carbon::now(),
            'cdstart' => Carbon::now()->subDays(7),
            'cdend' => Carbon::now()->addDays(7),
            'currentPage' => $page
        ]);

        return view('public.hub', compact('page', 'storyImages', 'heroImg', 'barImgs', 'currentStorysBasic', 'currentAnnouncements', 'events','tweets','currentStoryImageWithVideoTag'));

    }

    public function main($story_type, $id)
    {
        $story = $this->story->findOrFail($id);
        $mainStoryImage =  $story->storyImages()->where('image_type', 'story')->first();

        $sideStorysFeatured = $this->story->where([
            ['story_type', 'story'],
            ['id', '<>', $id],
            ['is_approved', 1],
            ])->orderBy('created_at', 'desc')->take(3)->get();

        // Remove All reference to Student until Further notice
        $sideStorysStudent = null;
        // $sideStorysStudent = $this->story->where([
        //     ['story_type', 'student'],
        //     ['id', '<>', $id],
        //     ['is_approved', 1],
        // ])->orderBy('created_at', 'desc')->take(3)->get();

        JavaScript::put([
            'jsis' => 'hi',
            'cdnow' => Carbon::now(),
            'cdstart' => Carbon::now()->subDays(7),
            'cdend' => Carbon::now()->addDays(7),
            'cstory' => $story
        ]);
        return view('public.story.story', compact('story','mainStoryImage', 'sideStorysFeatured', 'sideStorysStudent'));

    }
}
