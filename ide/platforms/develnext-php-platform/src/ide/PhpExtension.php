<?php
namespace ide;

use ide\project\supports\JavaFXProjectSupport;
use ide\project\supports\jppm\JPPMAppPluginSupport;
use ide\project\supports\JPPMProjectSupport;
use ide\project\supports\PHPProjectSupport;

/**
 * Class PhpExtension
 * @package ide
 */
class PhpExtension extends AbstractExtension
{
    public function onRegister()
    {
        Ide::get()->registerProjectSupport(PHPProjectSupport::class);
        Ide::get()->registerProjectSupport(JPPMProjectSupport::class);
        Ide::get()->registerProjectSupport(JPPMAppPluginSupport::class);
    }

    public function onIdeStart()
    {
    }

    public function onIdeShutdown()
    {
    }
}