@extends('layouts.main')

@section('title', 'Contact Us')

@section('content')

<link rel="stylesheet" href="/css/samistyles.css">

<main>

    <section id="contact-thumbnail">
        <img class="contact-thumbnail" src="/images/contact-thumbnail.png" alt="Contact Thumbnail">
    </section>

    <!-- Main Form -->
    <form id="signup-form" action="https://formspree.io/f/xkgljdwk" method="POST">
        <div id="form-container">

            <h3 id="form-title">Fill out the form below:</h3>
            <br>

            <p class="form-subtext">Name</p>
            <input class="field-design" type="text" name="name" placeholder="Name" required />

            <br><br><br>

            <p class="form-subtext">Email</p>
            <input class="field-design" type="text" name="email" placeholder="Email" required />

            <br><br><br>

            <p class="form-subtext">Message</p>
            <textarea class="message-design" name="message" placeholder="Message" rows="3" cols="50" required></textarea>

            <br><br><br>

            <input id="submit-button" type="submit" value="Submit" />

        </div>
    </form>

    <footer id="footer">
        <br><br>
    </footer>

</main>

@endsection