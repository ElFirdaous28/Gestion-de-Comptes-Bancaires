<?php if (isset($_SESSION['transactionError'])): ?>
    <div id="errorModal"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <!-- Modal header -->
            <div class="flex justify-between items-center p-6">
                <h3 class="text-lg font-semibold text-gray-900">Erreur</h3>
                <button onclick="toggleErrorModal()" class="text-gray-400 hover:text-gray-500">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <!-- Modal body -->
            <div class="p-6">
                <p class="text-sm text-gray-700 text-center"><?= htmlspecialchars($_SESSION['transactionError']) ?></p>
            </div>

            <!-- Modal footer -->
            <div class="flex justify-end space-x-3 p-6 bg-gray-50">
                <button onclick="toggleErrorModal()"
                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Fermer
                </button>
            </div>
        </div>
    </div>
    <?php unset($_SESSION['transactionError']); // Remove the session variable after showing the message ?>
<?php endif; ?>

<script>
    function toggleErrorModal() {
    const errorModal = document.getElementById('errorModal');
    errorModal.classList.toggle('hidden');
}

</script>