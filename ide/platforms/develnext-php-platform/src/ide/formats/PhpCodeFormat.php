<?php
namespace ide\formats;

use ide\autocomplete\php\PhpAutoComplete;
use ide\editors\AbstractEditor;
use ide\editors\CodeEditor;
use ide\editors\highlighters\PhpHighlighter;
use ide\editors\support\CodeArea;
use ide\editors\TextEditor;
use ide\Ide;
use ide\project\behaviours\PhpProjectBehaviour;
use php\gui\designer\UXPhpCodeArea;
use php\lib\arr;
use php\lib\fs;

/**
 * Class PhpCodeFormat
 * @package ide\formats
 */
class PhpCodeFormat extends AbstractFormat
{
    /**
     * @param $file
     *
     * @param array $options
     * @return AbstractEditor
     * @throws \Exception
     */
    public function createEditor($file, array $options = [])
    {
        $codeEditorOptions = [
            'textArea' => new UXPhpCodeArea()
        ];
        $codeEditorOptions['autoComplete'] = [
            'context' => 'php',
            'class' => PhpAutoComplete::class
        ];
        $editor = new CodeEditor($file, 'php', $codeEditorOptions);
        $editor->setEmbedded((bool) $options['embedded']);
        if ($options['readOnly']) {
            $editor->setReadOnly(true);
        }
        return $editor;
    }

    public function getIcon()
    {
        return 'icons/phpFile16.png';
    }

    /**
     * @param $file
     *
     * @return bool
     */
    public function isValid($file)
    {
        return arr::has(['php', 'phpt'], fs::ext($file));
    }

    /**
     * @param $any
     *
     * @return mixed
     */
    public function register($any)
    {
    }
}