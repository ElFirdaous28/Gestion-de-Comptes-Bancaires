document.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();
    const toggleButton = document.getElementById('toggleSidebar');
    const toggleButtonDesktop = document.getElementById('toggleSidebarDesktop');
    const sidebar = document.getElementById('sidebar');

    toggleButton.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
    });

    toggleButtonDesktop.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
    });
});

// Toggle Profile Menu
function toggleProfileMenu() {
    const menu = document.getElementById('profileMenu');
    const chevron = document.getElementById('profileChevron');
    
    menu.classList.toggle('hidden');
    chevron.classList.toggle('rotate-180');
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