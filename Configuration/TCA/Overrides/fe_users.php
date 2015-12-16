<?php

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

/**
 * Extend fe_users with another type to use for locations only.
 * Fields lice username and password will be removed.
 *
 * @author Daniel Siepmann <d.siepmann@web-vision.de>
 */

call_user_func(
    function ($extKey) {
        $coreLanguagePath = 'LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:';
        $languagePath = 'LLL:EXT:' . $extKey . '/Resources/Private/Language/Backend.xlf:';
        \TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
            $GLOBALS['TCA']['fe_users'],
            [
                'ctrl' => [
                    'label_alt' => 'company',
                ],
                'types' => [
                    'Tx_WvFeuserLocations_Domain_Model_Location' => [
                        'showitem' => 'company,address,zip,city,country,telephone,fax,email,www,lat,lng' .
                            ',--div--;' . $coreLanguagePath . 'fe_users.tabs.extended,image,tx_extbase_type,usergroup' .
                            ',--div--;' . $coreLanguagePath . 'fe_users.tabs.access,disable,starttime,endtime',
                    ],
                ],
                'columns' => [
                    'tx_extbase_type' => [
                        'config' => [
                            'items' => [
                                99 => [
                                    0 => $languagePath . 'model.location.type',
                                    1 => 'Tx_WvFeuserLocations_Domain_Model_Location',
                                ],
                            ],
                        ],
                    ],
                    'lat' => [
                        'label' => $languagePath . 'model.location.lat',
                        'config' => [
                            'type' => 'input',
                            'eval' => 'nospace,trim',
                        ],
                    ],
                    'lng' => [
                        'label' => $languagePath . 'model.location.lng',
                        'config' => [
                            'type' => 'input',
                            'eval' => 'nospace,trim',
                        ],
                    ],
                ],
            ]
        );
    },
    'wv_feuser_locations'
);
