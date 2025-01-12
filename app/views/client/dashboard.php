<?php require_once(__DIR__ . '../../partials/clinetTop.php'); ?>
<?php require_once(__DIR__ . '../../partials/clientSideBar.php'); ?>

<!-- Main Content -->
<div class="flex-1 p-4 md:p-8">
    <h2 class="text-2xl font-bold text-gray-800">Tableau de bord</h2>

    <!-- Account Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <?php if (!empty($accounts)): ?>
            <?php foreach ($accounts as $account): ?>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-700 capitalize ">Compte <?= htmlspecialchars($account["account_type"]) ?></h3>
                    <p class="text-3xl font-bold text-gray-900 mt-2">€<?= htmlspecialchars($account["balance"]) ?></p>
                    <p class="text-sm text-gray-500 mt-1">N° <?= htmlspecialchars($account["account_id"]) ?></p>
                </div>
            <?php endforeach ?>
        <?php else: ?>
            <div>No accounts yet</div>
        <?php endif ?>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mt-6">
        <a href="/client/virement"
            class="flex items-center justify-center space-x-2 p-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            <i data-lucide="send" class="w-5 h-5"></i>
            <span>Nouveau virement</span></a>
        <button onclick="toggleModal('epargne')"
            class="flex items-center justify-center space-x-2 p-4 bg-green-600 text-white rounded-lg hover:bg-green-700">
            <i data-lucide="plus-circle" class="w-5 h-5"></i>
            <span>Alimenter compte</span>
        </button>
        <a href="/client/benificier"
            class="flex items-center justify-center space-x-2 p-4 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
            <i data-lucide="users" class="w-5 h-5"></i>
            <span>Gérer bénéficiaires</span>
        </a>
    </div>

    <!-- Recent Transactions -->
    <div class="bg-white rounded-lg shadow mt-6">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-700">Transactions récentes</h3>
            <div class="mt-4 space-y-4">
                <div class="flex items-center justify-between p-4 border-b">
                    <div>
                        <p class="font-medium">Virement à John Doe</p>
                        <p class="text-sm text-gray-500">12 janvier 2025</p>
                    </div>
                    <p class="text-red-600 font-medium">-€125.00</p>
                </div>
                <div class="flex items-center justify-between p-4 border-b">
                    <div>
                        <p class="font-medium">Virement reçu de Marie Martin</p>
                        <p class="text-sm text-gray-500">11 janvier 2025</p>
                    </div>
                    <p class="text-green-600 font-medium">+€350.00</p>
                </div>
                <div class="flex items-center justify-between p-4 border-b">
                    <div>
                        <p class="font-medium">Paiement Carte Bancaire</p>
                        <p class="text-sm text-gray-500">10 janvier 2025</p>
                    </div>
                    <p class="text-red-600 font-medium">-€42.50</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once(__DIR__ . '../../partials/clientButtom.php'); ?>
<?php require_once('alimenterCompteModal.php'); ?>