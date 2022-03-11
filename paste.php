
                        if (($_GET['cat']) === 'Bières bouteilles'){
                        echo choixUniques('bieresbouteilles');
                        if (!empty($_POST)){
                        $add = addToSql('bieresbouteilles', $_POST);
                        }
                        }

                        if (($_GET['cat']) === 'Cocktails'){
                            echo choixUniques('cocktails');
                            if (!empty($_POST)){
                            $add = addToSql('cocktails', $_POST);
                            }
                        }

                        if (($_GET['cat']) === 'Whiskys'){
                        echo choixUniques('whiskys');
                        if (!empty($_POST)){
                            $add = addToSql('whiskys', $_POST);
                        }
                        }

                        if (($_GET['cat']) === 'Alcools'){
                            echo choixUniques('alcools');
                            if (!empty($_POST)){
                            $add = addToSql('alcools', $_POST);
                            }
                        }

                        if (($_GET['cat']) === 'Softs'){
                            echo choixUniques('Softs');
                            if (!empty($_POST)){
                                $add = addToSql('Softs', $_POST);
                            }
                        }
                        if (($_GET['cat']) === 'Boissons chaudes'){
                            echo choixUniques('boissonschaudes');
                            if (!empty($_POST)){
                                $add = addToSql('boissonschaudes', $_POST);
                            }
                        }











                        <?php if (($_GET['cat']) === 'Diluants'):?>
            <form action='' class='form-control' method='POST'>
            <label for='diluants'>Diluants</label>
            <input class='me-4' type='text' name='diluants' placeholder='Diluants disponible' required>
            <button class='btn btn-info mb-3 mt-3'>Valider</button>
            </form>";
            <?php  if (!empty($_POST)){
                $query = "INSERT INTO diluants (id,diluant) VALUES (null,'$_POST[diluants]')";
                $add = $pdo->query($query);
            }?>
        <?php else : ?>







            <form action=''  class='form-control' method='POST'>
                <label for='name'>Nom du produit</label>
                <input type='text' class='form-control' name='name' placeholder='Mon super produit' value="<?= htmlentities($_POST['name']?? '' )?>" required >
                <label for='description'>Description du produit</label>
                <textarea class='form-control mb-3' name='description' placeholder='Voici mon super produit' value='<?= htmlentities($_POST['description']?? '' )?>' required ></textarea>
                <label for='image' class='form-label'>Photo du produit</label>
                <input class='form-control mb-3' type='file' name='image'>