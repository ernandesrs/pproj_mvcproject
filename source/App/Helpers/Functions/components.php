<?php

/**
 * 
 * Funções para acesso rápido à instâncias de componentes em \Components
 * e alguns de seus métodos
 * 
 */

use Components\Message\Message;
use Components\Session\Session;
use Components\Uploader\Uploader;

/**
 * Components\Session\Session ***************************************
 */

/**
 * Instância
 * @return Session
 */
function session(): Session
{
    return (new Session());
}

/**
 * Components\Message\Message ***************************************
 */

/**
 * Instância
 * @return Message
 */
function message(): Message
{
    return (new Message());
}

/**
 * Obtem instância de Message da sessão
 * @return Message|null
 */
function message_flash(): ?Message
{
    return (new Message())->flash();
}

/**
 * Components\Uploader\Uploader ***************************************
 */

/**
 * Instância
 * Diretório de upload definido de acordo como definido em '.env'
 * @return Uploader
 */
function uploader(): Uploader
{
    return (new Uploader(CONF_BASE_DIR . CONF_UPLOAD_BASE_DIR));
}

/**
 * @param array $image
 * @param string $subdir
 * @return Uploader
 */
function uploader_image(array $image, string $subdir = CONF_UPLOAD_IMAGES_DIR): Uploader
{
    return uploader()->image($image, $subdir);
}

/**
 * @param array $media
 * @param string $subdir
 * @return Uploader
 */
function uploader_media(array $media, string $subdir = CONF_UPLOAD_MEDIAS_DIR): Uploader
{
    return uploader()->media($media, $subdir);
}

/**
 * @param array $file
 * @param string $subdir
 * @return Uploader
 */
function uploader_file(array $file, string $subdir = CONF_UPLOAD_FILES_DIR): Uploader
{
    return uploader()->file($file, $subdir);
}

/**
 * Components\* ***************************************
 */

