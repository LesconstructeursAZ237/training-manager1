<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu avec Image de Fond</title>
    <!-- Inclure Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Optionnel : Styles supplémentaires pour ajuster l'apparence */
        .bg-transparent {
            background-color: rgba(0, 0, 0, 0.3); /* Opacité de 30% */
        }
    </style>
</head>
<body class="bg-gray-100 ">

<!-- Image de fond -->
<div class="absolute inset-0 z-0">
    <img src="./../../../../assets/img/logo1.png" alt="Logo" class="h-2/12 w-2/12 object-cover">
</div>

<!-- Conteneur principal avec menu -->
<div class="relative z-10">

    <!-- Menu de navigation -->
    <nav class="bg-blue-900 bg-transparent p-0 h-2/12">
        <div class="container mx-auto flex items-center justify-between">

            <!-- Navigation Links -->
            <div class="hidden md:flex space-x-4 items-center">
                <button class="text-white hover:bg-blue-400 p-2 rounded">Utilisateurs</button>
                <button class="text-white hover:bg-blue-400 p-2 rounded">Formations</button>
                <button class="text-white hover:bg-blue-400 p-2 rounded">Évènements</button>
                <button class="text-white hover:bg-blue-400 p-2 rounded">Niveau</button>
                <button class="text-white hover:bg-blue-400 p-2 rounded">Étudiants</button>
                <button class="text-white hover:bg-blue-400 p-2 rounded">Accueil</button>
            </div>

            <!-- Search Bar -->
            <div class="m-2 rounded-lg w-full max-w-md flex items-center justify-center h-full">
                <form action="" method="post" class="w-full flex">
                    <input type="text" id="search" name="search" placeholder="Entrez votre recherche"
                        class="w-full px-4 py-2 h-full border rounded-l-lg">
                    <button type="submit"
                        class="bg-blue-800 text-white px-5 py-2 rounded-r-lg hover:bg-blue-700 focus:outline-none">Search</button>
                </form>
            </div>

            <!-- Profile Button -->
            <div class="flex items-center space-x-4">
                <button class="text-white p-2 rounded ml-2 mr-0 hover:bg-blue-500">Profil</button>
                <button type="button" id="menu-toggle" class="text-white md:hidden focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

<div class="flex flex-col md:flex-row h-full">
    <!-- Menu vertical à gauche -->
    <div class="bg-gray-300 text-white p-4 w-1/6 h-full">
        <ul>
            <li><a href="#" class="block p-2">Menu Item 1</a></li>
            <li><a href="#" class="block p-2">Menu Item 2</a></li>
            <li><a href="#" class="block p-2">Menu Item 3</a></li>
            
        </ul>
    </div>

    <!-- Contenu personnalisé -->
    <div class="flex-1 bg-gray-200 p-4">
        <h2 class="text-lg font-bold mb-4">Votre contenu personnalisé</h2>
        <p>Ici, vous pouvez ajouter votre propre texte, images, formulaires, etc.</p>
        <img src="votre-image.jpg" alt="Votre image" class="mt-4">
    </div>
</div>

</div>
<div class="bg-red-500 w-full h-100" >
    
</div>

</body>
</html>
