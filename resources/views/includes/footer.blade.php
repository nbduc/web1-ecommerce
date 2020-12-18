<div class="footer">
    <footer class="footer__site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <h3>Quick links</h3>
                    <ul>
                        <li><a href="#">Search</a></li>
                        <li><a href="#">About us</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h3>Get in touch</h3>
                    <p>Sign up to stay in the loop. Receive updates, access to exclusive deals, and more.</p>
                </div>
                <div class="col-md-4">
                    <h3>Newsletter</h3>
                    <div class="form-vertical">
                        <form method="post" action="/contact" id="contact_form" accept-charset="UTF-8" class="contact-form">
                            <input type="email" value="" placeholder="Email Address" name="contact-email" id="Email" class="form-control" aria-label="Email Address" autocorrect="off" autocapitalize="off">
                            <button type="submit" name="commit" id="subscribe">Sign Up</button>
                        </form>
                      </div>
                </div>
            </div>
            <hr>
            <ul class="footer__legal-links">
                <li>
                  © 2020 <a href="{{ url('/') }}" title="">{{ config('app.name') }}</a>
                </li>
                <li>
                  E-commerce by <a target="_blank" rel="nofollow" href="{{ url('/') }}">Nhóm làm đồ án</a>
                </li>
            </ul>
        </div>
    </footer>
</div>