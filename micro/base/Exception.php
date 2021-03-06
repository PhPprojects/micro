<?php /** MicroException */

namespace Micro\base;

use Micro\Micro;

/**
 * Exception specific exception
 *
 * @author Oleg Lunegov <testuser@mail.linpax.org>
 * @link https://github.com/lugnsk/micro
 * @copyright Copyright &copy; 2013 Oleg Lunegov
 * @license /LICENSE
 * @package micro
 * @version 1.0
 * @since 1.0
 */
class Exception extends \Exception
{
    /**
     * Magic convert object to string
     *
     * @access public
     *
     * @return mixed|string
     */
    public function __toString()
    {
        if (!defined('DEBUG_MICRO')) {
            $_POST['errors'] = ['Error - ' . $this->getMessage()];

            $config = Micro::getInstance()->config;

            /** @var \Micro\mvc\Controller $mvc controller */
            $mvc = new $config['errorController'];
            $mvc->action($config['errorAction']);

            error_reporting(0);

            return '';
        } else {
            return '"Error #' . $this->getCode() . ' - ' . $this->getMessage() . '"';
        }
    }
}