<?php



$id = URL::getParameter('id');

if(!empty($id)) {



    $objProject = new Project();

    $industry = $objProject->getIndustry($id);



    if(!empty($industry)) {



        $form = new Form();

        $validation = new Valid($form);



        if ($form->isPost('name')) {



            $validation->expected = array('name');

            $validation->required = array('name');

            $name = $form->getPost('name');



            if($objProject->sameIndustry($name, $id)){

                $validation->addErrors('industry_exists');

            }



            if ($validation->isValid()) {

                if ($objProject->updateIndustry($name, $id)) {

                    Check::redirect(URL::getURL(array('action', 'id')) . '&action=edit-success');

                } else {

                    Check::redirect(URL::getURL(array('action', 'id')) . '&action=edit-failed');

                }

            }

        }



        require_once('template/header.php');

        require_once('template/nav.php');

        require_once('template/sidebar.php');

        ?>



        <!-- Page Content -->

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-12">

                        <h1 class="page-header">Редактирование новости</h1>

                    </div>

                </div>



                <div class="row">

                    <div class="col-lg-12">

                        <form action="" method="post">



                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label class="control-label" for="name">Отрасль</label>

                                        <?php echo $validation->validate('name'); ?>

                                        <?php echo $validation->validate('industry_exists'); ?>

                                        <input id="name" name="name" type="text" value="<?php echo $form->textField('name', $industry['name']); ?>" class="form-control input-md" required>

                                    </div>

                                </div>

                            </div>



                            <div class="row">

                                <div class="col-md-3">

                                    <div class="form-group">

                                        <button type="submit" class="btn btn-success">Редактировать</button>

                                    </div>

                                </div>

                            </div>



                        </form>

                    </div>

                </div>

            </div>

        </div>



        </div>

        <!-- /#wrapper -->



        <?php



        require_once('template/footer.php');

    }

}

?>







