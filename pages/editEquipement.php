<!-- Equipment Modal -->
<div id="equipmentModal" class="hidden fixed inset-0 bg-black/50 modal-backdrop flex items-center justify-center z-50">
    <div class="modal-content bg-slate-900 rounded-xl border border-slate-800 p-8 w-full max-w-md">
        <h3 class="text-2xl font-bold mb-6 text-slate-100">Ajouter un Équipement</h3>
        <form id="equipmentForm" method="POST" action="" class="space-y-4">
            <input type="hidden" name="form_type" value="add_equipement">
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Nom de l'Équipement *</label>
                <input name="nom_equipement" type="text" id="equipmentName" required class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-slate-100 placeholder-slate-500 focus:border-cyan-500 focus:outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Type *</label>
                <select name="type_equipement" id="equipmentType" required class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-slate-100 focus:border-cyan-500 focus:outline-none transition-all">
                    <option value="">Sélectionner</option>
                    <option value="Tapis de course">Tapis de course</option>
                    <option value="Haltères">Haltères</option>
                    <option value="Ballons">Ballons</option>
                    <option value="Tapis">Tapis</option>
                    <option value="Vélo Stationnaire">Vélo Stationnaire</option>
                    <option value="Rameur">Rameur</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Quantité *</label>
                <input name="quantite_equipement" type="number" id="equipmentQuantity" required min="1" class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-slate-100 focus:border-cyan-500 focus:outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">État *</label>
                <select name="etat_equipement" id="equipmentCondition" required class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-slate-100 focus:border-cyan-500 focus:outline-none transition-all">
                    <option value="">Sélectionner</option>
                    <option value="Bon">Bon</option>
                    <option value="Moyen">Moyen</option>
                    <option value="À remplacer">À remplacer</option>
                </select>
            </div>
            <div class="flex gap-3 pt-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-cyan-500 to-cyan-600 text-white px-4 py-2 rounded-lg font-medium hover:from-cyan-600 hover:to-cyan-700 transition-all">
                    Enregistrer
                </button>
                <button type="button" onclick="closeEquipmentModal()" class="flex-1 bg-slate-800 text-slate-300 px-4 py-2 rounded-lg font-medium hover:bg-slate-700 transition-all">
                    Annuler
                </button>
            </div>
        </form>
    </div>
</div>