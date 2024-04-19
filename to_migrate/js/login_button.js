function toggleFormEdit() {
  var form = document.getElementById("form3");
  var button = form.querySelector("input[type='submit']");

  if (form.getAttribute("data-editable") === "true") {
    // Si le formulaire est en mode édition, passer en mode visualisation
    console.log("Formulaire en mode visualisation");
    form.setAttribute("data-editable", "false");
    button.value = "Modifier";
    submitForm();
  } else {
    // Si le formulaire est en mode visualisation, passer en mode édition
    console.log("Formulaire en mode édition");
    form.setAttribute("data-editable", "true");
    button.value = "Valider";
    console.log("try changement value button")
    console.log(button.value)
  }

  // Activer/désactiver l'attribut "readonly" pour chaque champ de saisie
  console.log("Changement d'état readonly");
  var inputs = form.querySelectorAll("input");
  for (var i = 0; i < inputs.length; i++) {
    inputs[i].readOnly = !inputs[i].readOnly;
  }
}

function submitForm() {

  // Obtenez le formulaire par son ID
  var form = document.getElementById("form3");

  // Créez un nouvel élément input
  var input = document.createElement("input");

  // Définissez les attributs de l'élément input
  input.setAttribute("type", "hidden");
  input.setAttribute("name", "action");
  input.setAttribute("value", "modifier_profil");

  // Ajoutez l'élément input au formulaire
  form.appendChild(input);

  // Soumettre le formulaire
  form.submit();
}
