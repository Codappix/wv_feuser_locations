<?php
namespace Codappix\CdxFeuserLocations\Controller;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Codappix\CdxFeuserLocations\Domain\Repository\LocationRepository;

/**
 * Controller to display fe user records.
 */
class LocationController extends ActionController
{
    /**
     * @var LocationRepository
     */
    protected $repository;

    /**
     * @param LocationRepository $repository
     *
     * @return LocationController
     */
    public function injectRepository(LocationRepository $repository)
    {
        $this->repository = $repository;

        return $this;
    }

    /**
     * Deliver an index of fe users, optionally filtered.
     *
     * @return void
     */
    public function indexAction()
    {
        $this->assignVariablesToView([
            'locations' => $this->repository->findAll(),
        ]);
    }

    /**
     * Assign variables to view, triggers signal to manipulate variables.
     *
     * @param array $variables
     *
     * @return LocationController
     */
    public function assignVariablesToView(array $variables = [])
    {
        $variables['extendedVariables'] = [];
        $variables = $this->signalSlotDispatcher
            ->dispatch(
                get_class($this),
                'assignVariables.' . $this->actionMethodName,
                $variables
            );
        $this->view->assignMultiple($variables);

        return $this;
    }

    /**
     * Injects a view.
     *
     * This function is for testing purposes only.
     *
     * @param \TYPO3\CMS\Fluid\View\TemplateView $view
     *
     * @return LocationController
     */
    public function setView(\TYPO3\CMS\Fluid\View\TemplateView $view)
    {
        $this->view = $view;

        return $this;
    }
}
