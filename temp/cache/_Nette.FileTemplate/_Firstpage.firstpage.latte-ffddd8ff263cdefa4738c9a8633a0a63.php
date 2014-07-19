<?php //netteCache[01]000378a:2:{s:4:"time";s:21:"0.95736000 1402907450";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:64:"C:\wamp\www\php_3d_prace\app\templates\Firstpage\firstpage.latte";i:2;i:1402907447;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:22:"released on 2014-03-17";}}}?><?php

// source file: C:\wamp\www\php_3d_prace\app\templates\Firstpage\firstpage.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'cb60uezhkl')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb74ec66b6df_content')) { function _lb74ec66b6df_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><link href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/css/newcss.css" rel="stylesheet" type="text/css">

<?php call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>
<h3 id =hlavickaRR>Výběr uživatele</h3>
    
<?php if ($invalideInput) { ?>
        <h3 id=patickaR style="color : red ">Zadej prosim vsechna policka!</h3>
<?php } ?>

<div>
    <div>
        <table border="4">
            <tr>
                <td>*   ID   *</td> <td>*  JMÉNO  *</td> 
                <td>* PŘIJMĚNÍ *</td> <td>* ROK NAROZENÍ *</td>
            </tr>
<?php $iterations = 0; foreach ($users as $user) { ?>            <tr>
                <td><?php echo Nette\Templating\Helpers::escapeHtml($user->uid, ENT_NOQUOTES) ?></td>
                <td><?php echo Nette\Templating\Helpers::escapeHtml($user->first_name, ENT_NOQUOTES) ?></td>
                <td><?php echo Nette\Templating\Helpers::escapeHtml($user->last_name, ENT_NOQUOTES) ?></td>
                <td><?php echo Nette\Templating\Helpers::escapeHtml($user->birth_year, ENT_NOQUOTES) ?></td>
            </tr>
<?php $iterations++; } ?>
        </table>
    </div>
    <div id = podhlavickaRR>
<?php $_ctrl = $_control->getComponent("comboUsers"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->redrawControl(NULL, FALSE); $_ctrl->render() ?>
    </div>     
    
    <h3 id =menuRR>Registrace / změna údajů uživatele</h3>
    <div id = podmenuRR>
<?php $_ctrl = $_control->getComponent("changeUser"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->redrawControl(NULL, FALSE); $_ctrl->render() ?>
    </div>             
    
</div>
                
<a id=paticka href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($presenter->link('Registrace:registrace'))) ?>">Back</a>
<?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lbf1ffffea80_title')) { function _lbf1ffffea80_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h3>Výpis z tabuľky</h3>
<?php
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
?>

<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 