let nav_link = document.querySelectorAll("nav a");
let aside_link = document.querySelectorAll("aside a");
let url = document.location.href;

if (url.includes("uc=")) {
  uc = url.split("uc=")[1].split("&")[0];
} else {
  uc = "";
}
if (url.includes("action")) {
  action = url.split("action=")[1];
} else {
  action = "";
}
if (url.includes("categorie")) {
  categorie = url.split("categorie=")[1].split("&")[0];
} else {
  categorie = "";
}

switch (uc) {
  case "accueil":
    nav_link[0].classList.add("JS-active-link");
    break;
  case "visite":
    nav_link[1].classList.add("JS-active-link");
    if (categorie == "1") {
      aside_link[1].classList.add("JS-active-link");
    } else if (categorie == "2") {
      aside_link[0].classList.add("JS-active-link");
    }
    break;
  case "panier":
    nav_link[2].classList.add("JS-active-link");
    break;
  case "commander":
    if (action == "confirmerCommande") {
      nav_link[3].classList.add("JS-active-link");
    } else {
      nav_link[2].classList.add("JS-active-link");
    }
    break;
  case "compte":
    nav_link[3].classList.add("JS-active-link");
    break;
  case "connexion":
    nav_link[3].classList.add("JS-active-link");
    break;
  default:
    nav_link[0].classList.add("JS-active-link");
    break;
}
