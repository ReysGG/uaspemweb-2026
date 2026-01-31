{{-- 1. Bilang ke Blade: "Pakai layout itu" --}}
@extends('layouts.layout')

{{-- 2. Bilang ke Blade: "Isi bagian 'content' dengan ini" --}}
@section('content')

  @include('partials.hero')

  @include('partials.featured-services')

  @include('partials.about')

  @include('partials.services')

  @include('partials.cta')

  @include('partials.features')

  @include('partials.pricing')

  @include('partials.testimonials')

  @include('partials.faq')

@endsection
