<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Navigation Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    
            <!-- Logo -->
            <div class="absolute inset-0 z-0">
                <img src="./../../../../assets/img/logo1.png" alt="Logo" class="ml-0 p-0 h-1/12 w-1/12 object-contain">
            </div>
  
<nav class="bg-blue-900 opacity-90 p-0 h-2/12">
     
    <div class="container mx-auto flex items-center justify-between ">
        
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
        <div class=" m-2 rounded-lg w-full max-w-md flex items-center justify-center h-full">
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
            <button id="btnOpenVerticalMenu" onclick="openVerticalMenu()" class="lg:hidden text-white p-2 rounded ml-2 mr-0 hover:bg-blue-500">Menu</button>
        </div>
    </div>

  
</nav>

    
<div class="flex flex-col md:flex-row h-full ">
    <!-- Menu vertical à gauche -->
    <div id="verticalMenu" class="hidden md:block  sm:w-1/3 md:w-1/5 hidden bg-blue-900 opacity-90 text-white p-4 overflow-auto top-2/12">
        <ul>
            <a href="" > <h1 class="bg-blue-600 w-full rounded underline p-1 m-0 hover:bg-blue-800 "> Accueil</h1></a>
            <li><a href="#" class="block p-2 hover:bg-blue-800 rounded">Évenements</a></li>
            <li><a href="#" class="block p-2 hover:bg-blue-800 rounded">Formations</a></li>
           
        </ul>
        <hr>
        <ul>
            <h1 class="bg-blue-600 w-full rounded p-1 m-0 hover:bg-blue-800 ">Utilisateurs</h1>
            <li><a href="#" class="block p-2 hover:bg-blue-800 rounded">ajouter</a></li>
            <li><a href="#" class="block p-2 hover:bg-blue-800 rounded">voir les Utilisateurs</a></li>
            
        </ul>
        <hr>
        <ul>
            <h1 class="bg-blue-600 w-full rounded p-1 m-0 hover:bg-blue-800 ">Formation</h1>
            <li><a href="#" class="block p-2 hover:bg-blue-800 rounded">ajouter</a></li>
            <li><a href="#" class="block p-2 hover:bg-blue-800 rounded">voir les formations</a></li>
            
        </ul>
        <hr>
        <ul>
            <h1 class="bg-blue-600 w-full rounded p-1 m-0 hover:bg-blue-800 ">Niveau</h1>
            <li><a href="#" class="block p-2 hover:bg-blue-800 rounded">ajouter</a></li>
            <li><a href="#" class="block p-2 hover:bg-blue-800 rounded">voir les Niveaux</a></li>         
        </ul>
        <hr>
        <ul>
            <h1 class="bg-blue-600 w-full rounded p-1 m-0 hover:bg-blue-800 ">Évenements</h1>
            <li><a href="#" class="block p-2 hover:bg-blue-800 rounded">ajouter</a></li>
            <li><a href="#" class="block p-2 hover:bg-blue-800 rounded">voir les Évenements</a></li>         
        </ul>
    </div>

    <!-- Contenu personnalisé -->
    <div class="flex-1 bg-gray-200 p-4">
        

    </div>
</div>


<script src="./../../assets/js/DirectorHead.js"></script>
   
</body>
</html>
 