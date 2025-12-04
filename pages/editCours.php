<?php
include("../sources/db/connection.php");
?>

<?php
$id=$_GET['edite_id'];
$sql="SELECT * FROM cours WHERE id='$id'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
?>


<?php
    if(isset($_POST['Enregistrer'])){
        $nom=$_POST['nom_cours'];
        $category=$_POST['categorie_cours'];
        $date=$_POST['date_cours'];
        $heure=$_POST['heure_cours'];
        $duree=$_POST['dure_cours'];
        $max=$_POST['max_cours'];
        


        $sql="UPDATE cours SET 
        `nom`='$nom',
        `category`='$category',
        `date`='$date',
        `heure`='$heure',
        `duree`='$duree',
        `nombre_max`='$max'
        
        WHERE `id`='$id'";
        

        mysqli_query($conn,$sql);

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

<div id="courseModal" class=" overflow-y-auto inset-0 bg-black/50 modal-backdrop flex items-center justify-center z-50">
    <div class="modal-content bg-slate-900 rounded-xl border border-slate-800 p-8 w-full max-w-md">
        <h3 class="text-2xl font-bold mb-6 text-slate-100">Ajouter un Cours</h3>
        <form method="POST" action="" id="courseForm" class="space-y-4">
            <input type="hidden" name="form_type" value="add_cours">
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Nom du Cours *</label>
                <input  name="nom_cours" type="text" id="courseName" value="<?php echo $row['nom'] ?>"  required class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-slate-100 placeholder-slate-500 focus:border-indigo-500 focus:outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Catégorie *</label>
                <input name="categorie_cours" id="courseCategory" type="text" value="<?php echo $row['category'] ?>" required class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-slate-100 focus:border-indigo-500 focus:outline-none transition-all">
                    
</input>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Date *</label>
                <input name="date_cours" type="date" id="courseDate" value="<?php echo $row['date'] ?>" required class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-slate-100 focus:border-indigo-500 focus:outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Heure *</label>
                <input name="heure_cours" type="time" id="courseTime" value="<?php echo $row['heure'] ?>" required class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-slate-100 focus:border-indigo-500 focus:outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Durée (minutes) *</label>
                <input name="dure_cours" type="number" id="courseDuration" value="<?php echo $row['duree'] ?>" required min="15" class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-slate-100 focus:border-indigo-500 focus:outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Nombre de Participants *</label>
                <input name="max_cours" type="number" id="courseParticipants" value="<?php echo $row['nombre_max'] ?>" required min="1" class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-slate-100 focus:border-indigo-500 focus:outline-none transition-all">
            </div>
            <div class="flex gap-3 pt-4">
                <button type="submit" name="Enregistrer" class="flex-1 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white px-4 py-2 rounded-lg font-medium hover:from-indigo-600 hover:to-indigo-700 transition-all">
                    Enregistrer
                </button>
                <button type="button" onclick="closeCourseModal()" class="flex-1 bg-slate-800 text-slate-300 px-4 py-2 rounded-lg font-medium hover:bg-slate-700 transition-all">
                    Annuler
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
