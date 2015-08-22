<?php

class DefaultController extends Controller {

    public $layout = false;

    public function actionIndex() {
        $this->render('index');
    }

}
