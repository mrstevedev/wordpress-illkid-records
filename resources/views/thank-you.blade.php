{{--
  Template Name: Thank You Template
--}}

@php
$email = $_GET['signup'];
$to = $email;
$subject = 'Thank you for subscribing';
$message = 'This is a the template message';
$headers = 'From: '. $email . "\r\n" .
    'Reply-To: ' . $email . "\r\n";
wp_mail( $to, $subject, $message, $headers );

@endphp

@extends('layouts.app')

@section('content')
    @while(have_posts()) @php the_post() @endphp
        @include('partials.page-header')
        @include('partials.content-page')
    @endwhile
@endsection