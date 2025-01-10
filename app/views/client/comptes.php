<?php require_once(__DIR__ . '../../partials/clinetTop.php'); ?>
<?php require_once(__DIR__ . '../../partials/clientSideBar.php'); ?>

<!-- Main Content -->
<div class="flex-1 p-8">
    <h2 class="text-2xl font-bold text-gray-800">Mes Comptes</h2>
    <?php if(!empty($accounts)):?>
        <?php foreach ($accounts as $account): ?>
            <div class="mt-6 bg-white rounded-lg shadow">
                <div class="p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 capitalize">Compte <?= htmlspecialchars($account["account_type"]) ?></h3>
                            <p class="text-sm text-gray-500">N° <?= htmlspecialchars($account["account_id"]) ?></p>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-gray-900">€<?= htmlspecialchars($account["balance"]) ?></p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                    <?= $account["account_status"] === 'blocked' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' ?>">
                                <?= htmlspecialchars($account["account_status"]) ?>
                            </span>

                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-3 gap-4">
                        <button onclick="toggleModal('courant')"
                            class="flex items-center justify-center p-3 text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-50">
                            <i data-lucide="plus-circle" class="w-5 h-5 mr-2"></i>
                            Alimenter
                        </button>
                        <button onclick="toggleretraitModal('courant')"
                            class="retrait flex items-center justify-center p-3 text-purple-600 border border-purple-600 rounded-lg hover:bg-purple-50">
                            <i data-lucide="hand-coins" class="w-5 h-5 mr-2"></i>
                            Retrait
                        </button>
                        <button
                            class="flex items-center justify-center p-3 text-blue-600 border border-blue-600 rounded-lg hover:bg-purple-50">
                            <i data-lucide="download" class="w-5 h-5 mr-2"></i>
                            Relevé
                        </button>
                    </div>

                    <div class="mt-6">
                        <h4 class="font-medium text-gray-700">Détails du compte</h4>
                        <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm text-gray-500">Date d'ouverture</dt>
                                <dd class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($account["created_at"])?></dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-500">Plafond de retrait</dt>
                                <dd class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($account["plafond_retrait_jour"])?>€ / jour</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-500">Découvert autorisé</dt>
                                <dd class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($account["decouvert_autorise"])?>€</dd>
                            </div>
                            <div>
                                <dt class="text-sm text-gray-500">Frais de tenue</dt>
                                <dd class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($account["plafond_retrait_jour"])?>€ / mois</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    <?php else:?>
        <div>No accounts yet</div>
    <?php endif?>

</div>

<?php require_once(__DIR__ . '../../partials/clientButtom.php'); ?>
<?php require_once('alimenterCompteModal.php'); ?>
<?php require_once('retraitPopUp.php'); ?>