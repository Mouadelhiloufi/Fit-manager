<?php
include("sources/db/connection.php");
?>



<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST" )  {
        if (isset($_POST['form_type']) && $_POST['form_type'] === "add_cours"){
    $nom=$_POST['nom_cours'];
    $categorie=$_POST['categorie_cours'];
    $date=$_POST['date_cours'];
    $heure=$_POST['heure_cours'];
    $duree=$_POST['dure_cours'];
    $max=$_POST['max_cours'];
        $sql="INSERT INTO cours(`nom`,`category`,`date`,`heure`,`duree`,`nombre_max`)
        VALUES('$nom','$categorie','$date','$heure','$duree','$max')";
        $result=mysqli_query($conn,$sql);


            header("Location: index.php");
            exit();
        }
}


?>




<?php 
    
if ($_SERVER["REQUEST_METHOD"] === "POST")  {
    if(isset($_POST['form_type']) && $_POST['form_type'] === "add_equipement"){
    $nom= $_POST['nom_equipement'];
    $type= $_POST['type_equipement'];
    $quantite= $_POST['quantite_equipement'];
    $etat= $_POST['etat_equipement'];
    $sql="INSERT INTO equipement (`nom`,`type`,`quantite`,`etat`)
    VALUES('$nom','$type','$quantite','$etat')";
    $result=mysqli_query($conn,$sql);
    header("Location: index.php");
    exit();
    }
}

?>

<?php
    if(isset($_GET['del_id'])){
        $id_equipement=$_GET['del_id'];
        $sql="DELETE FROM equipement WHERE id='$id_equipement'";
        mysqli_query($conn,$sql);


    }

?>






