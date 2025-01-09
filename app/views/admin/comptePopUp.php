<?php

?>
<!-- Modal Ajout/Modification Compte -->
<div id="accountActionsModal"
    class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 w-full max-w-2xl">
        <div class="bg-white rounded-lg shadow-xl">
            <!-- Modal Header -->
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-lg font-semibold text-gray-900">Ajouter
                    un nouveau compte</h3>
                <button onclick="toggleAccountActionsModal()" class="text-gray-400 hover:text-gray-500">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <form id="accountForm" class="space-y-6" action="/admin/addAcount" method="POST">
                    <!-- Sélection du client -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Client
                            titulaire *</label>
                        <select required name="user_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value>Sélectionner un
                                client</option>
                            <?php foreach ($users as $user): ?>
                                <option value="<?= htmlspecialchars($user["user_id"]); ?>"><?= htmlspecialchars($user["full_name"]); ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <!-- Type de compte -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Type
                                de compte *</label>
                            <select required name="type_compte"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                onchange="toggleSavingsFields(this.value)">
                                <option value>Sélectionner</option>
                                <option value="courant">Compte
                                    Courant</option>
                                <option value="epargne">Compte
                                    Épargne</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Balance *</label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">€</span>
                                </div>
                                <input type="number" required min="0" name="balance_input"
                                    class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="1000">
                            </div>
                        </div>
                    </div>

                    <!-- Paramètres du compte -->
                    <div class="space-y-4">
                        <h4 class="text-base font-medium text-gray-900">Paramètres
                            du compte</h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Plafond
                                    de retrait *</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">€</span>
                                    </div>
                                    <input type="number" required min="0" name="plafond_input"
                                        class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="1000">
                                </div>
                            </div>

                            <div id="decouvertField">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Découvert
                                    autorisé</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">€</span>
                                    </div>
                                    <input type="number" min="0" name="decouvert_input"
                                        class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="500">
                                </div>
                            </div>

                            <div id="tauxInteretField" class="hidden">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Taux
                                    d'intérêt annuel</label>
                                <div class="relative">
                                    <input type="number" step="0.01" min="0" max="100"
                                        class="w-full pr-8 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="2.5">
                                    <div
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Options -->
                    <div class="space-y-4">
                        <h4 class="text-base font-medium text-gray-900">Options
                            du compte</h4>

                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded text-blue-600" checked>
                                <span class="ml-2 text-sm text-gray-700">Activer
                                    la carte bancaire</span>
                            </label>

                            <label class="flex items-center">
                                <input type="checkbox" class="rounded text-blue-600" checked>
                                <span class="ml-2 text-sm text-gray-700">Autoriser
                                    les paiements en
                                    ligne</span>
                            </label>

                            <label class="flex items-center">
                                <input type="checkbox" class="rounded text-blue-600" checked>
                                <span class="ml-2 text-sm text-gray-700">Activer
                                    les notifications SMS</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 p-6 border-t bg-gray-50">
                        <button onclick="toggleAccountActionsModal()"
                            class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Annuler
                        </button>

                        <button onclick="submitAccountForm()" name="add_acount"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Créer le compte
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>