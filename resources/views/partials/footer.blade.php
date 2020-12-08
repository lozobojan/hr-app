<footer>
    <div class="container footer text-center">
        <div class="footer-top" data-aos="flip-left" data-aos-duration="1000" data-aos-once="true">
            <a href="{{ url('/') }}">
                <img src=" {{ asset('img/footer/logo-white.svg') }}" alt="Logo" class="footer-logo">
            </a>
            <a href="https://maps.google.com/?q={{ $contact->address }}" class="contact-info address" target="_blank"
                rel="noopener">
                {{ $contact->address }}
            </a>
            <a href="tel:{{ $contact->number }}" class="contact-info phone">
                {{ $contact->number }}
            </a>
            <a href="mailto:{{ $contact->email }}" class="contact-info email">
                {{ $contact->email }}
            </a>
        </div>
        <div class="social-networks" data-aos="flip-left" data-aos-duration="1000" data-aos-once="true">
            <a href="{{ $social->facebook_link }}" target="_blank" rel="noopener" aria-label="Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="{{ $social->twitter_link }}" target="_blank" rel="noopener" aria-label="Twitter">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="{{ $social->instagram_link }}" target="_blank" rel="noopener" aria-label="Instagram">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="{{ $social->youtube_link }}" target="_blank" rel="noopener" aria-label="Youtube">
                <i class="fab fa-youtube"></i>
            </a>
        </div>
        <div data-aos="flip-left" data-aos-duration="1000" data-aos-once="true">
            <div class="border-blue"></div>
            <p class="footer-about">
                {{ __("This website has been produced in the frame of the project 'Dealing with Ethics and Fake News' with the financial support of the European Union. The information contained does not necessarily reflect the position or opinion of the European Union.") }}
            </p>
            <img src="{{ $footer->image }}" alt="European  Union" class="eu-logo">
        </div>
    </div>
</footer>