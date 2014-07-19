<?php //netteCache[01]000380a:2:{s:4:"time";s:21:"0.76802600 1401861942";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:66:"C:\wamp\www\php_3d_prace\app\templates\Registrace\registrace.latte";i:2;i:1401752880;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:22:"released on 2014-03-17";}}}?><?php

// source file: C:\wamp\www\php_3d_prace\app\templates\Registrace\registrace.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'ypd3llbdeg')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb08666e8bf0_content')) { function _lb08666e8bf0_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    
    <link href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/css/newcss.css" rel="stylesheet" type="text/css">
<?php call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>
 
<?php if ($invalideInput) { ?>
        <h3 id=podmenu style="color : red ">Zadej prosim vsechna policka!</h3>
<?php } ?>
    
    <div>
<?php $_ctrl = $_control->getComponent("registraceForm"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->redrawControl(NULL, FALSE); $_ctrl->render() ?>
    </div>        
    
    <a id=patickaR href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($presenter->link('FirstPage:firstpage'))) ?>">Next</a>
    
<?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lbe464f9f65b_title')) { function _lbe464f9f65b_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <h3>Registrace uživatele</h3>
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
if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 