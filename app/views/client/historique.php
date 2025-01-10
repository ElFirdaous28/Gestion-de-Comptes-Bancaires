<?php require_once(__DIR__ . '../../partials/clinetTop.php'); ?>
<?php require_once(__DIR__ . '../../partials/clientSideBar.php'); ?>

<!-- Main Content -->
<div class="flex-1 p-4 md:p-8">
    <h2 class="text-2xl font-bold text-gray-800">Historique des transactions</h2>
    <!-- Résumé -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-sm font-medium text-gray-500">Total des entrées</h3>
            <p class="text-2xl font-bold text-green-600 mt-2">+ 3,450.50 €</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-sm font-medium text-gray-500">Total des sorties</h3>
            <p class="text-2xl font-bold text-red-600 mt-2">- 2,180.30 €</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-sm font-medium text-gray-500">Solde de la période</h3>
            <p class="text-2xl font-bold text-blue-600 mt-2">+ 1,270.20 €</p>
        </div>
    </div>
    <!-- Filtres -->
    <div class="bg-white rounded-lg shadow mt-6 p-4 md:p-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Filtres</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Compte</label>
                <select id="account_type_select"
                    class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Tous les comptes</option>
                    <option value="courant">Compte Courant</option>
                    <option value="epargne">Compte Épargne</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Type d'opération</label>
                <select id="transaction_type_select"
                    class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Toutes les opérations</option>
                    <option value="retrait">Retrait uniquement</option>
                    <option value="depot">Depot uniquement</option>
                    <option value="virement">Virements</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Motif</label>
                <input type="text" name="" id="motif_input" class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500" placeholder="Recherche par motif">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Montant</label>
                <div class="flex space-x-2">
                    <input type="number" id="min_amount_input" placeholder="Min"
                        class="w-1/2 rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500" />
                    <input type="number" id="max_amount_input" placeholder="Max"
                        class="w-1/2 rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500" />
                </div>
            </div>
        </div>

    </div>

    <!-- Liste des transactions -->
    <div class="bg-white rounded-lg shadow mt-6">
        <div class="p-4 md:p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Transactions</h3>
                <button class="text-blue-600 hover:text-blue-800 flex items-center">
                    <i data-lucide="download" class="w-4 h-4 mr-2"></i>
                    Exporter
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Motif
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Type
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Compte
                            </th>
                            <th
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Montant
                            </th>
                            <th
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody id="transactionsList" class="bg-white divide-y divide-gray-200">
                        <!-- tranasctions will ppear here -->
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="flex items-center justify-between mt-6 flex-col md:flex-row">
                <div class="text-sm text-gray-700 mb-2 md:mb-0">
                    Affichage de 1 à 10 sur 56 transactions
                </div>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 border rounded text-gray-600 hover:bg-gray-50">
                        Précédent
                    </button>
                    <button class="px-3 py-1 border bg-blue-50 text-blue-600 rounded">
                        1
                    </button>
                    <button class="px-3 py-1 border rounded text-gray-600 hover:bg-gray-50">
                        2
                    </button>
                    <button class="px-3 py-1 border rounded text-gray-600 hover:bg-gray-50">
                        3
                    </button>
                    <button class="px-3 py-1 border rounded text-gray-600 hover:bg-gray-50">
                        Suivant
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/assets/js/transactionsfilter.js"></script>
<?php require_once(__DIR__ . '../../partials/clientButtom.php'); ?>