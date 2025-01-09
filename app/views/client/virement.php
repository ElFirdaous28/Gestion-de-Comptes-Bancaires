<?php require_once(__DIR__ . '../../partials/clinetTop.php'); ?>
<?php require_once(__DIR__ . '../../partials/clientSideBar.php'); ?>

<!-- Main Content -->
<div class="flex-1 p-8">
    <h2 class="text-2xl font-bold text-gray-800">Effectuer un virement</h2>

    <div class="bg-white p-6 rounded-lg shadow mt-6">
        <form action="virement/fairVirment" method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Compte à débiter</label>
                <select name="account_id" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <?php foreach ($accounts as $account): ?>
                        <option value="<?= htmlspecialchars($account["account_id"]) ?>">Compte <?= htmlspecialchars($account["account_type"]) ?> (<?= htmlspecialchars($account["balance"]) ?>)</option>
                    <?php endforeach ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Bénéficiaire</label>
                <select name="beneficiary_account_id" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <?php foreach ($beneficiaries as $beneficiary): ?>
                        <option value="<?= htmlspecialchars($beneficiary["beneficiary_account_id"]) ?>"><?= htmlspecialchars($beneficiary["beneficiary_name"])."-". htmlspecialchars($beneficiary["beneficiary_account_id"]) ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Montant</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">€</span>
                    </div>
                    <input
                    name="amount"
                        type="number"
                        min="0.01"
                        step="0.01"
                        class="pl-7 block w-full rounded-md border border-gray-300 p-2"
                        placeholder="0.00" />
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Motif</label>
                <input
                    type="text"
                    class="mt-1 block w-full rounded-md border border-gray-300 p-2"
                    placeholder="Motif du virement" />
            </div>

            <div class="pt-4">
                <button type="submit" name="fairVirment" class="w-full bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700">
                    Valider le virement
                </button>
            </div>
        </form>
    </div>

    <!-- Derniers virements -->
    <div class="bg-white rounded-lg shadow mt-6">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-700">Derniers virements</h3>
            <div class="mt-4 space-y-4">
                <div class="flex items-center justify-between p-4 border-b">
                    <div>
                        <p class="font-medium">Virement à John Doe</p>
                        <p class="text-sm text-gray-500">12 janvier 2025</p>
                        <p class="text-sm text-gray-500">Motif : Remboursement déjeuner</p>
                    </div>
                    <p class="text-red-600 font-medium">-€125.00</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once(__DIR__ . '../../partials/clientButtom.php'); ?>