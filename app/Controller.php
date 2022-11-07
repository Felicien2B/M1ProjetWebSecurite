<?php
abstract class Controller {
    public function loadModel(string $model)
    {
        require_once(ROOT.'models/'.$model.'.php');
        //instantiate the model 
        $this->$model = new $model();
    }

    public function render(string $fichier, array $data=[])
    {
        //extraire les données 
        extract($data);
        require_once(ROOT.'views/'.strtolower(get_class($this)).'/'.$fichier.'.php');
    }

}





?>