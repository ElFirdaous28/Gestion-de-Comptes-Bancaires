<?php
if ($_SESSION['user_loged_in_role'] === "admin") {
    require_once(__DIR__ . '../../partials/top.php');
    require_once(__DIR__ . '../../partials/adminSideBar.php');
} else {
    require_once(__DIR__ . '../../partials/clinetTop.php');
    require_once(__DIR__ . '../../partials/clientSideBar.php');
}
?>

<!-- Main Content -->
<div class="flex-1 p-8">
    <h2 class="text-2xl font-bold text-gray-800">Mon Profil</h2>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
        <!-- Informations Personnelles -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Informations Personnelles</h3>
                    <form class="space-y-6" action="/admin/updateUserInformation" method="POST">
                        <!-- Photo de profil -->
                        <div class="flex items-center space-x-6">
                            <div class="relative">
                                <img src="/api/placeholder/128/128" alt="Photo de profil"
                                    class="w-32 h-32 rounded-full object-cover" />
                                <button type="button"
                                    class="absolute bottom-0 right-0 bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700">
                                    <i data-lucide="camera" class="w-4 h-4"></i>
                                </button>
                            </div>
                            <div>
                                <button type="button" class="text-sm text-blue-600 hover:text-blue-800">
                                    Changer la photo
                                </button>
                                <p class="text-xs text-gray-500 mt-1">
                                    JPG, PNG ou GIF. Max 1MB.
                                </p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nom Complet</label>
                            <input type="text" name="full_name_input"
                                class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                                value="<?= htmlspecialchars($user["full_name"]); ?> " />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email_input"
                                class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                                value="<?= htmlspecialchars($user['email']) ?>" />
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" name="update_information"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Sauvegarder les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sécurité -->
            <div class="bg-white rounded-lg shadow mt-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Sécurité</h3>
                    <form class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mot de passe actuel</label>
                            <input type="password"
                                class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                                placeholder="••••••••" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                            <input type="password"
                                class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                                placeholder="••••••••" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Confirmer le nouveau mot de
                                passe</label>
                            <input type="password"
                                class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"
                                placeholder="••••••••" />
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Modifier le mot de passe
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Paramètres et Préférences -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Préférences</h3>

                    <div class="space-y-4">
                        <div>
                            <h4 class="text-sm font-medium text-gray-700">Notifications</h4>
                            <div class="mt-2 space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded text-blue-600" checked />
                                    <span class="ml-2 text-sm text-gray-700">Notifications par email</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded text-blue-600" checked />
                                    <span class="ml-2 text-sm text-gray-700">Notifications SMS</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded text-blue-600" checked />
                                    <span class="ml-2 text-sm text-gray-700">Alertes de sécurité</span>
                                </label>
                            </div>
                        </div>

                        <div class="pt-4">
                            <h4 class="text-sm font-medium text-gray-700">Confidentialité</h4>
                            <div class="mt-2 space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded text-blue-600" />
                                    <span class="ml-2 text-sm text-gray-700">Masquer le solde sur la page
                                        d'accueil</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded text-blue-600" checked />
                                    <span class="ml-2 text-sm text-gray-700">Double authentification</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <form action="/client/deleteAccountUser" method="POST">
                        <div class="mt-6 pt-6 border-t">
                            <button class="flex items-center text-red-600 hover:text-red-800" name="delete_account_user">
                                <i data-lucide="trash-2" class="w-4 h-4 mr-2"></i>
                                Supprimer mon compte
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    </div>
</div>

<?php
if ($_SESSION['user_loged_in_role'] === "admin") {
    require_once(__DIR__ . '../../partials/buttom.php');
} else {
    require_once(__DIR__ . '../../partials/clientButtom.php');
}
?>