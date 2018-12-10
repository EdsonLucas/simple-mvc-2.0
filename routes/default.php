<?php

    $this->get('home', function($arg) {
        $tpl = $this->core->loadModule('template');
        
        $array = array();
        $array['area'] = "home";

        $tpl->loadTemplate('home', $array);
    });

    $this->get('empresa', function($arg) {
        $tpl = $this->core->loadModule('template');
        
        $array = array();
        $array['area'] = "empresa";

        $tpl->loadTemplate('empresa', $array);
    });

    $this->get('servicos', function($arg) {
        $tpl = $this->core->loadModule('template');
        
        $array = array();
        $array['area'] = "servicos";

        $tpl->loadTemplate('servicos', $array);
    });

    $this->get('contato', function($arg) {
        $tpl = $this->core->loadModule('template');
        
        $array = array();
        $array['area'] = "contato";

        $tpl->loadTemplate('contato', $array);
    });

    $this->get('404', function($arg) {
        header("Location: home");
    });