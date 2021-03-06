<?php /** MicroRegistry */

namespace Micro\base;

use Micro\Micro;

/**
 * Registry class file.
 *
 * @author Oleg Lunegov <testuser@mail.linpax.org>
 * @link https://github.com/lugnsk/micro
 * @copyright Copyright &copy; 2013 Oleg Lunegov
 * @license /LICENSE
 * @package micro
 * @version 1.0
 * @since 1.0
 * @final
 */
final class Registry
{
    /** @var array $data registry data */
    protected static $data = [];


    /**
     * Disable construct
     *
     * @access protected
     * @result void
     */
    protected function __construct()
    {
    }

    /**
     * Get registry value
     *
     * @access public
     *
     * @param string $name element name
     *
     * @return mixed
     * @static
     */
    public static function get($name = '')
    {
        self::configure($name);
        return (!empty(self::$data[$name])) ? self::$data[$name] : null;
    }

    /**
     * Get component's
     *
     * @access public
     *
     * @param null $name name element to initialize
     *
     * @throws \Micro\base\Exception
     * @static
     */
    public static function configure($name = null)
    {
        if ($name AND !empty(self::$data[$name])) {
            return;
        }

        if (!empty(Micro::getInstance()->config['components'])) {
            /** @var array $configs */
            $configs = Micro::getInstance()->config['components'];
        } else {
            throw new Exception('Components not configured');
        }

        if ($name AND !empty($configs[$name])) {
            if (!self::loadComponent($name, $configs[$name])) {
                throw new Exception('Class ' . $name . ' error loading.');
            }

        } elseif ($name AND empty($configs[$name])) {
            throw new Exception('Class ' . $name . ' not configured.');

        } else {
            foreach ($configs AS $name => $options) {
                if (!self::loadComponent($name, $options)) {
                    throw new Exception('Class ' . $name . ' error loading.');
                }
            }
        }
    }

    /**
     * Load component
     *
     * @access public
     *
     * @param string $name component name
     * @param array $options component configs
     *
     * @return bool
     * @static
     */
    public static function loadComponent($name, $options)
    {
        if (empty($options['class'])) {
            return false;
        }

        if (!class_exists($options['class'])) {
            return false;
        }

        if (!empty($options['depends'])) {
            if (is_array($options['depends'])) {
                foreach ($options['depends'] AS $depend) {
                    self::configure($depend);
                }
            } else {
                self::configure($options['depends']);
            }
        }

        $className = $options['class'];
        unset($options['class']);

        self::$data[$name] = new $className($options);
        return true;
    }

    /**
     * Set registry value
     *
     * @access public
     *
     * @param string $name element name
     * @param mixed $value element value
     *
     * @return void
     * @static
     */
    public static function set($name, $value)
    {
        self::configure();
        self::$data[$name] = $value;

    }

    /**
     * Get all current values
     *
     * @access public
     * @return array
     * @static
     */
    public static function getAll()
    {
        self::configure();
        return self::$data;
    }

    /**
     * Disable clone
     *
     * @access protected
     * @return void
     */
    protected function __clone()
    {
    }
}
