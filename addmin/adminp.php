<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page d'administration</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>
</head>
<body class="bg-gray-100">

<!-- Top Navigation -->
<nav class="bg-white shadow-md w-full fixed top-0 z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <h1 class="text-lg font-semibold">IFP Le leader en Info</h1>
            <!-- Bouton de menu pour les appareils mobiles -->
            <button id="menu_toggle" class="lg:hidden text-gray-700 hover:text-gray-900 focus:outline-none">
                Menu
            </button>
            <!-- Barre de navigation principale -->
            <div id="main_menu" class="hidden lg:flex space-x-8 flex-1 justify-evenly items-center">
                <!-- Accueil -->
                <div class="relative group">
                    <button id="btn_accueil" class="text-gray-700  rounded p-2 hover:text-white hover:bg-blue-500 text-xl font-medium focus:outline-none">pages</button>
                    <div id="accueil" class="submenu absolute left-0 mt-2 w-48 bg-white shadow-lg rounded hidden">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">acceuil</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">formation</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">evenement</a>
                    </div>
                </div>
                <!-- À propos -->
                <div class="relative group">
                    <button id="btn_propos" class="text-gray-700  rounded p-2 hover:text-white hover:bg-blue-500 text-xl font-medium focus:outline-none">utilisateurs</button>
                    <div id="propos" class="submenu absolute left-0 mt-2 w-48 bg-white shadow-lg rounded hidden">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">ajouter</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">voir les utilisateurs</a>
                    </div>
                </div>
                <!-- Services -->
                <div class="relative group">
                    <button id="btn_services" class="text-gray-700  rounded p-2 hover:text-white hover:bg-blue-500 text-xl font-medium focus:outline-none">formations</button>
                    <div id="services" class="submenu absolute left-0 mt-2 w-48 bg-white shadow-lg rounded hidden">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">ajouter</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">voir les formations</a>
                    </div>
                </div>
                <!-- Contact -->
                <div class="relative group">
                    <button id="btn_contact" class="text-gray-700  rounded p-2 hover:text-white hover:bg-blue-500 text-xl font-medium focus:outline-none">evenements</button>
                    <div id="contact" class="submenu absolute left-0 mt-2 w-48 bg-white shadow-lg rounded hidden">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">ajouter</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">voir les evenements</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Sidebar (for mobile view) -->
<div id="sidebar" class="soumenu2 lg:hidden fixed top-0 left-0 w-1/5 h-full bg-gray-400 shadow-md  z-20 transition-transform transform -translate-x-full lg:translate-x-0 lg:block">
    <nav class="p-4">
        <a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-200 rounded">Champ 1</a>
        <a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-200 rounded">Champ 2</a>
        <a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-200 rounded">Champ 3</a>
        <a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-200 rounded">Champ 4</a>
        <a href="#" class="block py-2 px-4 text-gray-700 hover:bg-gray-200 rounded">Champ 5</a>
        
    </nav>
</div>

<!-- Main content -->
<div id="content" class="lg:ml-64 p-4 mt-16">
    <h1 class="text-2xl font-bold">Contenu Principal</h1>
    <p class="mt-4">Ceci est le contenu principal de la page.</p>
</div>


</body>
</html>
