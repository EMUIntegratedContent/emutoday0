@extends('layouts.masters')
@section('content')
  <div id="content-area">
    <div id="news-bar">
      <div class="row">
        <h3 class="news-caps manageleftpadding">Featured</h3>
        <div class="large-7 medium-12 small-12 columns manageleftpadding">
          <img src="images/featured.jpg" alt="featured image">
        </div>
        <div id="featured-text" class="large-5 medium-12 small-12 columns">
            <h3>storyImages</h3>
          @foreach ($storyImages as $storyImage)
            <p>
              {{$storyImage->image_type}}
            </p>
            <p>
              {{$storyImage->filename}}
            </p>
          @endforeach
          <h3>Tionsequis que pel mo dem eatur</h3>
          <p>Oles as as necatur, sitae. Temped qui doloreratas unduci repudam restio tet dundia num ernam quia voles et unt, comnihiliqui dit perspis se laut a in escia volo beatio venis dolest, qui dolentor mil maiore, veliquod mo voluptae eos dis sapernatur minctem reiuria di nonectas pel il idunt eum nonet quae nos nonesti</p>
          <p class="button-group"><a href="" class="button">Read More</a></p>
        </div>
      </div>
    </div>
    <div id="four-stories-bar">
      <div id="news-title-bar" class="row">
        <div class="large-12 medium-12 small-12 columns manageleftpadding">
          <h5 class="subhead-title">Featured News Stories</h5>
        </div>
      </div>
      <div class="row small-up-1 medium-up-2 large-up-4">
        <div class="column">
          <img class="topic-image" src="images/front-boxes/profiles.png" alt="story image">
          <div class="stories-content">
            <div class="stories-text-content" data-equalizer-watch="" style="height: 66px;">
              <p>On the Run: EMU student overcome obstacles in life, in school &amp; during marathons</p>
            </div>
            <p class="button-group">
            <a href="news/story.html" class="button">Read more<i class="fi-play"></i></a>
            </p>
          </div>
        </div>
        <div class="column">
          <img class="topic-image" src="images/front-boxes/schoenhals.png" alt="story image">
              <div class="stories-content">
                <div class="stories-text-content" data-equalizer-watch="" style="height: 66px;">
                  <p>Professor Joel Schoenhals named Peoples Republic of China’s first Foreign Expert in field of music</p>
                </div>
                <p class="button-group">
                  <a href="#" class="button">More Info <i class="fi-play"></i></a>
                </p>
              </div>
        </div>
        <div class="column">
          <img class="topic-image" src="images/front-boxes/bridges.png" alt="story image">
           <div class="stories-content">
             <div class="stories-text-content" data-equalizer-watch="" style="height: 66px;">
             <p>Noted EMU director Wallace Bridges named Fulbright Scholar</p>
           </div>
           <p class="button-group">
             <a href="#" class="button">Read more<i class="fi-play"></i></a>
           </p>
           </div>
        </div>
        <div class="column">
          <img class="topic-image" src="images/front-boxes/martusewicz.png" alt="story image">
          <div class="stories-content">
            <div class="stories-text-content" data-equalizer-watch="" style="height: 66px;">
              <p>Professor Rebecca Martusewicz receives Fulbright Award to teach, research Ecojustice in Finland</p>
            </div>
            <p class="button-group"><a href="#" class="button">More Info <i class="fi-play"></i></a>
            </p>
          </div>
        </div>
      </div>
