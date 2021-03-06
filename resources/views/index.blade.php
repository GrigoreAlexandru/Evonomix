@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif


        <div class="row justify-content-center my-5">
            @if($contents->isEmpty())
                <p>No content here yet.</p>
            @else

                <h2>All content</h2>
        </div>

        <div class="row pt-5">
            <div id="gallery" class="gallery mx-5 mt-2 text-center">


                @foreach($contents as $content)

                    <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"
                            class="content content-welcome m-2 thumbnail">

                        <a href="/storage/{{$content->image}}" data-caption="{{$content->description}}"
                           data-width="1200" data-height="900" itemprop="contentUrl" id="photoswipe-img"></a>

                        <img src="/storage/{{$content->image}}" itemprop="thumbnail"
                             alt="Image description" class="gallery-img click-event">

                    </figure>

                @endforeach

            </div>
        </div>
        <!-- Some spacing 😉 -->
        <div class="spacer"></div>


        <!-- Root element of PhotoSwipe. Must have class pswp. -->
        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
            <!-- Background of PhotoSwipe.
                     It's a separate element as animating opacity is faster than rgba(). -->
            <div class="pswp__bg"></div>
            <!-- Slides wrapper with overflow:hidden. -->
            <div class="pswp__scroll-wrap">
                <!-- Container that holds slides.
                          PhotoSwipe keeps only 3 of them in the DOM to save memory.
                          Don't modify these 3 pswp__item elements, data is added later on. -->
                <div class="pswp__container">
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                </div>
                <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                <div class="pswp__ui pswp__ui--hidden">
                    <div class="pswp__top-bar">
                        <!--  Controls are self-explanatory. Order can be changed. -->
                        <div class="pswp__counter"></div>
                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                        <button class="pswp__button pswp__button--share" title="Share"></button>
                        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                        <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
                        <!-- element will get class pswp__preloader--active when preloader is running -->
                        <div class="pswp__preloader">
                            <div class="pswp__preloader__icn">
                                <div class="pswp__preloader__cut">
                                    <div class="pswp__preloader__donut"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                        <div class="pswp__share-tooltip"></div>
                    </div>
                    <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                    </button>
                    <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                    </button>
                    <div class="pswp__caption">
                        <div class="pswp__caption__center"></div>
                    </div>
                </div>

            </div>
        </div>
        @endif
    </div>
    {{ $contents->links() }}
@endsection
