@extends('layouts.app')
@section('title', 'Contact | ' . config('app.name'))
@section('header')
    <section class="header-section text-center"
        style="background-image: url('/images/webp/contact.webp');background-position: center;">
    </section>
@endsection

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="col-12 d-flex align-items-stretch p-3">
                <div class="card shadow-sm w-100 rounded-main">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-2 p-3 text-lg-center">
                                <img src="{{ asset('images/webp/pin.webp') }}" alt="Pin" height="38">
                            </div>
                            <div class="col-10">
                                <h5>Location</h5>
                                <a href="{{ config('app.location_to_go') }}" class="link-primary">
                                    {{ config('app.location') }}
                                    <br>
                                    <span lang="ar">
                                        {{ config('app.location_ar') }}
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12 d-flex align-items-stretch  p-3">
                <div class="card shadow-sm w-100 rounded-main">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-2 p-3 text-lg-center">
                                <img src="{{ asset('images/webp/phone-call.webp') }}" alt="Phone" height="38">
                            </div>
                            <div class="col-10">
                                <h5>Call Us</h5>
                                <a href="tel:{{ config('app.phone_to_call') }}" class="link-primary">
                                    {{ config('app.phone') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12 d-flex align-items-stretch  p-3">
                <div class="card shadow-sm w-100 rounded-main">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-2 p-3 text-lg-center">
                                <img src="{{ asset('images/webp/letter.webp') }}" alt="letter" height="38">
                            </div>
                            <div class="col-10">
                                <h5>Email</h5>
                                <a href="mailto:{{ config('app.email') }}" class="link-primary">
                                    {{ config('app.email') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <img src="{{ asset('images/webp/the_bruvs.webp') }}" alt="SpecialBites" class="w-100 rounded-main shadow-sm">
        </div>
    </div>

    <div class="mb-3">
        <iframe class="shadow-sm rounded-main"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3309.317085944096!2d36.11959791553844!3d33.95868863010124!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1518a540727dafcf%3A0xfb8bf696ae91090d!2sTHE%20BRUVS!5e0!3m2!1sen!2sby!4v1650650387517!5m2!1sen!2sby"
            width="100%" height="500" frameborder="0" allowfullscreen="" loading="lazy"></iframe>
    </div>

    <div class="row mb-3">
        <h3 class="text-center mb-3 mt-3">Contact Us</h3>
        <contact-form-component></contact-form-component>
    </div>


@endsection
