<?php

namespace App\Presenters;

use Nette\Application\UI\Form;

/**
 * Presenter pro hlavní obrazovku aplikace.
 * 
 * @author Stefan Veres
 */
class FirstpagePresenter extends BasePresenter {

    private $invalideInput = false;

    /**
     *
     * @var \App\Model\T_USERRepository
     * @inject
     */
    public $userRepo;
    private $users = array();
    private $comboNames = array();
    private $uid;
    private $fn;
    private $ln;
    private $by;

    public function startup() {
        parent::startup();
        $this->users = $this->userRepo->findAllUsers();
        $this->comboNames = $this->userRepo->getComboNames();
    }

    public function renderFirstpage() {
        $this->template->users = $this->users;
        $this->template->comboNames = $this->comboNames;
        $this->template->invalideInput = $this->invalideInput;
    }

    /**
     * Vytvoreni formulare
     * 
     * @return \Nette\Application\UI\Form
     */
    public function createComponentComboUsers() {

        $ar = array_combine($this->comboNames, $this->comboNames);
        $form = new Form;
        $form->addSelect('userko', 'Uživatel:', $ar);
        $form->addSubmit('vybrat', 'Vybrat');
        $form->onSuccess[] = $this->chooseUser;

        return $form;
    }

    /**
     * Kontrola jestli jsou vstupné data v poriadku.
     */
    public function chooseUser($form) {
        if (filter_input(\INPUT_POST, 'vybrat')) {
            $val = $form->values;
            $vala = $val->userko;
            $uid = $this->userRepo->getIdFromComboName($vala);
            $this->updateUser($uid);
        }
    }

    public function updateUser($uid) {
        //echo "<div id=patickaR>*".$uid."*</div>";
        $this->uid = $uid;
        //echo "<div id=patickaRR>*uid:".$this->uid."*</div>";

        $this->fn = $this->userRepo->getUserFn($uid);
        $this->ln = $this->userRepo->getUserLn($uid);
        $this->by = $this->userRepo->getUserBy($uid);
    }

    /**
     * Vytvoreni formulare
     * 
     * @return \Nette\Application\UI\Form
     */
    public function createComponentChangeUser() {

        $form = new Form;
        $form->getElementPrototype()->class('form');
        $form->addText('fn', 'Jméno:');
        $form->addText('ln', 'Příjmení:');
        $form->addText('by', 'Rok Narození:');
        $form->setDefaults(array(
            'fn' => $this->fn,
            'ln' => $this->ln, //$ln,
            'by' => $this->by//$by
        ));
        $form->addHidden('uid', $this->uid);
        $form->addSubmit('change', 'Ulož');
        $form->addSubmit('delete', 'Zmaž');

        $form->onSuccess[] = $this->ulozZmeny;

        return $form;
    }

    public function ulozZmeny($form) {
        $val = $form->values;
        //echo "<div id=patickaR>pat_uid:*".$this->uid."*</div>";
        //echo "<div id=patickaRR>val_uid:*".$val->uid."*</div>";

        if (filter_input(\INPUT_POST, 'change')) {
            if (($val->uid == '' || $val->uid == null)) {
                $this->checkUser($form);
            } else {
                $this->userRepo->updateValuesUser($val->uid, $val->fn, $val->ln, $val->by);
                $this->presenter->redirect('Firstpage:firstpage');
            }
        } elseif (filter_input(\INPUT_POST, 'delete')) {
            if (($val->uid == '' || $val->uid == null)) {
                $this->presenter->redirect('Firstpage:firstpage');
            } else{
                $this->userRepo->removeUser($val->uid);
                $this->presenter->redirect('Firstpage:firstpage');
            }
        }
    }

    /**
     * Kontrola jestli jsou vstupné data v poriadku.
     */
    public function checkUser($form) {

        $val = $form->values;

        if (!($val->fn == '' || $val->fn == null || $val->ln == '' ||
                $val->ln == null || $val->by == '' || $val->by == null)) {

            //ulozeni hodnot do DB:
            $this->userRepo->addUser($form);
            $this->invalideInput = false;

            $this->presenter->redirect('Firstpage:firstpage');
        } else {
            $this->invalideInput = true;
        }
    }

}
