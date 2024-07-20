<!-- Inclure Tailwind CSS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<!-- Formulaire avec breakpoint à 700px (utilisation du breakpoint `md` de Tailwind CSS) -->
<div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md md:max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-center">Formulaire de modification d'une formation</h2>

    <form id="formValidate">
        <div class="md:grid md:grid-cols-2 md:gap-4">
            <div class="mb-4">
                <label for="newCodes" class="block text-gray-700 text-sm font-bold mb-2">Nouveau code :</label>
                <input type="text" id="newCodes" name="newCodes" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Nouveau code">
            </div>
            <div class="mb-4">
                <label for="newDescriptions" class="block text-gray-700 text-sm font-bold mb-2">Nouvelle Description :</label>
                <input type="text" id="newDescriptions" name="newDescriptions" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Nouvelle description">
                <span id="error" class="text-red-500 text-sm"></span>
            </div>
            <div class="mb-4">
                <label for="newPrices" class="block text-gray-700 text-sm font-bold mb-2">Nouveau prix :</label>
                <input type="text" id="newPrices" name="newPrices" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Nouveau prix">
            </div>
            <div class="mb-4">
                <label for="newduree" class="block text-gray-700 text-sm font-bold mb-2">Nouvelle Durée :</label>
                <input type="text" id="newduree" name="newduree" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Nouvelle durée">
            </div>
        </div>

        <div class="flex items-center justify-between mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Enregistrer
            </button>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Annuler
            </button>
        </div>
    </form>
</div>
