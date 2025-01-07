<?php require_once(__DIR__ . '../../partials/top.php'); ?>
<?php require_once(__DIR__ . '../../partials/adminSideBar.php'); ?>

<!-- Main Content -->
<div class="flex-1">
    <!-- Top Navigation existant -->
    <div class="bg-white shadow">
        <div class="px-8 py-4 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">Gestion
                des Comptes</h2>
            <button onclick="toggleAccountActionsModal()"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center">
                <i data-lucide="plus-circle" class="w-5 h-5 mr-2"></i>
                Nouveau Compte
            </button>
        </div>
    </div>

    <!-- Content -->
    <div class="p-8">
        <!-- Statistics Cards existant -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <!-- ... Cartes existantes ... -->
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Comptes
                            Actifs</p>
                        <p class="text-2xl font-bold text-gray-900">2,847</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-lg">
                        <i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>
                    </div>
                </div>
                <p class="text-sm text-green-600 mt-2">+3.2% ce
                    mois</p>
            </div>
        </div>

        <!-- Filters existant -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <!-- ... Filtres existants ... -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                    <div class="relative">
                        <input type="text" placeholder="N° compte, nom client..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute left-3 top-2"></i>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Type
                        de compte</label>
                    <select
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option>Tous les types</option>
                        <option>Compte Courant</option>
                        <option>Compte Épargne</option>
                        <option>Compte Joint</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option>Tous les statuts</option>
                        <option>Actif</option>
                        <option>En attente</option>
                        <option>Bloqué</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Solde</label>
                    <select
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option>Tous les soldes</option>
                        <option>Négatif</option>
                        <option>0 - 1000€</option>
                        <option>> 1000€</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Table existante -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <!-- ... Table existante ... -->
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Compte
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Client
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Type
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Solde
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Dernière Activité
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Account 1 -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">FR76
                                1234 5678 9012</div>
                            <div class="text-sm text-gray-500">#ACC-001</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img src="/api/placeholder/40/40" alt class="h-10 w-10 rounded-full">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Thomas
                                        Robert</div>
                                    <div class="text-sm text-gray-500">thomas@email.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Compte
                                Courant</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">2,450.50
                                €</div>
                            <div class="text-xs text-green-600">+350€
                                ce mois</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Actif
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Il y
                                a 2 heures</div>
                            <div class="text-sm text-gray-500">Virement
                                sortant</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex space-x-2">
                                <button class="text-blue-600 hover:text-blue-900">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </button>
                                <button class="text-gray-600 hover:text-gray-900">
                                    <i data-lucide="edit" class="w-5 h-5"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-900">
                                    <i data-lucide="lock" class="w-5 h-5"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Account 2 -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">FR76
                                9876 5432 1098</div>
                            <div class="text-sm text-gray-500">#ACC-002</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img src="/api/placeholder/40/40" alt class="h-10 w-10 rounded-full">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Marie
                                        Dubois</div>
                                    <div class="text-sm text-gray-500">marie@email.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray"></div>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once('comptePopUp.php'); ?>
<script src="/assets/js/compte.js"></script>

<?php require_once(__DIR__ . '../../partials/buttom.php'); ?>