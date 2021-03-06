<?php /** MicroCookie */

namespace Micro\web;

/**
 * Cookie class file.
 *
 * @author Oleg Lunegov <testuser@mail.linpax.org>
 * @link https://github.com/lugnsk/micro
 * @copyright Copyright &copy; 2013 Oleg Lunegov
 * @license /LICENSE
 * @package micro
 * @subpackage web
 * @version 1.0
 * @since 1.0
 */
class Cookie
{
    /**
     * Get cookie
     *
     * @access public
     *
     * @param string $name cookie name
     *
     * @return mixed|bool
     */
    public function get($name)
    {
        return !empty($_COOKIE[$name]) ? $_COOKIE[$name] : false;
    }

    /**
     * Get all cookies
     *
     * @access public
     * @return mixed
     */
    public function getAll()
    {
        return $_COOKIE;
    }

    /**
     * Delete cookie
     *
     * @access public
     *
     * @param string $name cookie name
     *
     * @return bool
     */
    public function del($name)
    {
        if ($this->exists($name)) {
            return $this->set($name, false, time() - 3600);
        }
        return false;
    }

    /**
     * Exists cookie
     *
     * @access public
     *
     * @param string $name cookie name
     *
     * @return bool
     */
    public function exists($name)
    {
        return !empty($_COOKIE[$name]);
    }

    /**
     * Set cookie
     *
     * @access public
     *
     * @param string $name cookie name
     * @param mixed $value data value
     * @param int $expire life time
     * @param string $path path access cookie
     * @param string $domain domain access cookie
     * @param bool $secure use SSL?
     * @param bool $httponly disable on JS?
     *
     * @return bool
     */
    public function set($name, $value, $expire = 0, $path = '/', $domain = '', $secure = false, $httponly = true)
    {
        return setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
    }
}