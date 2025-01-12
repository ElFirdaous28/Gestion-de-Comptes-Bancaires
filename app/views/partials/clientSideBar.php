<div class="sticky h-screen w-64 bg-white shadow-lg hidden md:block" id="sidebar">
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
        <a href="/client/benificiers" class="flex items-center w-full p-4 space-x-3 text-gray-600 hover:bg-gray-50">
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
    <!-- Profil Admin avec Déconnexion -->
    <div class="p-6 absolute bottom-0">
        <div class="relative">
            <button
                onclick="toggleProfileMenu()"
                class="flex items-center w-full text-gray-600 hover:bg-blue-600 hover:text-white rounded-lg p-2">
                <img src="/api/placeholder/32/32" alt="Admin"
                    class="w-8 h-8 rounded-full">
                <div class="ml-3 flex-grow">
                    <p class="text-sm font-medium"><?= htmlspecialchars($_SESSION["user_loged_in_name"])?></p>
                    <p
                        class="text-xs"><?= htmlspecialchars($_SESSION["user_loged_in_email"])?></p>
                </div>
                <i data-lucide="chevron-up"
                    class="w-5 h-5 transform transition-transform duration-200"
                    id="profileChevron"></i>
            </button>

            <!-- Menu Profil -->
            <div id="profileMenu"
                class="absolute bottom-full left-0 w-full mb-2 bg-gray-50 rounded-lg shadow-lg hidden">
                <a href="/admin/profil"
                    class="block px-4 py-2 text-sm text-gray-600 hover:bg-blue-600 rounded-t-lg">
                    <i data-lucide="user"
                        class="w-4 h-4 inline-block mr-2"></i>
                    Mon profil
                </a>
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-600 hover:bg-blue-600">
                    <i data-lucide="settings"
                        class="w-4 h-4 inline-block mr-2"></i>
                    Paramètres
                </a>
                <a
                    href="/logout"
                    class="block px-4 py-2 text-sm text-red-500 hover:bg-blue-600 rounded-b-lg">
                    <i data-lucide="log-out"
                        class="w-4 h-4 inline-block mr-2"></i>
                    Déconnexion
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Toggle Button for Mobile -->
<button class="fixed top-0 left-0 md:hidden p-4 text-gray-600 hover:text-blue-600 " id="toggleSidebar">
    <i data-lucide="menu" class="w-6 h-6"></i>
</button>

<!-- Add this button for desktop view
<button class="hidden md:block p-4 text-gray-600 hover:text-blue-600" id="toggleSidebarDesktop">
    <i data-lucide="menu" class="w-6 h-6"></i>
</button> -->