</div>
        <div id="news-headline-bar">
       <div class="row">
            <div class="large-9 medium-8 small-12 columns manageleftpadding">
                <div class="row">
                    <div class="large-6 medium-6 small-6 columns">
                    <h5 class="subhead-title">News Headlines</h5>
                    </div>
                    <div class="large-6 medium-6 small-6 columns">
                    <h6 class="subhead-title goright"><a href="news/index.html">See All Headlines</a></h6>
                    </div>
                </div>
                <div id="newshub-headlines-front">
                   <ul>
                       <li><a href="news/story.html">The imaginary test story title goes here</a></li>
                       <li><a href="news/story-calendar.html">Eastern Michigan University faculty to host Education Summit</a></li>

                       <li><a href="">President Martin's farewell message to Eastern Michigan University community</a></li>
                       <li><a href="">EMU Office of International Students to change name</a></li>
                       <li><a href="">Eastern Michigan University to become tobacco-free July 1</a></li>
                       <li><a href="">EMU’s Inkstains Writing Camps to help young would-be authors experience the power of words, story-telling</a></li>
                    </ul>
                </div>
            </div>
           <div class="large-3 medium-3 small-12 columns">
                <div class="featured-content-block">
                    <h6 class="headline-block">Featured video</h6>
                    <a href="https://www.youtube.com/watch?v=v-3BGoQtOsY" target="blank"><img src="images/lunchbylake.png" alt="featured video"></a>
                    <p><a href="https://www.youtube.com/watch?v=v-3BGoQtOsY" target="blank">Out of the Park Lunch by the Lake All-Campus Picnic</a></p>
               </div>
           </div>
       </div>
     </div>
     <div id="active-bar">
       <div id="containingbox" class="row">
           <!--Calendar-->
            <div id="calendar-info" class="large-4 medium-6 small-12 columns manageleftpadding">
                <div class="row">
                    <div class="large-12 medium-12 small-12 columns">
                    <h5 class="subhead-title">Events Calendar</h5>
                    </div>
                </div>
                <div id="newshub-calendar-front">
                   <ul class="calendar-event-group">
                       <li class="row calendar-unit">
                            <div class="large-2 medium-2 small-2 columns nopadding date-box">
                                <p>Sep</p>
                                <p>9</p>
                            </div>
                           <div class="large-10 medium-10 small-10 columns">
                            <p class="datecontent-box"><a href="">WELCOME! President’s Picnic and McKenny Hall Open House</a></p>
                           </div>
                       </li>
                       <li class="row calendar-unit">
                            <div class="large-2 medium-2 small-2 columns nopadding date-box">
                                <p>Sep</p>
                                <p>10</p>
                            </div>
                           <div class="large-10 medium-10 small-10 columns">
                            <p class="datecontent-box"><a href="">Military and Veteran Student Welcome Back Cookout Fall 2015</a></p>
                           </div>
                       </li>
                       <li class="row calendar-unit">
                            <div class="large-2 medium-2 small-2 columns nopadding date-box">
                                <p>Sep</p>
                                <p>20</p>
                            </div>
                           <div class="large-10 medium-10 small-10 columns">
                            <p class="datecontent-box"><a href="">16th Annual EMU Oozeball Tournament </a></p>
                           </div>
                       </li>
                       <li class="row calendar-unit">
                            <div class="large-2 medium-2 small-2 columns nopadding date-box">
                                <p>Sep</p>
                                <p>26</p>
                            </div>
                           <div class="large-10 medium-10 small-10 columns">
                            <p class="datecontent-box"><a href="">5th Annual Lyla Spelbring Lectureship</a></p>
                           </div>
                       </li>
                    </ul>
                    <p><a href="">More Events</a></p>
                    </div>
                </div>


           <!--Twitter-->
           <div id="twitter-info" class="large-5 medium-6 small-12 columns">
               <div class="row">
                    <div class="large-12 medium-12 small-12 columns">
                    <h5 class="subhead-title">Twitter</h5>
                    </div>
                </div>
                <div class="twitter-feed">
                  <ul class="twitter-content">
                       <li><a href="">EMU_Swoop</a> .@kimschatzel, good luck on your first day as interim president! </li>
                       <li><a href="">EMU_Swoop RT</a> @emusg: RT to say Thank you President Martin for all she's done for EMU over the past 7 years. #goodluck #truEMU #emu #thanks @EMU_Swoop </li>
                       <li><a href="">EMU_Swoop RT</a> @EMUAlumni: Alumni Legacy Scholarship Winner #1 - Congratulations Brielle Bashore! #TRUEMU http://t.co/wI9m7QoWOH http://t.co/pCzbjwjTha</li>
                    </ul>
                    <div class="twitterlink">
                        <p><a href="">See all EMU twitter Feeds</a></p>
                        <ul class="social-icons">
                        <li>
                            <a href="https://www.facebook.com/Eastern.Michigan.University">
                                <img alt="Facebook" src="{{'assets/imgs/icons/facebook_icon23x23.png'}}">
                            </a>
                        </li>
                        <li>
                            <a href="http://www.emich.edu/twitter/">
                                <img alt="Twitter" src="{{'assets/imgs/icons/twitter_icon23x23.png'}}">
                            </a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/user/emichigan08">
                                <img alt="YouTube" src="{{'assets/imgs/icons/youtube_icon23x23.png'}}">
                            </a>
                        </li>
                        <li>
                            <a href="https://instagram.com/easternmichigan/">
                                <img alt="Instagram" src="{{'assets/imgs/icons/instagram_icon23x23.png'}}">
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/edu/school?id=18604">
                                <img alt="Linked-In" src="{{'assets/imgs/icons/linked-in_icon23x23.png'}}">
                            </a>
                        </li>
                      </ul>
                    </div>
               </div>
           </div>



           <!--Working at EMU-->
           <div class="large-3 medium-12 small-12 columns">
             <div class="featured-content-block">
               <h6 class="headline-block">Working @ EMU</h6>
               <ul class="feature-list">
                 <li><a href="">Training for something that would interest the campus community</a></li>
                 <li><a href="">An announcement from HR that is interesting to people employed at EMU</a></li>
                 <li><a href="">Get Duo 2-Factor Authentication To Help Combat Phishing Attacks. Sign up today </a></li>
                 <!-- <li><a href="">Health care sign up in going on now. For more information contact Joan Johnson.</a></li> -->
               </ul>
             </div>
           </div>
         </div>
       </div>
  </div>
@endsection
@section('footer')
  @parent
  <div class="row">
    <h5>Footer</h5>
  </div>
@endsection