<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitHub - Gestion Salle de Sport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .nav-active {
            background: linear-gradient(135deg, #6366f1 0%, #06b6d4 100%);
            color: white;
        }
        .action-btn {
            cursor: pointer;
            text-decoration: underline;
            transition: all 0.3s ease;
        }
        .badge-good {
            background-color: #10b98120;
            color: #10b981;
        }
        .badge-fair {
            background-color: #f59e0b20;
            color: #f59e0b;
        }
        .badge-replace {
            background-color: #ef444420;
            color: #ef4444;
        }
        .stat-card {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        .stat-card:hover {
            border-color: #6366f1;
            transform: translateY(-2px);
        }
        .modal-backdrop {
            backdrop-filter: blur(4px);
        }
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .modal-content {
            animation: slideIn 0.3s ease;
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 font-sans">

<div class="flex h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-slate-900 border-r border-slate-800 p-6 flex flex-col">
        <div class="mb-12">
            <h1 class="text-2xl font-bold bg-gradient-to-r from-indigo-400 to-cyan-400 bg-clip-text text-transparent">FitHub</h1>
            <p class="text-slate-400 text-sm mt-1">Gestion Salle de Sport</p>
        </div>

        <nav class="space-y-4 flex-1">
            <a href="#" onclick="showPage('dashboard')" class="nav-link nav-active block px-4 py-3 rounded-lg text-sm font-medium transition-all">
                📊 Tableau de Bord
            </a>
            <a href="#" onclick="showPage('courses')" class="nav-link block px-4 py-3 rounded-lg text-sm font-medium text-slate-400 hover:text-slate-200 transition-all">
                🏋️ Gestion des Cours
            </a>
            <a href="#" onclick="showPage('equipment')" class="nav-link block px-4 py-3 rounded-lg text-sm font-medium text-slate-400 hover:text-slate-200 transition-all">
                ⚙️ Gestion des Équipements
            </a>
        </nav>

        <div class="text-xs text-slate-500 border-t border-slate-800 pt-4">
            © 2025 FitHub. Tous droits réservés.
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 overflow-auto">
        <!-- Header -->
        <header class="bg-slate-900 border-b border-slate-800 px-8 py-6 sticky top-0 z-10">
            <h2 id="page-title" class="text-3xl font-bold bg-gradient-to-r from-indigo-400 to-cyan-400 bg-clip-text text-transparent">Tableau de Bord</h2>
        </header>

        <!-- Content Area -->
        <main class="p-8 max-w-7xl mx-auto">

            <!-- Dashboard Page -->
            <div id="dashboard-page" class="page-content">
                <div class="grid grid-cols-4 gap-6 mb-8">
                    <div class="stat-card bg-slate-900 rounded-xl p-6 border border-slate-800">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-slate-400 text-sm font-medium">Cours Total</p>
                               <p id="total-courses" class="text-4xl font-bold bg-gradient-to-r from-indigo-400 to-indigo-500 bg-clip-text text-transparent mt-2">
    <?php 
        // Requête SQL
        $sql = "SELECT COUNT(*) AS total FROM cours";

        // Exécution de la requête
        $result = mysqli_query($conn, $sql);

        // Conversion en array
        $row = mysqli_fetch_assoc($result);

        // Afficher la valeur
        echo $row['total'];
    ?>    
</p>

                            </div>
                            <div class="text-4xl">🎓</div>
                        </div>
                    </div>

                    <div class="stat-card bg-slate-900 rounded-xl p-6 border border-slate-800">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-slate-400 text-sm font-medium">Équipements</p>
                                <p id="total-equipment" class="text-4xl font-bold bg-gradient-to-r from-cyan-400 to-cyan-500 bg-clip-text text-transparent mt-2">

                                <?php
                                $sql= "SELECT count(*) AS totale from equipement";
                                $res=mysqli_query($conn,$sql);
                                $row=mysqli_fetch_assoc($res);

                                echo $row['totale'];
                                ?>

                                </p>
                            </div>
                            <div class="text-4xl">⚙️</div>
                        </div>
                    </div>

                    <div class="stat-card bg-slate-900 rounded-xl p-6 border border-slate-800">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-slate-400 text-sm font-medium">Cours Actifs</p>
                                <p id="active-courses" class="text-4xl font-bold bg-gradient-to-r from-pink-400 to-pink-500 bg-clip-text text-transparent mt-2">0</p>
                            </div>
                            <div class="text-4xl">🔥</div>
                        </div>
                    </div>

                    <div class="stat-card bg-slate-900 rounded-xl p-6 border border-slate-800">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-slate-400 text-sm font-medium">À Remplacer</p>
                                <p id="equipment-replace" class="text-4xl font-bold bg-gradient-to-r from-amber-400 to-amber-500 bg-clip-text text-transparent mt-2">0</p>
                            </div>
                            <div class="text-4xl">⚠️</div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-slate-900 rounded-xl p-6 border border-slate-800">
                        <h3 class="text-lg font-semibold text-slate-100 mb-4">Répartition des Cours</h3>
                        <canvas id="coursesChart"></canvas>
                    </div>
                    <div class="bg-slate-900 rounded-xl p-6 border border-slate-800">
                        <h3 class="text-lg font-semibold text-slate-100 mb-4">Répartition des Équipements</h3>
                        <canvas id="equipmentChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Courses Page -->
            <div id="courses-page" class="page-content hidden">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold">Liste des Cours</h3>
                    <button onclick="openCourseModal()" class="bg-gradient-to-r from-indigo-500 to-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:from-indigo-600 hover:to-indigo-700 transition-all">
                        + Ajouter un Cours
                    </button>
                </div>

                <div class="bg-slate-900 rounded-xl border border-slate-800 overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-slate-800 border-b border-slate-700">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Nom</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Catégorie</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Date</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Heure</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Durée (min)</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Participants</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Actions</th>
                            </tr>

                            <?php
                            $sql="SELECT * FROM COURS";
                            $result=mysqli_query($conn,$sql);
                            while($rows=mysqli_fetch_assoc($result)){
                                echo'<tr>';
                               echo '<th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">'.$rows['nom'].'</th>';
                               echo '<th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">'.$rows['category'].'</th>';
                            echo '<th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">'.$rows['date'].'</th>';
                               echo '<th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">'.$rows['heure'].'</th>';
                                echo'<th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">'.$rows['duree'].'</th>';
                                echo'<th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">'.$rows['nombre_max'].'</th>';
                                echo'<th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Actions</th>';
                            echo'</tr>';
                            }



                            ?>

                        </thead>
                        <tbody id="courses-table-body" class="divide-y divide-slate-700">
                            <!-- Populate from backend -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Equipment Page -->
            <div id="equipment-page" class="page-content hidden">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold">Liste des Équipements</h3>
                    <button onclick="openEquipmentModal()" class="bg-gradient-to-r from-cyan-500 to-cyan-600 text-white px-6 py-2 rounded-lg font-medium hover:from-cyan-600 hover:to-cyan-700 transition-all">
                        + Ajouter un Équipement
                    </button>
                </div>

                <div class="bg-slate-900 rounded-xl border border-slate-800 overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-slate-800 border-b border-slate-700">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Nom</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Type</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Quantité</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">État</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Actions</th>
                            </tr>
                            <?php
                            $sql="SELECT * FROM equipement";
                            $result=mysqli_query($conn,$sql);
                            while($rows=mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            echo '<th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">'.$rows['nom'].'</th>';
                            echo '<th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">'.$rows['type'].'</th>';
                            echo '<th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">'.$rows['quantite'].'</th>';
                            echo '<th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">'.$rows['etat'].'</th>';
                            echo '<th class="px-6 py-4 text-left text-sm font-semibold text-slate-300 flex gap-3"><button class="text-red-400"><a href="?del_id='.$rows['id'].'">delete</a></button>
                            <button class="text-yellow-400"><a href="editEquipement.php">Edit</a></button>
                            </th>';
                            echo '</tr>';
                            }
                            ?>
                        </thead>
                        <tbody id="equipment-table-body" class="divide-y divide-slate-700">
                            <!-- Populate from backend -->
                             
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</div>

<!-- Course Modal -->
<div id="courseModal" class="hidden fixed inset-0 bg-black/50 modal-backdrop flex items-center justify-center z-50">
    <div class="modal-content bg-slate-900 rounded-xl border border-slate-800 p-8 w-full max-w-md">
        <h3 class="text-2xl font-bold mb-6 text-slate-100">Ajouter un Cours</h3>
        <form method="POST" action="" id="courseForm" class="space-y-4">
            <input type="hidden" name="form_type" value="add_cours">
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Nom du Cours *</label>
                <input  name="nom_cours" type="text" id="courseName"  required class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-slate-100 placeholder-slate-500 focus:border-indigo-500 focus:outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Catégorie *</label>
                <select name="categorie_cours" id="courseCategory" required class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-slate-100 focus:border-indigo-500 focus:outline-none transition-all">
                    <option value="">Sélectionner</option>
                    <option value="Yoga">Yoga</option>
                    <option value="Musculation">Musculation</option>
                    <option value="Cardio">Cardio</option>
                    <option value="Pilates">Pilates</option>
                    <option value="Zumba">Zumba</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Date *</label>
                <input name="date_cours" type="date" id="courseDate" required class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-slate-100 focus:border-indigo-500 focus:outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Heure *</label>
                <input name="heure_cours" type="time" id="courseTime" required class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-slate-100 focus:border-indigo-500 focus:outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Durée (minutes) *</label>
                <input name="dure_cours" type="number" id="courseDuration" required min="15" class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-slate-100 focus:border-indigo-500 focus:outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Nombre de Participants *</label>
                <input name="max_cours" type="number" id="courseParticipants" required min="1" class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-slate-100 focus:border-indigo-500 focus:outline-none transition-all">
            </div>
            <div class="flex gap-3 pt-4">
                <button type="submit"  class="flex-1 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white px-4 py-2 rounded-lg font-medium hover:from-indigo-600 hover:to-indigo-700 transition-all">
                    Enregistrer
                </button>
                <button type="button" onclick="closeCourseModal()" class="flex-1 bg-slate-800 text-slate-300 px-4 py-2 rounded-lg font-medium hover:bg-slate-700 transition-all">
                    Annuler
                </button>
            </div>
        </form>
    </div>
</div>



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



<script>
    
    function showPage(page) {
        event.preventDefault();
        document.querySelectorAll('.page-content').forEach(el => el.classList.add('hidden'));
        document.getElementById(page + '-page').classList.remove('hidden');
        
        document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('nav-active'));
        event.target.classList.add('nav-active');
        
        const titles = {
            'dashboard': 'Tableau de Bord',
            'courses': 'Gestion des Cours',
            'equipment': 'Gestion des Équipements'
        };
        document.getElementById('page-title').textContent = titles[page];
    }

    function openCourseModal() {
        document.getElementById('courseModal').classList.remove('hidden');
    }

    function closeCourseModal() {
        document.getElementById('courseModal').classList.add('hidden');
        document.getElementById('courseForm').reset();
    }

    function submitCourseForm() {
        const formData = {
            name: document.getElementById('courseName').value,
            category: document.getElementById('courseCategory').value,
            date: document.getElementById('courseDate').value,
            time: document.getElementById('courseTime').value,
            duration: document.getElementById('courseDuration').value,
            participants: document.getElementById('courseParticipants').value
        };
        
        console.log('[v0] Course data ready for backend:', formData);
        alert('Formulaire valide ! Envoyez les données à votre backend PHP.\n\n' + JSON.stringify(formData, null, 2));
        closeCourseModal();
    }

    function openEquipmentModal() {
        document.getElementById('equipmentModal').classList.remove('hidden');
    }

    function closeEquipmentModal() {
        document.getElementById('equipmentModal').classList.add('hidden');
        document.getElementById('equipmentForm').reset();
    }

    function submitEquipmentForm() {
        const formData = {
            name: document.getElementById('equipmentName').value,
            type: document.getElementById('equipmentType').value,
            quantity: document.getElementById('equipmentQuantity').value,
            condition: document.getElementById('equipmentCondition').value
        };
        
        console.log('[v0] Equipment data ready for backend:', formData);
        alert('Formulaire valide ! Envoyez les données à votre backend PHP.\n\n' + JSON.stringify(formData, null, 2));
        closeEquipmentModal();
    }
</script>
</body>
</html>
