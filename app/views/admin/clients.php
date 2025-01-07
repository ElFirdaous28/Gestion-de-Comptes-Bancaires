<?php require_once(__DIR__ . '../../partials/top.php'); ?>
<?php require_once(__DIR__ . '../../partials/adminSideBar.php'); ?>

<!-- Main Content -->
<div class="flex-1">
    <!-- Top Navigation -->
    <div class="bg-white shadow">
        <div class="px-8 py-4 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                Gestion des Clients
            </h2>
            <button
                onclick="toggleAddClientModal()"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center">
                <i data-lucide="user-plus" class="w-5 h-5 mr-2"></i>
                Nouveau Client
            </button>
        </div>
    </div>

    <!-- Filters -->
    <div class="p-8">
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                    <div class="relative">
                        <input
                            type="text"
                            placeholder="Nom, email, ID..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                        <i
                            data-lucide="search"
                            class="w-5 h-5 text-gray-400 absolute left-3 top-2"></i>
                    </div>
                </div>

                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option>Tous les statuts</option>
                        <option>Actif</option>
                        <option>Inactif</option>
                        <option>En attente</option>
                        <option>Bloqué</option>
                    </select>
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
                    <label
                        class="block text-sm font-medium text-gray-700 mb-1">Trier
                        par</label>
                    <select
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option>Date d'inscription</option>
                        <option>Nom</option>
                        <option>Solde</option>
                        <option>Activité récente</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Client List -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6">
                <table class="min-w-full">
                    <thead>
                        <tr
                            class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <th class="p-3">Client</th>
                            <th class="p-3">Contact</th>
                            <th class="p-3">Comptes</th>
                            <th class="p-3">Statut</th>
                            <th class="p-3">Dernière activité</th>
                            <th class="p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- Client 1 -->
                        <tr class="hover:bg-gray-50">
                            <td class="p-3">
                                <div class="flex items-center">
                                    <img
                                        src="/api/placeholder/40/40"
                                        alt="Thomas Robert"
                                        class="w-10 h-10 rounded-full" />
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            Thomas Robert
                                        </div>
                                        <div class="text-sm text-gray-500">ID: #45789</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3">
                                <div class="text-sm text-gray-900">thomas@email.com</div>
                                <div class="text-sm text-gray-500">06 12 34 56 78</div>
                            </td>
                            <td class="p-3">
                                <div class="text-sm text-gray-900">2 comptes</div>
                                <div class="text-sm text-gray-500">Courant, Épargne</div>
                            </td>
                            <td class="p-3">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Actif
                                </span>
                            </td>
                            <td class="p-3">
                                <div class="text-sm text-gray-900">Il y a 2 heures</div>
                                <div class="text-sm text-gray-500">Virement sortant</div>
                            </td>
                            <td class="p-3">
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

                        <!-- Client 2 -->
                        <tr class="hover:bg-gray-50">
                            <td class="p-3">
                                <div class="flex items-center">
                                    <img
                                        src="/api/placeholder/40/40"
                                        alt="Marie Dubois"
                                        class="w-10 h-10 rounded-full" />
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            Marie Dubois
                                        </div>
                                        <div class="text-sm text-gray-500">ID: #45790</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3">
                                <div class="text-sm text-gray-900">marie@email.com</div>
                                <div class="text-sm text-gray-500">06 98 76 54 32</div>
                            </td>
                            <td class="p-3">
                                <div class="text-sm text-gray-900">1 compte</div>
                                <div class="text-sm text-gray-500">Courant</div>
                            </td>
                            <td class="p-3">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    En attente
                                </span>
                            </td>
                            <td class="p-3">
                                <div class="text-sm text-gray-900">Hier</div>
                                <div class="text-sm text-gray-500">Création compte</div>
                            </td>
                            <td class="p-3">
                                <div class="flex space-x-2">
                                    <button class="text-blue-600 hover:text-blue-900">
                                        <i data-lucide="eye" class="w-5 h-5"></i>
                                    </button>
                                    <button class="text-gray-600 hover:text-gray-900">
                                        <i data-lucide="edit" class="w-5 h-5"></i>
                                    </button>
                                    <button class="text-green-600 hover:text-green-900">
                                        <i data-lucide="check-circle" class="w-5 h-5"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- add client  -->

                <div
                    id="addClientModal"
                    class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
                    <div class="relative top-10 mx-auto p-5 w-full max-w-2xl">
                        <div class="bg-white rounded-lg shadow-xl">
                            <!-- Modal Header -->
                            <div class="flex justify-between items-center p-6 border-b">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    Ajouter un nouveau client
                                </h3>
                                <button
                                    onclick="toggleAddClientModal()"
                                    class="text-gray-400 hover:text-gray-500">
                                    <i data-lucide="x" class="w-6 h-6"></i>
                                </button>
                            </div>

                            <!-- Modal Body -->
                            <div class="p-6">
                                <form id="addClientForm" class="space-y-6" action="/admin/addUser" method="POST">
                                    <!-- Informations personnelles -->
                                    <div>

                                        <div class="md:col-span-2">
                                            <label
                                                class="block text-sm font-medium text-gray-700 mb-1">Nom et prénom
                                                *</label>
                                            <input
                                                type="text" name="fullname"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                        </div>

                                        <div class="md:col-span-2">
                                            <label
                                                class="block text-sm font-medium text-gray-700 mb-1">Email
                                                *</label>
                                            <input
                                                type="email" name="email"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                        </div>

                                        <div class="md:col-span-2">
                                            <label
                                                class="block text-sm font-medium text-gray-700 mb-1">Role
                                                *</label>
                                            <select required name="role" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <option value="">Sélectionner</option>
                                                <option value="admin">Admin</option>
                                                <option value="client">Client</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div
                                        class="flex justify-end space-x-3 p-6 border-t bg-gray-50">
                                        <button
                                            onclick="toggleAddClientModal()"
                                            class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                            Annuler
                                        </button>
                                        <button
                                            onclick="submitAddClientForm()" name="addUser"
                                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            Créer le compte
                                        </button>
                                    </div>

                                </form>
                            </div>

                            <!-- Modal Footer -->

                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-between mt-6">
                    <div class="text-sm text-gray-700">
                        Affichage de 1 à 10 sur 45 clients
                    </div>
                    <div class="flex space-x-2">
                        <button
                            class="px-3 py-1 border rounded text-gray-600 hover:bg-gray-50">
                            Précédent
                        </button>
                        <button
                            class="px-3 py-1 border bg-blue-50 text-blue-600 rounded">
                            1
                        </button>
                        <button
                            class="px-3 py-1 border rounded text-gray-600 hover:bg-gray-50">
                            2
                        </button>
                        <button
                            class="px-3 py-1 border rounded text-gray-600 hover:bg-gray-50">
                            3
                        </button>
                        <button
                            class="px-3 py-1 border rounded text-gray-600 hover:bg-gray-50">
                            Suivant
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/assets/js/clientPopUp.js"></script>
<?php require_once(__DIR__ . '../../partials/buttom.php'); ?>