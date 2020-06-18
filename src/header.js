function createHeader() {
	var headerDiv = document.getElementById("header");
	headerDiv.innerHTML = "<a href='webshop.html'><div class='header-logo'><img src='kuhles logo.jpg' alt='logo' height='40px'></img></div></a><div class='links-wrapper'><a href='anmeldung.html'><div class='header-item'><p>Login</p></div></a><div class='header-item dropdown'><div class='header-item'>Allgemeines</div><div class='dropdown-content'><a href='news.html'><div>News</div></a><a href='faq.html'><div>FaQ</div></a><a href='about.html'><div>Über uns</div></a><a href='impressum.html'><div>Impressum</div></a></div></div><a href='shop.php'><div class='header-item'><p>Produkte</p></div></a><a href='print.php'><div class='header-item'><p>Ausdruck</p></div></a></div>";
}
createHeader();