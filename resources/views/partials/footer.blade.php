<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6 footer-contact">
            <h3>Esplai el Pas</h3>
            <p>
              Carrer Francesc Macià<br>
              08389 Palafolls<br>
              Barcelona <br><br>
              <strong>Telèfon:</strong> 666 66 66 66<br>
              <strong>Correu electrònic:</strong> esplaielpas@gmail.com<br>
            </p>
          </div>
          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Enllaços</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('home') }}">Inici</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('nosaltres') }}">Nosaltres</a></li>
              {{-- <li><i class="bx bx-chevron-right"></i> <a href="blog.html">Blog</a></li> --}}
              @auth
                <li><i class="bx bx-chevron-right"></i> <a href="{{ route('excursions.index') }}">Excursions</a></li>
              @endauth
              @guest
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('login') }}">Iniciar Sessió</a></li>
              @endguest
              
            </ul>
          </div>
          <div class="col-lg-6 col-md-6 ps-5">
            <div class="z-depth-1-half map-container">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d413.46269967487245!2d2.748621832249331!3d41.6685666000101!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12bb3db80405060f%3A0x2f4124b4454747d6!2sCentre%20Parroquial!5e0!3m2!1sca!2ses!4v1650525039847!5m2!1sca!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>Esplai el Pas</span></strong>. All Rights Reserved
        </div>
      </div>
      <div class="social-links text-center text-md-end pt-3 pt-md-0" id="xarxes">
        <a href="https://www.instagram.com/esplaielpas/" class="instagram" target="_blank"><i class="bx bxl-instagram"></i></a>
        <a href="https://twitter.com/esplaielpas" class="twitter" target="_blank"><i class="bx bxl-twitter"></i></a>
        <a href="https://www.facebook.com/esplai.elpas" class="facebook" target="_blank"><i class="bx bxl-facebook"></i></a>
        <a href="https://www.youtube.com/channel/UCVPamxz4XNDkApcESZUlVzw" class="youtube" target="_blank"><i class="bi bi-youtube"></i></a>
      </div>
    </div>
  </footer>
  <!-- End Footer -->