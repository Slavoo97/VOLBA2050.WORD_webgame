<?php
declare(strict_types=1);

/**
 * This file is part of the 2050 project.
 * Copyright (c) 2023 Slavomír Švigar <slavo.svigar@gmail.com>
 */

namespace App\Presenters;

use Nette;

class HomepagePresenter extends Nette\Application\UI\Presenter
{
    public function renderDefault($eventKey)
    {
        if ($this->session->isStarted()){
            $this->session->destroy();
        }
        $this->template->eventKey = $eventKey;
    }
}
