<?php
namespace ide\project;

use framework\core\Component;
use framework\core\Event;

/**
 * Class ProjectRunDebugManager
 * @package ide\project
 */
class ProjectRunDebugManager extends Component
{
    /**
     * @var Project
     */
    private $project;

    /**
     * @var array
     */
    private $items = [];

    /**
     * ProjectRunDebugManager constructor.
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        parent::__construct();

        $this->project = $project;
    }

    /**
     * @param string $code
     * @param array $config
     */
    public function add(string $code, array $config)
    {
        $this->trigger(new Event('add', $this, null, ['code' => $code, 'config' => $config]));
        $this->trigger(new Event('change', $this));
        $this->items[$code] = $config;
    }

    public function get(string $code): ?array
    {
        return $this->items[$code];
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function has(string $code): bool
    {
        return isset($this->items[$code]);
    }

    public function remove(string $code)
    {
        $this->trigger(new Event('remove', $this, null, ['code' => $code]));
        $this->trigger(new Event('change', $this));
        unset($this->items[$code]);
    }
}