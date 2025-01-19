<?php

// Récupération de la méthode soumise par le client
// GET ou POST.
$method = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET)) {
    $method = 'GET';
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $method = 'POST';
}


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Données soumises par le formulaire</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: rgb(236, 236, 236);
        }

        main {
            background-color: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <main class="col-12 col-sd-8 offset-sd-2">

                <div class="container mb-3">

                    <h1>Réception des données coté serveur</h1>

                    <div class="row mb-3">

                        <h2>Objectif de cette page</h2>
                        <p>
                            Le fichier <code>form_receiver.php</code> est chargé de traiter les données soumises par le formulaire. Lorsque le formulaire est soumis, les données sont envoyées à ce fichier qui les récupère et les traite.
                        </p>

                        <p>
                            Ici il n'y a pas de traitement particulier, nous nous contentons d'afficher les données soumises par le client à des fins de démonstration. La logique de ce fichier, de cette page, est assuré par le code PHP.
                        </p>

                        <p>
                            Le traitement des données coté serveur, avec PHP, sera vu plus tard dans le cours.
                        </p>

                    </div>



                    <h2>Données soumises par le formulaire</h2>

                    <div class="row mb-3">

                        <?php if (empty($method)) : ?>
                            <p class="alert alert-warning">Aucune donnée n'a été soumise par le client</p>
                        <?php else : ?>

                            <p>Les données suivantes ont été soumises par le client via la méthode <?= $method ?></p>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <code>
                                        &lt;form action="https://knightof.net/fac/form_receiver.php" method="<strong><?= $method ?></strong>"&gt;
                                        <br>
                                        ...
                                        <br>
                                        &lt;/form&gt;
                                    </code>
                                </div>
                            </div>

                        <?php endif; ?>

                    </div>


                    <div class="row mb-3">
                        <div class="col-12 col-md-6">

                            <h3>Données récupérées dans la variable PHP <code>$_POST</code></h3>

                            <?php if (isset($_POST) && !empty($_POST)) : ?>

                                <p>Champs du formulaire sous la forme :</p>
                                <code>
                                    <?php
                                    $firstPostParam = array_key_first($_POST);
                                    $firstPostParamValue = $_POST[$firstPostParam];
                                    if (is_array($firstPostParamValue)) {
                                        $firstPostParamValue = implode(', ', $firstPostParamValue);
                                        $firstPostParam .= '[]';
                                    }

                                    echo '&lt;input type="text" name="<strong>' . $firstPostParam . '</strong>" value="<strong>' . $firstPostParamValue . '</strong>"&gt;';
                                    ?>
                                </code>

                                <table class="table table-bordered mt-3">
                                    <thead>
                                        <tr>
                                            <th>Clé</th>
                                            <th>Valeur</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($_POST as $key => $value) : ?>
                                            <tr>
                                                <td><?= $key ?></td>
                                                <td>
                                                    <?php
                                                    if (is_array($value)) {
                                                        echo '<pre>' . print_r($value, true) . '</pre>';
                                                    } else {
                                                        echo $value;
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>


                                </table>

                            <?php else : ?>
                                <p class="alert alert-warning">Aucune donnée n'a été soumise par le client via la méthode POST</p>
                            <?php endif; ?>



                        </div>

                        <div class="col-12 col-md-6">

                            <h3>Données récupérées dans la variable PHP <code>$_GET</code></h3>

                            <?php if (isset($_GET) && !empty($_GET)) : ?>

                                <p>URL avec paramètres :</p>
                                <code>

                                    <?php
                                    echo $_SERVER['SCRIPT_URI'] . '?';
                                    $paramsGetFormatted = [];
                                    foreach ($_GET as $key => $value) {
                                        if (is_array($value)) {
                                            $arrayParamsFormatted = [];
                                            foreach ($value as $val) {
                                                $arrayParamsFormatted[] = $key . '[]=' . $val;
                                            }
                                            $paramsGetFormatted[] = '<strong>' . implode('&', $arrayParamsFormatted) . '</strong>';
                                        } else {
                                            $paramsGetFormatted[] = '<strong>' . $key . '=' . $value . '</strong>';
                                        }
                                        
                                    }
                                    echo implode('&', $paramsGetFormatted);
                                    ?>
                                </code>

                                <table class="table table-bordered mt-3">
                                    <thead>
                                        <tr>
                                            <th>Clé</th>
                                            <th>Valeur</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($_GET as $key => $value) : ?>
                                            <tr>
                                                <td><?= $key ?></td>
                                                <td>
                                                <?php
                                                    if (is_array($value)) {
                                                        echo '<pre>' . print_r($value, true) . '</pre>';
                                                    } else {
                                                        echo $value;
                                                    }
                                                    ?>                                                    
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>


                                </table>

                            <?php else : ?>

                                <p class="alert alert-warning">Aucune donnée n'a été soumise par le client via la méthode GET ou dans l'URL</p>
                            <?php endif; ?>



                        </div>
                    </div>


                    <div class="row mb-3">

                        <h2>Données du serveur</h2>

                        <h3>Données de la superglobale <code>$_SERVER</code></h3>

                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>Clé</th>
                                    <th>Valeur</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($_SERVER as $key => $value) : ?>
                                    <tr>
                                        <td><?= $key ?></td>
                                        <td><?= $value ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>

                </div>


            </main>
        </div>
    </div>




</body>

</html>