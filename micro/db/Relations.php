<?php /** RelationsMicro */

namespace Micro\db;

/**
 * Relations class file.
 *
 * @author Oleg Lunegov <testuser@mail.linpax.org>
 * @link https://github.com/lugnsk/micro
 * @copyright Copyright &copy; 2013 Oleg Lunegov
 * @license /LICENSE
 * @package micro
 * @subpackage db
 * @version 1.0
 * @since 1.0
 */
class Relations
{
    /** @var array $data relations setup */
    protected $data;

    /**
     * Setup a relation
     *
     * @access public
     *
     * @param        $name
     * @param bool   $isMany
     * @param string $model
     * @param array  $on
     * @param string $where
     * @param array  $params
     *
     * @return void
     */
    public function add( $name, $model, $isMany = false, array $on = [ ], $where = '', array $params = [ ] )
    {
        $this->data[$name] = [
            'IsMany' => $isMany,
            'Model'  => $model,
            'On'     => $on,
            'Where'  => $where,
            'Params' => $params
        ];
    }

    /**
     * Get relation config by name
     *
     * @access public
     *
     * @param string $name
     *
     * @return array
     */
    public function get( $name )
    {
        return isset( $this->data[$name] ) ? $this->data[$name] : false;
    }
} 