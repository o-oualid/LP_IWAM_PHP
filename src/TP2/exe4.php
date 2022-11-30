<style>
    .error {
        color: red;
    }
</style>

<?php

?>
<form method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>Vos Coordonnées</legend>
        <label>
            Nom:<input type="text" name="nom">
        </label>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST["nom"]))
                echo '<span class="error">Le nom ne doit pas etre vide!</span>';
            else if (!preg_match("/^[a-zA-Z]{1,}$/", $_POST["nom"]))
                echo '<span class="error">Le nom doit contient seulement des alphabet!</span>';
        }
        ?>
        <br>
        <label>
            Prénom:<input type="text" name="prenom">
        </label>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST["prenom"]))
                echo '<span class="error">Le prénom ne doit pas etre vide!</span>';
            else if (!preg_match("/^[a-zA-Z]{1,}$/", $_POST["prenom"]))
                echo '<span class="error">Le prénom doit contient seulement des alphabet!</span>';
        }
        ?>
        <br>
        <label>
            Email:<input type="text" name="email"><!--The type should be email but it's text for testing purposes-->
        </label>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST["email"]))
                echo '<span class="error">L\'email ne doit pas etre vide!</span>';
            else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
                echo '<span class="error">L\'email doit etre valide!</span>';
        }
        ?>
        <br>
        <label>
            Password:<input type="password" name="password">
        </label>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST["password"]))
                echo '<span class="error">Le mot de pass ne doit pas etre vide!</span>';
            else if (!preg_match("/^(?=.*[^a-zA-Z0-9])(?=.*[0-9])(?=.*\w).{8,}$/", $_POST["password"]))
                echo '<span class="error">le mot de passe doit comporter au moins 8 caractères et contenir des chiffres et des caractères spéciaux!</span>';
        }
        ?><br>
        <label>
            Garçon:<input type="radio" name="sex" value="H">
        </label>
        <label>
            Fille:<input type="radio" name="sex" value="F">
        </label>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST["sex"]))
                echo '<span class="error">Selectioner votre sex!</span>';
        }
        ?>
        <br>
        <label>
            Semestre:
            <select name="semestre">
                <option selected disabled value="">select</option>
                <option>Semestre 1</option>
                <option>Semestre 2</option>
                <option>Semestre 3</option>
                <option>Semestre 4</option>
                <option>Semestre 5</option>
                <option>Semestre 6</option>
            </select>
        </label>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST["semestre"]) || $_POST["semestre"] == "")
                echo '<span class="error">Selectioner la semestre!</span>';
        }
        ?>
    </fieldset>
    <fieldset>
        <legend>Formations</legend>
        <label>
            <input type="checkbox" name="formations[]" value="Licence Fondamentale">
            Licence Fondamentale
        </label><br>
        <label>
            <input type="checkbox" name="formations[]" value="Licence Professionelle">
            Licence Professionelle
        </label><br>
        <label>
            <input type="checkbox" name="formations[]" value="Master Fondamentale">
            Master Fondamentale
        </label><br>
        <label>
            <input type="checkbox" name="formations[]" value="Master Professionelle">
            Master Professionelle
        </label><br>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST["formations"]) || $_POST["formations"] = [])
                echo '<span class="error">Selectioner vos formation</span><br>';
        }
        ?>
        <textarea name="notes"></textarea>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST["notes"]) || $_POST["notes"] == "")
                echo '<span class="error">notes ne doit pas etre vide!</span>';
        }
        ?>
    </fieldset>

    <fieldset>
        <legend>Envoyer nous une copie de vos Diplômes</legend>
        <input type="file" name="file"><br>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_FILES["file"]))
                echo '<span class="error">Le diplôme ne doit doit pas etre vide!</span>';
            else {
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                if (!array_search(
                    $finfo->file($_FILES['file']['tmp_name']),
                    array(
                        'png' => 'image/png',
                        'pdf' => 'application/pdf',
                        'doc' => 'application/msword'
                    ),
                    true
                )) echo '<span class="error">Le diplôme doit etre de type .pdf, .png ou .doc!</span>';

            }
        }
        ?>
        <input type="reset">
        <input type="submit">
    </fieldset>
</form>