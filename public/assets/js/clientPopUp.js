function toggleAddClientModal(event) {
    const modal = document.getElementById("addClientModal");
    modal.classList.toggle("hidden");

    const clikcedbutton = event.target.parentElement;
    if(clikcedbutton.classList.contains("edit_user")){
        
        document.getElementById('add_user_btn').name = "update_user_btn";
        document.getElementById('full_name').value = clikcedbutton.closest("tr").querySelector(".full_name").textContent.trim();
        document.getElementById('email').value = clikcedbutton.closest("tr").querySelector(".email").textContent.trim();
        document.getElementById('role').value = clikcedbutton.getAttribute("data-role");
        document.getElementById('user_id_input').value = clikcedbutton.getAttribute("data-user-id");
        document.getElementById('addClientForm').setAttribute("action", "/admin/updateUser");

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
