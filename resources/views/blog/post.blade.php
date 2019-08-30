@extends('blog.layouts.app')

@section('page-header')
    <header class="masthead" style="background-image: url('{{$post->page_image}}')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="post-heading">
                        <h1>{{ $post->title }}</h1>
                        <h2 class="subheading">{{ $post->subtitle }}</h2>
                        <span class="meta">
                            Posted on {{ $post->published_at->format('Y-m-d') }}
                            @if ($post->tags->count())
                                in
                                {!! join(', ', $tags) !!}
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                {{-- 文章详情 --}}
                <article>
                    {!! $post->content_html !!}
                </article>

                <hr>
                <!--
                {{-- 上一篇、下一篇导航 --}}
                <div class="clearfix">
                    {{-- Reverse direction --}}

                    <a class="btn btn-primary float-left" href="">
                        ←
                        Previous Post
                    </a>


                    <a class="btn btn-primary float-right" href="">
                        Next Post
                        →
                    </a>

                </div>
                -->
            </div>
        </div>
    </div>
@stop