#  FitManager – Gestion des cours & équipements sportifs

Mini-système permettant de gérer les **cours** et les **équipements** d’une salle de sport.  
Le projet inclut un **CRUD complet**, un **dashboard**, et une **base de données structurée**.

---

##  Structure du projet

```PROJECTFRST/
│
├── index.php 
│
├── pages/
│ ├── editCours.php
│ └── editEquipement.php 
│
├── sources/
│ ├── components/ 
│ └── db/
│ └── connection.php 
│
└── outils/ 
```



---

##  Fonctionnalités du projet

###  1. Modélisation (ERD)

Création d’un diagramme ERD contenant :

#### **Entités principales :**
- `cours`
- `equipements`

#### **Relations :**
- Relation **1-N** entre catégories → cours  
- (Optionnel) Relation **N-N** via `cours_equipements`

#### **Éléments définis :**
- Clés primaires  
- Clés étrangères  
- Contraintes (`NOT NULL`, `DEFAULT`, etc.)

---

##  2. Base de données

### 🔹 Tables obligatoires
- `cours`
- `equipements`

### 🔹 Exemple des champs

#### **Table `cours`**
- nom  
- catégorie  
- date  
- heure  
- durée  
- max_participants  

#### **Table `equipements`**
- nom  
- type  
- quantité  
- état (bon / moyen / à remplacer)



##  3. Dashboard (index.php)

Le tableau de bord affiche :

- ✔ Total des cours  
- ✔ Total des équipements  
-  Répartition des cours par catégorie  
-  Répartition des équipements par type  
-  (Optionnel) Graphique visuel  

---

##  4. Gestion des cours – CRUD complet

### ✔ Affichage
Tableau contenant :
- nom  
- catégorie  
- date  
- heure  
- durée  
- max participants  

### ✔ Ajout
Formulaire complet pour ajouter un cours.

### ✔ Modification
Page dédiée : `editCours.php`.

### ✔ Suppression


---

##  5. Gestion des équipements – CRUD complet

### ✔ Affichage
Tableau contenant :
- nom  
- type  
- quantité  
- état  

### ✔ Ajout
Formulaire pour insérer un équipement.

### ✔ Modification
Page dédiée : `editEquipement.php`.

### ✔ Suppression
Avec vérification.

### ✔ Validation
Contrôle des champs obligatoires.

---

##  Technologies utilisées

- PHP  
- MySQL  
- TailwindCSS  
- HTML / CSS  
- XAMPP / WAMP  
- VS Code  

---