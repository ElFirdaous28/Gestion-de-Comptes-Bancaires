<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administration - Dashboard</title>

        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    </head>
    <body class="bg-gray-100">
        <div class="flex min-h-screen relative">
            <!-- Bouton Menu Mobile -->
            <button
                onclick="toggleSidebar()"
                class="lg:hidden fixed top-4 left-4 z-50 bg-gray-900 text-white p-2 rounded-lg">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>