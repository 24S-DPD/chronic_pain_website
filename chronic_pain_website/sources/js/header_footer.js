'use strict'
var header = `
    <h1><a href="accueil.html">Project CAL-CP</a></h1>
      <nav>
        <ul>
          <li><a href="CALCP.html">What is CAL-CP?</a></li>
          <li><a href="Group.html">About us</a></li>
          <li><a href="tarif.html">Tarif</a></li>
          <li><a href="autreidée.html">...</a></li>
        </ul>
      </nav>
      <a href="login.html" class="button">Login</a>
   `;
document.getElementById('header').innerHTML = header;


var footer = `
    <nav>
        <ul>
            <li>
                <h2>Quick Links</h2>
                <ul class="souslist">
                    <li><a href="CALCP.html">What is CAL-CP?</a></li>
                    <li><a href="Group.html">About us</a></li>
                    <li><a href="tarif.html">Tarif</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </li>
            <li>
                <h2>Contact Us</h2>
                <p>Email: info@calcp.com</p>
                <p>Phone: +123 456 789</p>
            </li>
            <li>
                <h2>Follow Us</h2>
                <ul class="souslist">
                  <li><a href="#"><img src="sources/icons/facebook.png" alt="Facebook"></a></li>
                  <li><a href="#"><img src="sources/icons/twitter.png" alt="Twitter"></a></li>
                  <li><a href="#"><img src="sources/icons/linkedin.png" alt="LinkedIn"></a></li>
                </ul>
            </li>
        </ul>
   `;
document.getElementById('footer').innerHTML = footer;



