<?php
/*
 * CKFinder
 * ========
 * http://cksource.com/ckfinder
 * Copyright (C) 2007-2013, CKSource - Frederico Knabben. All rights reserved.
 *
 * The software, this file and its contents are subject to the CKFinder
 * License. Please read the license.txt file before using, installing, copying,
 * modifying or distribute this file or part of its contents. The contents of
 * this file is part of the Source Code of CKFinder.
 */
if (!defined('IN_CKFINDER')) exit;

/**
 * @package CKFinder
 * @subpackage CommandHandlers
 * @copyright CKSource - Frederico Knabben
 */

/**
 * Include base XML command handler
 */
require_once CKFINDER_CONNECTOR_LIB_DIR . "/CommandHandler/XmlCommandHandlerBase.php";

/**
 * Handle CreateFolder command
 *
 * @package CKFinder
 * @subpackage CommandHandlers
 * @copyright CKSource - Frederico Knabben
 */
class CKFinder_Connector_CommandHandler_CreateFolder extends CKFinder_Connector_CommandHandler_XmlCommandHandlerBase
{
    public function urlToTranslit($text)
    {
        $tr = array(
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D',
            'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I',
            'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N',
            'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
            'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C', 'Ч' => 'Ch',
            'Ш' => 'Sh', 'Щ' => 'W', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '',
            'Э' => 'Ye', 'Ю' => 'Yu', 'Я' => 'Ya',
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',
            'е' => 'e', 'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i',
            'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
            'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
            'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch',
            'ш' => 'sh', 'щ' => 'w', 'ъ' => '', 'ы' => 'y', 'ь' => '',
            'э' => 'ye', 'ю' => 'yu', 'я' => 'ya',
            '!' => '', '@' => '', '#' => '', '$' => '', '%' => '',
            '^' => '', '&' => '', '*' => '', '(' => '', ')' => '',
            '"' => '', ' ' => '_', ';' => '', ':' => '', '?' => '',
            '[' => '', ']' => '', '{' => '', '}' => '', '\'' => '',
            ',' => '', '/' => '', '<' => '', '>' => '',
            '\\' => '', '|' => '', '=' => '', '+' => '',
            '№' => '',
        );

        return strtr($text, $tr);
    }

    /**
     * Command name
     *
     * @access private
     * @var string
     */
    private $command = "CreateFolder";

    /**
     * handle request and build XML
     * @access protected
     *
     */
    protected function buildXml()
    {
        if (empty($_POST['CKFinderCommand']) || $_POST['CKFinderCommand'] != 'true') {
            $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_INVALID_REQUEST);
        }

        $_config =& CKFinder_Connector_Core_Factory::getInstance("Core_Config");
        if (!$this->_currentFolder->checkAcl(CKFINDER_CONNECTOR_ACL_FOLDER_CREATE)) {
            $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_UNAUTHORIZED);
        }

        $_resourceTypeConfig = $this->_currentFolder->getResourceTypeConfig();
        $sNewFolderName = isset($_GET["NewFolderName"]) ? $_GET["NewFolderName"] : "";
        $sNewFolderName = $this->urlToTranslit($sNewFolderName);
        $sNewFolderName = CKFinder_Connector_Utils_FileSystem::convertToFilesystemEncoding($sNewFolderName);
        if ($_config->forceAscii()) {
            $sNewFolderName = CKFinder_Connector_Utils_FileSystem::convertToAscii($sNewFolderName);
        }

        if (!CKFinder_Connector_Utils_FileSystem::checkFolderName($sNewFolderName) || $_resourceTypeConfig->checkIsHiddenFolder($sNewFolderName)) {
            $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_INVALID_NAME);
        }

        $sServerDir = CKFinder_Connector_Utils_FileSystem::combinePaths($this->_currentFolder->getServerPath(), $sNewFolderName);
        if (!is_writeable($this->_currentFolder->getServerPath())) {
            $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_ACCESS_DENIED);
        }

        $bCreated = false;

        if (file_exists($sServerDir)) {
            $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_ALREADY_EXIST);
        }

        if ($perms = $_config->getChmodFolders()) {
            $oldUmask = umask(0);
            $bCreated = @mkdir($sServerDir, $perms);
            umask($oldUmask);
        }
        else {
            $bCreated = @mkdir($sServerDir);
        }

        if (!$bCreated) {
            $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_ACCESS_DENIED);
        } else {
            $oNewFolderNode = new Ckfinder_Connector_Utils_XmlNode("NewFolder");
            $this->_connectorNode->addChild($oNewFolderNode);
            $oNewFolderNode->addAttribute("name", CKFinder_Connector_Utils_FileSystem::convertToConnectorEncoding($sNewFolderName));
        }
    }
}
