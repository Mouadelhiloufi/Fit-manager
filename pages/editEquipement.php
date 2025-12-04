<?php
include("../sources/db/connection.php");
?>

<?php
$id=$_GET['edit_id'];
$sql="SELECT * FROM equipement WHERE id='$id'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
?>


<?php
    if(isset($_POST['enregistrer'])){
        $nom=$_POST['nom_equipement'];
        $type=$_POST['type_equipement'];
        $quantite=$_POST['quantite_equipement'];
        $etat=$_POST['etat_equipement'];
        


        $sql="UPDATE equipement SET `nom`='$nom',
        `type`='$type',
        `quantite`='$quantite',
        `etat`='$etat'
        WHERE `id`='$id'";
        

        $result=mysqli_query($conn,$sql);
        header("location: ../index.php");
        exit;

    }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitHub - Gestion Salle de Sport</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<!-- Equipment Modal -->
<div id="equipmentModal" class=" fixed inset-0 bg-black/50 modal-backdrop flex items-center justify-center z-50">
    <div class="modal-content bg-slate-900 rounded-xl border border-slate-800 p-8 w-full max-w-md">
        <h3 class="text-2xl font-bold mb-6 text-slate-100">Ajouter un Équipement</h3>

        <form id="equipmentForm" method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Nom de l'Équipement *</label>
                <input name="nom_equipement" type="text"  value="<?php echo $row['nom'] ?>" id="equipmentName" required
                       class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-slate-100 placeholder-slate-500 focus:border-cyan-500 focus:outline-none transition-all">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Type *</label>
                <input name="type_equipement" type="text"  value="<?php echo $row['type'] ?>" id="equipmentType" required
                       class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-slate-100 placeholder-slate-500 focus:border-cyan-500 focus:outline-none transition-all">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Quantité *</label>
                <input name="quantite_equipement" value="<?php echo $row['quantite'] ?>" type="number" id="equipmentQuantity" required min="1"
                       class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-slate-100 focus:border-cyan-500 focus:outline-none transition-all">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">État *</label>
                <input name="etat_equipement" value="<?php echo $row['etat'] ?>" type="text" id="equipmentEtat" required min="1"
                       class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-slate-100 focus:border-cyan-500 focus:outline-none transition-all">
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" name="enregistrer"
                        class="flex-1 bg-gradient-to-r from-cyan-500 to-cyan-600 text-white px-4 py-2 rounded-lg font-medium hover:from-cyan-600 hover:to-cyan-700 transition-all">
                    Enregistrer
                </button>

                <button type="button" onclick="closeEquipmentModal()"
                        class="flex-1 bg-slate-800 text-slate-300 px-4 py-2 rounded-lg font-medium hover:bg-slate-700 transition-all">
                    Annuler
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
