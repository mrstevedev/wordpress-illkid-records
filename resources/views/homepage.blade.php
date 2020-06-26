{{--
  Template Name: Homepage Template
--}}

@extends('layouts.app')

@section('content')
    {{-- <section class="section-one" 
        data-aos="fade-in" 
        data-aos-delay="10"
        data-aos-duration="10"
        data-aos-easing="ease-in-out"
        data-aos-mirror="true"
        data-aos-once="false"
        data-aos-anchor-placement="top-center"
    >
        <div class="section-end-more">
            <h3>Vinyl Store</h3>
        </div>
    </section> --}}
    @while(have_posts()) @php the_post() @endphp
        @include('partials.page-header')
        @include('partials.content-page')
    @endwhile
@endsection
    <section class="section-two">

    </section>

