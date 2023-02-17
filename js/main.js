function test() {
  foot();
  var zalog;
  var login;
  //document.getElementById("za-ni").innerHTML = "test";
  var cookies = document.cookie.split(";");
  for (var i = 0; i < cookies.length; i++) {
    var valueArray = cookies[i].split("=");
    if (valueArray[0] == " zalog") {
      zalog = valueArray[1];
    }
    if (valueArray[0] == " login") {
      login = valueArray[1];
    }
  }
  if (zalog) {
    document.getElementById("za-ni").innerHTML =
      '<li class="nav-item h5"><a class="nav-link text-light" href="adda.php"><img src="img/plus-circle.svg" alt="Ikonka dodawania artykułu" style="width:25px; margin-right:5px;">Dodaj Artykuł</a></li><li class="nav-item dropdown h5"><a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown1" data-bs-toggle="dropdown" role="button" aria-expanded="false"><img src="img/person-circle.svg" alt="Ikonka zalogowania" style="width:25px; margin-right:5px;">' +
      login +
      '</a><ul class="dropdown-menu"><li><a class="dropdown-item" onclick="wylog()">Wyloguj</a></li></ul></li>';
  }
}

function foot() {
  document.getElementById("s").innerHTML =
    '<footer class="bg-primary text-white pt-5 pb-4">\
    <div class="container text-center text-md-left">\
        <div class="row text-center text-md-left">\
            <div class="col-md-6 mx-auto mt-3">\
                <h5>LisekPL</h5>\
                <p>Fajny Lis coś tam sobie programuje, strony internetowy tworzy. Możesz wbić na YT link poniżej, wbij też na dc tam nowości o stronie a i pogadać luźno można. Jak chcesz to możesz też wiadomość formularzem tam po prawej wysłać ale na razie to nie działa. </p>\
                <dl class="social-footer2 row">\
                    <dt class="col-4"><a title="youtube" target="_blank" href="https://www.youtube.com/@lisekpolska"><img src="img/youtube.svg" alt="YouTube" width="60" height="60"></a></dt>\
                    <dt class="col-4"><a href="https://github.com/LisekPOLSKA" target="_blank" title="GitHub"><img alt="GitHub" width="60" height="60" src="img/github.svg"></a></dt>\
                    <dt class="col-4"><a title="Discord" target="_blank" href="https://discord.gg/BE7NFF48Y5"><img alt="Discord" width="60" height="60" src="img/discord.svg"></a></dt>\
                </dl>\
            </div>\
            <div class="col-md-6 mx-auto mt-3">\
                <h5><a class="text-white" href="index.php#contact">Kontakt</h5></a>\
                <article class="col-sm-12 mt-2 mb-2" id="contact">\
                <div class="card text-center  bg-info border-dark">\
                    <div class="card-header h4">\
                        Kontakt<span style="color:red;">Na razie nie działa</span>\
                    </div>\
                    <div class="card-body fs-4">\
                        <form method="POST" action="sendmail.php">\
                            <div class="row">\
                                <div class="col-md-12">\
                                    <div class="form-group">\
                                        <label for="name">Podaj imię</label>\
                                        <input type="text" id="name" class="form-control" name="name" required>\
                                    </div>\
                                </div>\
                            </div>\
                            <div class="row">\
                                <div class="col-md-12">\
                                    <div class="form-group">\
                                        <label for="tar">Cel Kontaktu</label>\
                                         <select name="tar" id="tar" class="form-select">\
                                            <option value="Zgłoś błąd" class="text-center">Zgłoś błąd</option>\
                                            <option value="Kontakt" class="text-center">Kontakt</option>\
                                            <option value="Inne" class="text-center">Inne</option>\
                                        </select>\
                                    </div>\
                                </div>\
                            </div>\
                            <div class="row">\
                                <div class="col">\
                                    <div class="form-group">\
                                        <label for="email">Twój email</label>\
                                        <input type="email" name="email" id="email" class="form-control" required>\
                                    </div>\
                                </div>\
                            </div>\
                            <div class="row">\
                                <div class="col">\
                                    <div class="form-group">\
                                        <label for="mess">Wiadomość</label>\
                                        <textarea type="text" name="mess" id="mess" class="form-control" required></textarea>\
                                    </div>\
                                </div>\
                            </div>\
                            <div class="row justify-content-center">\
                                <div class="form-check" style="width: auto;">\
                                   <input type="checkbox" id="check" name="check" class="form-check-input" required>\
                                   <label for="check" class="form-check-label"><a href="regulamin.html" target="_blank">Akceptuje regulamin</a></label>\
                                </div>\
                            </div>\
                            <div class="row">\
                                <div class="col">\
                                    <button class="btn btn-primary btn-lg" type="submit">Wyślij formularz</button>\
                                </div>\
                            </div>\
                        </form>\
                    </div>\
                </div>\
            </article>\
            </div>\
        </div>\
    </div>\
</footer>';
}
function wylog() {
  document.cookie = "login=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
  document.cookie = "id=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
  document.cookie = "email=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
  document.cookie = "reg_date=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
  document.cookie = "czwxy=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
  document.cookie = "zalog=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
  document.location = "index.php";
}
window.onload = test;
