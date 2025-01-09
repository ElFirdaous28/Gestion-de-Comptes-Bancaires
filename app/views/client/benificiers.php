<?php require_once(__DIR__ . '../../partials/clinetTop.php'); ?>
<?php require_once(__DIR__ . '../../partials/clientSideBar.php'); ?>

<!-- Main Content -->
<div class="flex-1 p-8">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Bénéficiaires</h2>
        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center">
            <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
            Ajouter un bénéficiaire
        </button>
    </div>

    <!-- Liste des bénéficiaires -->
    <div class="mt-6 bg-white rounded-lg shadow">
        <div class="p-6">
            <!-- Bénéficiaire 1 -->

            <?php foreach ($beneficiaries as $beneficiary):?>
            <div class="beneficiary border-b pb-4" data-beneficiary-id="<?= htmlspecialchars($beneficiary["beneficiary_id"])?>">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i data-lucide="user" class="w-6 h-6 text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="beneficiary_name font-medium text-gray-900"><?= htmlspecialchars($beneficiary["beneficiary_name"])?></h3>
                            <p class="beneficiary_account_id text-sm text-gray-500 uppercase"><?= htmlspecialchars($beneficiary["beneficiary_account_id"])?></p>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 capitalize">
                                Compte <?= htmlspecialchars($beneficiary["account_type"])?>
                            </span>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg">
                            <i data-lucide="send" class="w-5 h-5"></i>
                        </button>
                        <button onclick="showBeneficiaryInfo(event)" class="p-2 text-gray-600 hover:bg-gray-50 rounded-lg">
                            <i data-lucide="edit" class="w-5 h-5"></i>
                        </button>
                        <form action="benificiers/deleteBeneficiary" method="post">
                            <input type="text" name="beneficiary_id" value="<?= htmlspecialchars($beneficiary["beneficiary_id"])?>" class="hidden">
                            <button name="delete_beneficiary" type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                <i data-lucide="trash-2" class="w-5 h-5"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach?>


            <!-- Formulaire d'ajout de bénéficiaire (masqué par défaut) -->
            <div class=" mt-6 p-6 border rounded-lg">
                <h3 class="text-lg font-medium text-gray-900">Ajouter un bénéficiaire</h3>
                <form action="benificiers/addBeneficiary" method="POST" id="save_beneficiary_form" class="mt-4 space-y-4">
                    <input type="number" name="beneficiary_id" id="beneficiary_id_input" class="hidden">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nom complet</label>
                        <input type="text" name="beneficiary_name" required class="mt-1 block w-full rounded-md border border-gray-300 p-2" id="beneficiary_name_input">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Compte Id</label>
                        <input type="text" name="beneficiary_account_id" required class="mt-1 block w-full rounded-md border border-gray-300 p-2" id="beneficiary_account_id_input">
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button id="annuler" type="button" class="px-4 py-2 border rounded-lg">Annuler</button>
                        <button type="submit" name="addBeneficiary" id="save_beneficiary_button" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="/assets/js/editeBeneficiary.js"></script>
<?php require_once(__DIR__ . '../../partials/clientButtom.php'); ?>