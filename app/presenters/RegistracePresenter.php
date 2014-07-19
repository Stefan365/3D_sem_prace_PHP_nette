<?php

/**
 * Presenter pro registraci nového uživatele. Z přihlašovacích
 * nebo registračních údajů uživatele je vytvořena session.
 * 
 * @author Stefan Veres, 3D
 */

namespace App\Presenters;

use Nette\Application\UI\Form;

class RegistracePresenter extends BasePresenter {

    private $invalideInput = false;

    /**
     *
     * @var App\Model\T_USERRepository
     * @inject 
     */
    public $userRepo;

    /*
     * Registrace noveho uzivatele.
     */
    public function renderRegistrace() {
        //$this->userRepo->createTableUser();
        $this->template->invalideInput = $this->invalideInput;
    }

    /**
     * Vytvoreni formulare
     * 
     * @return \Nette\Application\UI\Form
     */
    public function createComponentRegistraceForm() {

        $form = new Form;
        $form->getElementPrototype()->class('form');
        $form->addText('fn', 'Jméno:');
        $form->addText('ln', 'Příjmení:');
        $form->addText('by', 'Rok Narození:');
        $form->addSubmit('send', 'Odeslat');
        $form->onSuccess[] = $this->checkUser;

        return $form;
    }

    /**
     * Kontrola jestli jsou vstupné data v poriadku.
     */
    public function checkUser($form) {

        if (filter_input(\INPUT_POST, 'send')) {
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
}
