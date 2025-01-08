function toggleAddClientModal(event) {
    const modal = document.getElementById("addClientModal");
    modal.classList.toggle("hidden");

    const clikcedbutton = event.target.parentElement;
    if(clikcedbutton.classList.contains("edit_user")){
        // console.log(clikcedbutton);
        // console.log(clikcedbutton.closest("tr").querySelector(".full_name").textContent.trim());
        document.getElementById('full_name').value = clikcedbutton.closest("tr").querySelector(".full_name").textContent.trim();
        document.getElementById('email').value = clikcedbutton.closest("tr").querySelector(".email").textContent.trim();
        document.getElementById('full_name').value = clikcedbutton.closest("tr").querySelector(".full_name").textContent.trim();
        
    }

}

function submitAddClientForm() {
    const form = document.getElementById("addClientForm");
    if (form.checkValidity()) {
        // Traitement du formulaire ici
        alert("Client ajouté avec succès !");
        toggleAddClientModal();
    } else {
        form.reportValidity();
    }
}
