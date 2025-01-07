function toggleAddClientModal() {
    const modal = document.getElementById("addClientModal");
    modal.classList.toggle("hidden");
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