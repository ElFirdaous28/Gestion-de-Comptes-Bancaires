<div id="retraitModal"
    class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 w-full max-w-md">
        <div class="bg-white rounded-lg shadow-xl">
            <!-- Modal header -->
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-lg font-semibold text-gray-900">Retrait D'Argent</h3>
                <button onclick="toggleretraitModal()" class="text-gray-400 hover:text-gray-500">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <!-- Modal body -->
            <div class="p-6">
                <form action="/client/fairRetrait" method="POST" id="alimenterForm" class="space-y-6">
                    <!-- Sélection du compte -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Compte de retrait*</label>
                        <select name="account_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <?php foreach ($accounts as $account): ?>
                                <option value="<?= htmlspecialchars($account["account_id"]) ?>">Compte <?= htmlspecialchars($account["account_type"]) ?> (<?= htmlspecialchars($account["balance"]) ?>)</option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <!-- Montant -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Montant *</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">€</span>
                            </div>
                            <input name="amount" type="number" required min="0.01" step="0.01"
                                class="w-full pl-8 pr-12 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="0.00">
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Montant minimum : 0.01 €</p>
                    </div>

                    <!-- motif -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Motif *</label>
                        <input
                            required
                            name="motif"
                            type="text"
                            class="mt-1 block w-full rounded-md border border-gray-300 p-2"
                            placeholder="Motif du virement" />
                    </div>

                    <div class="flex justify-end space-x-3 p-6 border-t bg-gray-50">
                        <button onclick="toggleretraitModal()"
                            class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            Annuler
                        </button>
                        <button name="fairRetrait" onclick="submitForm()"
                            class="px-4 py-2 text-gray-700 hover:text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 border-2 border-blue-700">
                            Confirmer le retrait
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script src="/assets/js/retraitPopUp.js"></script>