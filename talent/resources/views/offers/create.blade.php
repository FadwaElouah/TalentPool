<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ajouter une Offre</title>

  <!-- ✅ CDN Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-100 min-h-screen">


  <div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto mt-10 p-8 bg-white rounded-2xl shadow-2xl border border-gray-200">
        <h2 class="text-3xl font-bold text-center text-indigo-600 mb-6">Ajouter une Offre d’Emploi</h2>

        <form action="/api/offres" method="POST" class="space-y-6">
            <!-- Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Titre de l'offre</label>
                <input type="text" name="title" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Ex: Développeur Web">
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="5" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Description de l'offre..."></textarea>
            </div>

            <!-- Localisation -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Localisation</label>
                <input type="text" name="location" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Ex: Casablanca">
            </div>

            <!-- Type de contrat -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Type de contrat</label>
                <select name="type" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">-- Choisir un type --</option>
                    <option value="CDI">CDI</option>
                    <option value="CDD">CDD</option>
                    <option value="Stage">Stage</option>
                    <option value="Freelance">Freelance</option>
                </select>
            </div>

            <!-- Salaire -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Salaire (optionnel)</label>
                <input type="number" name="salary" step="0.01" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Ex: 8000">
            </div>

            <!-- Deadline -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date limite</label>
                <input type="date" name="deadline" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Statut -->
            <div>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_active" class="form-checkbox text-indigo-600">
                    <span class="ml-2 text-gray-700">Activer cette offre</span>
                </label>
            </div>

            <!-- Bouton Submit -->
            <div class="text-center">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-xl font-semibold shadow hover:bg-indigo-700 transition duration-300">
                    Publier l’offre
                </button>
            </div>
        </form>
    </div>

  </div>

</body>
</html>
