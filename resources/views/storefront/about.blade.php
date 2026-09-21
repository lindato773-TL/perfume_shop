@extends('layouts.guest')
@section('title', 'About us · Flowers')
@section('content')
    <section class="about-hero">
        <div class="container"><span class="eyebrow">About Flowers</span>
            <h1 class="display-2">A quieter kind of fragrance house.</h1>
            <p class="lead">We believe scent can change the temperature of a room, the pace of a morning, and the way a
                memory returns.</p>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row g-5 align-items-start">
                <div class="col-lg-5"><span class="eyebrow">Our point of view</span>
                    <h2 class="display-5">Less noise. More feeling.</h2>
                </div>
                <div class="col-lg-6 ms-auto text-muted-rose about-copy">
                    <p>Flowers began with a simple idea: perfume should feel personal before it feels precious. Each
                        composition is built with a clear point of view, then left enough space for you to make it yours.
                    </p>
                    <p>We work in small batches, choose ingredients for their character, and design every detail to make the
                        daily ritual feel a little more considered.</p>
                    <div class="row g-4 mt-3">
                        <div class="col-6"><strong class="stat-number">01</strong><span>small-batch studio</span></div>
                        <div class="col-6"><strong class="stat-number">100%</strong><span>made to linger</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="principles">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4"><span class="principle-number">01</span>
                    <h3>Thoughtful formulas</h3>
                    <p>Balanced notes that meet skin softly and stay close.</p>
                </div>
                <div class="col-md-4"><span class="principle-number">02</span>
                    <h3>Beautiful restraint</h3>
                    <p>Objects and words with just enough room to breathe.</p>
                </div>
                <div class="col-md-4"><span class="principle-number">03</span>
                    <h3>Your signature</h3>
                    <p>Fragrance as an invitation, never an instruction.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
