<?php require_once(__DIR__ . '../../partials/clinetTop.php'); ?>
<?php require_once(__DIR__ . '../../partials/clientSideBar.php'); ?>

<!-- Main Content -->
<div class="flex-1 p-4 md:p-8">
    <h2 class="text-2xl font-bold text-gray-800">Historique des transactions</h2>

    <!-- Filtres -->
    <div class="bg-white rounded-lg shadow mt-6 p-4 md:p-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Filtres</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Compte</label>
                <select
                    class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500">
                    <option value="all">Tous les comptes</option>
                    <option value="current">Compte Courant</option>
                    <option value="savings">Compte Épargne</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Période</label>
                <select
                    class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500">
                    <option value="7">7 derniers jours</option>
                    <option value="30">30 derniers jours</option>
                    <option value="90">3 derniers mois</option>
                    <option value="365">12 derniers mois</option>
                    <option value="custom">Période personnalisée</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Type d'opération</label>
                <select
                    class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500">
                    <option value="all">Toutes les opérations</option>
                    <option value="credit">Crédit uniquement</option>
                    <option value="debit">Débit uniquement</option>
                    <option value="transfer">Virements</option>
                    <option value="payment">Paiements</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Montant</label>
                <div class="flex space-x-2">
                    <input type="number" placeholder="Min"
                        class="w-1/2 rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500" />
                    <input type="number" placeholder="Max"
                        class="w-1/2 rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500" />
                </div>
            </div>
        </div>

        <!-- Date personnalisée (caché par défaut) -->
        <div class="hidden mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date de début</label>
                <input type="date"
                    class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date de fin</label>
                <input type="date"
                    class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500" />
            </div>
        </div>

        <div class="mt-4 flex flex-col md:flex-row justify-end space-x-0 md:space-x-4">
            <button class="mb-2 md:mb-0 px-4 py-2 text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                Réinitialiser
            </button>
            <button class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                Appliquer les filtres
            </button>
        </div>
    </div>

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
                                Libellé
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
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Transaction 1 -->
                        <!-- <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                15 Jan 2025
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <div>Virement à John Doe</div>
                                <div class="text-gray-500">Remboursement restaurant</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                    Virement
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                Compte Courant
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium text-red-600">
                                - 125.00 €
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                <button class="text-blue-600 hover:text-blue-900">
                                    Détails
                                </button>
                            </td>
                        </tr> -->
                        <?php foreach ($transactions as $transaction): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 flex flex-col gap-2">
                                    <div>
                                        <?= htmlspecialchars(date("Y-m-d", strtotime($transaction["created_at"]))) ?>
                                    </div>
                                    <div>
                                        <?= htmlspecialchars(date("H:i:s", strtotime($transaction["created_at"]))) ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 max-w-40">
                                    <?= htmlspecialchars($transaction["motif"]) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize min-w-16
                                    <?= $transaction["transaction_type"] === 'depot' ? 'bg-green-100 text-green-800' : ($transaction["transaction_type"] === 'retrait' ? 'bg-red-100 text-red-800' :'bg-blue-100 text-blue-800') ?>">
                                        <?= htmlspecialchars($transaction["transaction_type"]) ?>
                                    </span>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 capitalize">
                                    Compte <?= htmlspecialchars($transaction["account_type"]) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium <?= $transaction["transaction_type"] === 'depot' ? 'text-green-600' : 'text-red-600' ?>">
                                    <?= $transaction["transaction_type"] === 'depot' ? '+' : '-' ?> <?= htmlspecialchars($transaction["amount"]) ?>€
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                    <button class="text-blue-600 hover:text-blue-900">
                                        Détails
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach ?>

                        <!-- Transaction 2 -->

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once(__DIR__ . '../../partials/clientButtom.php'); ?>