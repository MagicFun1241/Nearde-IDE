<?php

namespace ide\editors;

use ide\editors\highlighters\JsonHighlighter;
use ide\editors\highlighters\MarkDownHighlighter;
use ide\editors\support\CodeArea;
use ide\Ide;
use php\gui\UXNode;
use php\io\Stream;
use php\lib\fs;

class TextEditor extends AbstractEditor
{
    /**
     * @var CodeArea
     */
    private $editor;

    /**
     * TextEditor constructor.
     * @param $file
     * @throws \Exception
     */
    public function __construct($file)
    {
        parent::__construct($file);
        
        $this->editor = new CodeArea();
        $this->editor->addStylesheet(Ide::get()->getThemeManager()->getDefault()->getCodeEditorCssFile());
        
        switch (fs::ext($file)) {
            case "json":
                $this->editor->setHighlighter(JsonHighlighter::class);
                break;
            case "md":
            case "MD":
                $this->editor->setHighlighter(MarkDownHighlighter::class);
                break;
        }
    }

    public function load()
    {
        $this->editor->getRichArea()->appendText(Stream::getContents($this->getFile()));

        if ($this->editor->getHighlighter())
            $this->editor->getHighlighter()->applyHighlight();
    }

    public function save()
    {
        Stream::putContents($this->getFile(), $this->editor->getRichArea()->text);
    }

    /**
     * @return UXNode
     */
    public function makeUi()
    {
        return $this->editor;
    }

    /**
     * @return CodeArea
     */
    public function getEditor(): CodeArea
    {
        return $this->editor;
    }
}