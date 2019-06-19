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
                <p>You have no content, <a href="/content/create" class="">add new content here.</a></p>

            @else

                <h2>My content</h2>
        </div>


        <div class="row my-5">
            <div class="col-2 my-5">

                <h4>Filter content by:</h4>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="unscheduled"
                           onclick="window.location.href='?status=unscheduled'">
                    <label class="form-check-label" for="unscheduled">
                        Unscheduled
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="scheduled"
                           onclick="window.location.href='?status=scheduled'">
                    <label class="form-check-label" for="scheduled">
                        Scheduled
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="published"
                           onchange="window.location.href='?status=published'">
                    <label class="form-check-label" for="published">
                        Published
                    </label>
                </div>

                <a href="/content/create" class="btn btn-primary mt-5">Add new content</a>

            </div>
            <div id="gallery" class="col-md gallery content-gallery mt-2  p-0">


                @foreach($contents as $content)

                    <div class="content float-left m-1 card ">
                        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"
                                class="m-0 ">
                            <div class="image-bg ">
                                <img href="/storage/{{$content->image}}" data-caption="{{$content->description}}"
                                     data-width="1200" data-height="900" itemprop="contentUrl" id="photoswipe-img">

                                <a href="/content/{{$content->id}}/edit" class="btn btn-light"
                                   id="edit-btn">Edit</a>
                                <a href="#" class="btn btn-light" id="view-btn">View</a>
                                <img src="/storage/{{$content->image}}" itemprop="thumbnail" alt="Image description"
                                     class="gallery-img">

                            </div>

                        </figure>
                        <div class="status m-1">
                            @if($content->status === 'Published')
                                <i class="fa fa-calendar-check-o content-icon"></i>
                            @elseif($content->status === 'Scheduled')
                                <i class="fa fa-calendar content-icon"></i>
                            @else
                                <i class="fa fa-calendar-minus-o content-icon"></i>
                            @endif
                            <p> {{$content->status}}</p>
                        </div>
                    </div>

                @endforeach


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
        </div>
        @endif
    </div>

    {{ $contents->links() }}


@endsection
