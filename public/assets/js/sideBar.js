// Initialisation des icônes
lucide.createIcons();

// Toggle Sidebar Mobile
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
}

// Toggle Profile Menu
function toggleProfileMenu() {
    const menu = document.getElementById('profileMenu');
    const chevron = document.getElementById('profileChevron');
    
    menu.classList.toggle('hidden');
    chevron.classList.toggle('rotate-180');
}

// Fonction de déconnexion
function logout() {
    // Afficher un modal de confirmation
    if (confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
        // Rediriger vers la page de login
        window.location.href = 'login.html';
    }
}

// Fermer le menu profil si on clique ailleurs
document.addEventListener('click', function(event) {
    const menu = document.getElementById('profileMenu');
    const profileButton = event.target.closest('button');
    
    if (!profileButton && !menu.classList.contains('hidden')) {
        menu.classList.add('hidden');
        document.getElementById('profileChevron').classList.remove('rotate-180');
    }
});