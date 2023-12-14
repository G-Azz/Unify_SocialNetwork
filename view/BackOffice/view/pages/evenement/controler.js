const form = document.getElementById("Add_Form");
const nameInput = document.getElementById("name");
const typeInput = document.getElementById("type");
const descriptionInput = document.getElementById("description");

form.addEventListener("change", function (event) {
  event.preventDefault();
  validertitre();
  validerdescriptions();
});

function validertitre() {
  const nomValeur = nameInput.value;
  const nomRegex = /^[A-Za-z]+$/;
  const erreurNom = document.getElementById("erreurName");

  if (!nomValeur.match(nomRegex)) {
    erreurNom.innerHTML = "Veuillez entrer un titre valide (lettres uniquement)";
  } else {
    erreurNom.innerHTML = "<span style='color:green'> Correct </span>";
  }
}
function validerdescriptions() {
    const prenomValeur = descriptionInput.value;
    const prenomRegex = /^[A-Za-z]+$/;
    const erreurPrenom = document.getElementById("erreurdescriptions");
  
    if (!prenomValeur.match(prenomRegex)) {
      erreurPrenom.innerHTML = "Veuillez entrer une description valide (lettres uniquement )";
    } else {
      erreurPrenom.innerHTML = "<span style='color:green'> Correct </span>";
    }
  }