<div class="w-64 bg-white shadow-lg hidden md:block" id="sidebar">
    <div class="p-6">
        <h1 class="text-2xl font-bold text-blue-600">Ma Banque</h1>
    </div>
    <nav class="mt-6">
        <a href="/client/dashboard"
            class="flex items-center w-full p-4 space-x-3 bg-blue-50 text-blue-600 border-r-4 border-blue-600">
            <i data-lucide="wallet"></i>
            <span>Tableau de bord</span>
        </a>
        <a href="/client/comptes" class="flex items-center w-full p-4 space-x-3 text-gray-600 hover:bg-gray-50">
            <i data-lucide="credit-card"></i>
            <span>Mes comptes</span>
        </a>
        <a href="/client/virement" class="flex items-center w-full p-4 space-x-3 text-gray-600 hover:bg-gray-50">
            <i data-lucide="send"></i>
            <span>Virements</span>
        </a>
        <a href="/client/benificier" class="flex items-center w-full p-4 space-x-3 text-gray-600 hover:bg-gray-50">
            <i data-lucide="users"></i>
            <span>Bénéficiaires</span>
        </a>
        <a href="/client/historique" class="flex items-center w-full p-4 space-x-3 text-gray-600 hover:bg-gray-50">
            <i data-lucide="history"></i>
            <span>Historique</span>
        </a>
        <a href="/client/profil" class="flex items-center w-full p-4 space-x-3 text-gray-600 hover:bg-gray-50">
            <i data-lucide="user"></i>
            <span>Profil</span>
        </a>
    </nav>
</div>

<!-- Toggle Button for Mobile -->
<button class="fixed top-0 left-0 md:hidden p-4 text-gray-600 hover:text-blue-600 " id="toggleSidebar">
    <i data-lucide="menu" class="w-6 h-6"></i>
</button>

<!-- Add this button for desktop view
<button class="hidden md:block p-4 text-gray-600 hover:text-blue-600" id="toggleSidebarDesktop">
    <i data-lucide="menu" class="w-6 h-6"></i>
</button> -->