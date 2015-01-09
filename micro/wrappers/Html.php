<?php /** MicroHtml */

namespace Micro\wrappers;

/**
 * Html class file.
 *
 * @author Oleg Lunegov <testuser@mail.linpax.org>
 * @link https://github.com/antivir88/micro
 * @copyright Copyright &copy; 2013 Oleg Lunegov
 * @license /LICENSE
 * @package micro
 * @subpackage wrappers
 * @version 1.0
 * @since 1.0
 */
class Html
{
    // BASIC Elements
    /**
     * Render tag
     *
     * @access public
     * @param  string $name tag name
     * @param  array $attributes tag attributes
     * @return string
     * @static
     */
    public static function tag($name, array $attributes = [])
    {
        $result = '';
        foreach ($attributes AS $elem => $value) {
            $result .= ' ' . $elem . '="' . $value . '" ';
        }
        return '<' . $name . $result . '/>';
    }

    /**
     * Render open tag
     *
     * @access public
     * @param  string $name tag name
     * @param  array $attributes tag attributes
     * @return string
     * @static
     */
    public static function openTag($name, array $attributes = [])
    {
        $result = '';
        foreach ($attributes AS $key => $value) {
            $result .= ' ' . $key . '="' . $value . '"';
        }
        return '<' . $name . $result . '>';
    }

    /**
     * Render close tag
     *
     * @access public
     * @param  string $name tag name
     * @return string
     * @static
     */
    public static function closeTag($name)
    {
        return '</' . $name . '>';
    }

    /**
     * Base field tag
     *
     * @access private
     * @param  string $type type of element
     * @param  string $name name of element
     * @param  string $value value of element
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    private static function field($type, $name, $value = null, array $attributes = [])
    {
        $attributes['id'] = (isset($attributes['id'])) ? $attributes['id'] : $name;
        $attributes['type'] = $type;
        $attributes['name'] = $name;
        $attributes['value'] = $value;
        return self::tag('input', $attributes);
    }

    // HEAD Elements
    /**
     * Render link tag
     *
     * @access public
     * @param  string $name name of element
     * @param  string $url url path
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function link($name, $url, array $attributes = [])
    {
        $attributes['href'] = $url;
        return self::openTag('link', $attributes) . $name . self::closeTag('link');
    }

    /**
     * Render meta tag
     *
     * @access public
     * @param  string $name name of element
     * @param  string $content content of element
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function meta($name, $content, array $attributes = [])
    {
        $attributes['name'] = $name;
        $attributes['content'] = $content;
        return self::tag('meta', $attributes);
    }

    /**
     * Render favicon file
     *
     * @access public
     * @param string $url path to favicon
     * @return string
     * @static
     */
    public static function favicon($url)
    {
        return self::tag('link', ['href' => $url, 'rel' => 'shortcut icon', 'type' => 'image/x-icon']);
    }

    /**
     * Render css file
     *
     * @access public
     * @param  string $file path to css
     * @return string
     * @static
     */
    public static function cssFile($file)
    {
        return self::tag('link', ['href' => $file, 'rel' => 'stylesheet']);
    }

    /**
     * Render script file
     *
     * @access public
     * @param  string $file path to script
     * @return string
     * @static
     */
    public static function scriptFile($file)
    {
        return self::openTag('script', ['src' => $file, 'type' => 'text/javascript']) . self::closeTag('script');
    }

    /**
     * Render style source
     *
     * @access public
     * @param  string $text style
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function css($text, array $attributes = [])
    {
        $attributes['type'] = 'text/css';
        return self::openTag('style', $attributes) . $text . self::closeTag('style');
    }

    /**
     * Render script source
     *
     * @access public
     * @param  string $text script
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function script($text, array $attributes = [])
    {
        $attributes['type'] = 'text/javascript';
        return self::openTag('script',
            $attributes) . " /*<![CDATA[*/ " . $text . " /*]]>*/ " . self::closeTag('script');
    }

    /**
     * Render docType tag
     *
     * @access public
     * @param  string $name doctype name
     * @return string|boolean
     * @static
     */
    public static function doctype($name)
    {
        $docTypes = array(
            'xhtml11' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">',
            'xhtml1-trans' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
            'xhtml1-strict' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
            'xhtml1-frame' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">',
            'html4-trans' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">',
            'html4-strict' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">',
            'html4-frame' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">',
            'html5' => '<!DOCTYPE html>',
        );

        if (!isset($docTypes[$name])) {
            return false;
        }
        return $docTypes[$name];
    }

    /**
     * Render title tag
     *
     * @access public
     * @param string $name title name
     * @return string
     * @static
     */
    public static function title($name)
    {
        return self::openTag('title') . $name . self::closeTag('title');
    }

    // BODY Elements
    /**
     * Render BR tag
     *
     * @access public
     * @param integer $num number of render BR's
     * @param array $attributes attributes tag
     * @return string
     * @static
     */
    public static function br($num = 1, array $attributes = [])
    {
        $str = '';
        for ($i = 0; $i < $num; $i++) {
            $str .= self::tag('br', $attributes);
        }
        return $str;
    }

    /**
     * Render image file
     *
     * @access public
     * @param  string $name name of image
     * @param  string $file path image file
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function image($name, $file, array $attributes = [])
    {
        $attributes['src'] = $file;
        $attributes['alt'] = $name;
        return self::tag('img', $attributes);
    }

    /**
     * Render mail a tag
     *
     * @access public
     * @param  string $name name of e-mail
     * @param  string $email e-mail path
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function mailto($name, $email, array $attributes = [])
    {
        $attributes['href'] = 'mailto:' . $email;
        return self::openTag('a', $attributes) . $name . self::closeTag('a');
    }

    /**
     * Render anchor
     *
     * @access public
     * @param string $name name to link
     * @param string $url path to link
     * @param array $attributes attributes tag
     * @return string
     * @static
     */
    public static function href($name, $url, array $attributes = [])
    {
        $attributes['href'] = $url;
        return self::openTag('a', $attributes) . $name . self::closeTag('a');
    }

    /**
     * Render H{1-N} tag
     *
     * @access public
     * @param  string $num H number
     * @param  string $value H value
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function heading($num, $value = null, array $attributes = [])
    {
        return self::openTag('h' . $num, $attributes) . $value . self::closeTag('h' . $num);
    }

    /**
     * Render applet tag
     *
     * @access public
     * @return string
     * @static
     */
    public static function applet()
    {
        return '';
    }

    /**
     * Render image map tag
     *
     * @access public
     * @return string
     * @static
     */
    public static function imgmap()
    {
        return '';
    }

    /**
     * Render object tag
     *
     * @access public
     * @return string
     * @static
     */
    public static function object()
    {
        return '';
    }

    // LIST Elements
    /**
     * List elements generator
     *
     * @access public
     * @param array $items lists multiple array
     * @param array $attributes attributes tag
     * @return string
     * @static
     */
    public static function lists( array$items = [], array $attributes = [])
    {
        $result = null;
        foreach ($items AS $item) {
            $result .= Html::openTag('li', (isset($item['attr'])) ? $item['attr'] : []);
            if (isset($item['parents'])) {
                $result .= ($item['text']) ? $item['text'] : null;
                $result .= self::lists($item['parents'], (isset($item['parentsAttr'])) ? $item['parentsAttr'] : []);
            } else {
                $result .= $item['text'];
            }
            $result .= Html::closeTag('li');
        }
        return self::openTag('ul', $attributes) . $result . self::closeTag('ul');
    }

    // TABLE Elements
    /**
     * Render table element
     *
     * How to use $elements:
     * array(
     *     array( // row
     *         'cells'=>array( // cell
     *             'value'=>'text',
     *             'attributes'=>[]
     *         ),
     *         attributes'=>[]
     *     )
     * )
     *
     * @access public
     * @param array $elements table elements
     * @param array $attributes attributes tag
     * @return string
     * @static
     */
    public static function table(array $elements = [], array $attributes = [])
    {
        $output = null;
        foreach ($elements AS $value) {
            $output .= self::tableRow(
                (isset($value['cells'])) ? $value['cells'] : [],
                (isset($value['header'])) ? $value['header'] : false,
                (isset($value['attributes'])) ? $value['attributes'] : []
            );
        }
        return self::beginTable($attributes) . $output . self::endTable();
    }

    /**
     * Render begin table element
     *
     * @access public
     * @param array $attributes attributes tag
     * @return string
     * @static
     */
    public static function beginTable(array $attributes = [])
    {
        return self::openTag('table', $attributes);
    }

    /**
     * Render end table element
     *
     * @access public
     * @return string
     * @static
     */
    public static function endTable()
    {
        return self::closeTag('table');
    }

    /**
     * Render table caption element
     *
     * @access public
     * @param string $text table caption text
     * @param array $attributes attributes tag
     * @return string
     * @static
     */
    public static function tableCaption($text, array $attributes = [])
    {
        return self::openTag('caption', $attributes) . $text . self::closeTag('caption');
    }

    /**
     * Render table row element
     *
     * @access public
     * @param array $elements array(value, attributes)
     * @param boolean $isHeading row is heading?
     * @param array $attributes attributes tag
     * @return string
     * @static
     */
    public static function tableRow(array $elements = [], $isHeading = false, array $attributes = [])
    {
        $output = null;
        foreach ($elements AS $value) {
            if ($isHeading == false) {
                $output .= self::tableCell(
                    (isset($value['value'])) ? $value['value'] : [],
                    (isset($value['attributes'])) ? $value['attributes'] : []
                );
            } else {
                $output .= self::tableHeading(
                    (isset($value['value'])) ? $value['value'] : [],
                    (isset($value['attributes'])) ? $value['attributes'] : []
                );
            }
        }
        return self::openTag('tr', $attributes) . $output . self::closeTag('tr');
    }

    /**
     * Render table heading tag
     *
     * @access public
     * @param string $text table heading text
     * @param array $attributes attributes tag
     * @return string
     * @static
     */
    public static function tableHeading($text, array $attributes = [])
    {
        return self::openTag('th', $attributes) . $text . self::closeTag('th');
    }

    /**
     * Render table cell element
     *
     * @access public
     * @param string $text table cell text
     * @param array $attributes attributes tag
     * @return string
     * @static
     */
    public static function tableCell($text, array $attributes = [])
    {
        return self::openTag('td', $attributes) . $text . self::closeTag('td');
    }

    // FORM Elements
    /**
     * Render begin form tag
     *
     * @access public
     * @param  string $action path to URL action
     * @param  string $method method of request
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function beginForm($action, $method = 'POST', array $attributes = [])
    {
        $attributes['action'] = $action;
        $attributes['method'] = $method;
        return self::openTag('form', $attributes);
    }

    /**
     * Render end form tag
     *
     * @access public
     * @return string
     * @static
     */
    public static function endForm()
    {
        return self::closeTag('form');
    }

    /**
     * Render button tag
     *
     * @access public
     * @param  string $text text for button
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function button($text, array $attributes = [])
    {
        return self::openTag('button', $attributes) . $text . self::closeTag('button');
    }

    /**
     * Render image button tag
     *
     * @access public
     * @param  string $name image name
     * @param  string $file image file path
     * @param  array $attributesButton attributes for button
     * @param  array $attributesImage attributes for image
     * @return string
     * @static
     */
    public static function imageButton($name, $file, array $attributesButton = [], array $attributesImage = [])
    {
        return self::button(self::image($name, $file, $attributesImage), $attributesButton);
    }

    /**
     * Render textArea tag
     *
     * @access public
     * @param  string $name textArea name
     * @param  string $text textArea text
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function textArea($name, $text, array $attributes = [])
    {
        $attributes['id'] = $name;
        $attributes['name'] = $name;
        return self::openTag('textarea', $attributes) . $text . self::closeTag('textarea');
    }

    /**
     * Render legend tag
     *
     * @access public
     * @param  string $text legend text
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function legend($text, array $attributes = [])
    {
        return self::openTag('legend', $attributes) . $text . self::closeTag('legend');
    }

    /**
     * Render label tag
     *
     * @access public
     * @param string $name label name
     * @param string $elemId element ID
     * @param array $attributes attributes tag
     * @return string
     * @static
     */
    public static function label($name, $elemId = '', array $attributes = [])
    {
        $attributes['for'] = $elemId;
        return self::openTag('label', $attributes) . $name . self::closeTag('label');
    }

    /**
     * Render option tag
     *
     * @access public
     * @param string $value option value
     * @param string $text label for option
     * @param array $attributes attributes tag
     * @return string
     * @static
     */
    public static function option($value, $text, array $attributes = [])
    {
        $attributes['value'] = $value;
        return self::openTag('option', $attributes) . $text . self::closeTag('option');
    }

    /**
     * Render optGroup tag
     *
     * @access public
     * @param string $label label for options group
     * @param array $options format array(value, text, attributes) OR array(label, options, attributes)
     * @param array $attributes attributes tag
     * @return string
     * @static
     */
    public static function optGroup($label, array $options = [], array $attributes = [])
    {
        $attributes['label'] = $label;
        $opts = '';
        foreach ($options AS $option) {
            if (isset($option['label'])) {
                $opts .= self::optgroup($option['label'], $option['options'], $option['attributes']);
            } else {
                $opts .= self::option($option['value'], $option['text'], $option['attributes']);
            }
        }
        return self::openTag('optgroup', $attributes) . $opts . self::closeTag('optgroup');
    }

    /**
     * Render dropDownList (select tag)
     *
     * @access public
     * @param string $name dropDown name
     * @param array $options format array(value, text, attributes) OR array(label, options, attributes)
     * @param array $attributes attributes tag
     * @return string
     * @static
     */
    public static function dropDownList($name, array $options = [], array $attributes = [])
    {
        $attributes['id'] = $name;
        $attributes['size'] = 1;

        return self::listbox($name, $options, $attributes);
    }

    /**
     * Render listBox (select tag)
     *
     * @access public
     * @param string $name listBox name
     * @param array $options format array(value, text, attributes) OR array(label, options, attributes)
     * @param array $attributes attributes tag
     * @return string
     * @static
     */
    public static function listBox($name, array $options = [], array $attributes = [])
    {
        if (isset($attributes['selected'])) {
            $selected = $attributes['selected'];
            unset($attributes['selected']);
        } else {
            $selected = null;
        }

        $attributes['name'] = $name;
        $opts = '';
        foreach ($options AS $option) {
            if (isset($option['label'])) {
                $opts .= self::optGroup($option['label'], $option['options'], $option['attributes']);
            } else {
                if ($option['value'] == $selected) {
                    $option['selected'] = 'selected';
                }

                $attr = [];
                if (isset($option['attributes'])) {
                    $attr = $option['attributes'];
                    unset($option['attributes']);
                }

                $text = '';
                if (isset($option['text'])) {
                    $text = $option['text'];
                    unset($option['text']);
                }

                $opts .= self::option($option['value'], $text, $attr);
            }
        }
        return self::openTag('select', $attributes) . $opts . self::closeTag('select');
    }

    /**
     * Render checkBoxList (input checkbox tags)
     *
     * @access public
     * @param string $name name for checkBox'es in list
     * @param array $checkboxes format array(text, value, attributes)
     * @param string $format %check% - checkbox , %text% - text
     * @param string $selected name selected element
     * @return string
     * @static
     */
    public static function checkBoxList($name, array $checkboxes = [], $format = '<p>%check% %text%</p>', $selected = '')
    {
        $checks = '';
        foreach ($checkboxes AS $checkbox) {
            if ($checkbox['value'] == $selected) {
                $checkbox['attributes']['selected'] = 'selected';
            }
            $check = self::checkboxField($name, $checkbox['value'], $checkbox['attributes']);
            $checks .= strtr(strtr($format, '%check%', $check), '%text%', $checkbox['text']);
        }
        return $checks;
    }

    /**
     * Render radio button list tag
     *
     * @access public
     * @param string $name radio name
     * @param array $radios format array(text, value, attributes)
     * @param string $format %radio% - radio , %text% - text
     * @param string $selected name selected element
     * @return string
     * @static
     */
    public static function radioButtonList($name, array $radios = [], $format = '<p>%radio% %text%</p>', $selected = '')
    {
        $rads = '';
        foreach ($radios AS $radio) {
            if ($radio['value'] === $selected) {
                $radio['attributes']['selected'] = 'selected';
            }
            $rad = self::radioField($name, $radio['value'], isset($radio['attributes'])?$radio['attributes']:[]);
            $rads .= str_replace(['%radio%','%text%'],[$rad,$radio['text']],$format);
        }
        return $rads;
    }

    // INPUT Elements
    /**
     * Render reset button tag
     *
     * @access public
     * @param  string $label text for label on button
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function resetButton($label = 'Reset', array $attributes = [])
    {
        $attributes['type'] = 'reset';
        $attributes['value'] = $label;
        return self::tag('input', $attributes);
    }

    /**
     * Render submit button tag
     *
     * @access public
     * @param  string $label text for label on button
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function submitButton($label = 'Submit', array $attributes = [])
    {
        $attributes['type'] = 'submit';
        $attributes['value'] = $label;
        return self::tag('input', $attributes);
    }

    /**
     * Render input button tag
     *
     * @access public
     * @param  string $name button name
     * @param  string $value button value
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function buttonField($name, $value = null, array $attributes = [])
    {
        return self::field('button', $name, $value, $attributes);
    }

    /**
     * Render input checkbox tag
     *
     * @access public
     * @param  string $name checkBox name
     * @param  string $value checkBox value
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function checkBoxField($name, $value = null, array $attributes = [])
    {
        return self::field('checkbox', $name, $value, $attributes);
    }

    /**
     * Render input file tag
     *
     * @access public
     * @param  string $name file name
     * @param  string $value file value
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function fileField($name, $value = null, array $attributes = [])
    {
        return self::field('file', $name, $value, $attributes);
    }

    /**
     * Render input hidden tag
     *
     * @access public
     * @param  string $name hidden name
     * @param  string $value hidden value
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function hiddenField($name, $value = null, array $attributes = [])
    {
        return self::field('hidden', $name, $value, $attributes);
    }

    /**
     * Render input image tag
     *
     * @access public
     * @param  string $name image name
     * @param  string $value image value
     * @param  string $srcFile path to image
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function imageField($name, $value = null, $srcFile, array $attributes = [])
    {
        $attributes['src'] = $srcFile;
        return self::field('image', $name, $value, $attributes);
    }

    /**
     * Render input password tag
     *
     * @access public
     * @param  string $name password name
     * @param  string $value password value
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function passwordField($name, $value = null, array $attributes = [])
    {
        return self::field('password', $name, $value, $attributes);
    }

    /**
     * Render input radio tag
     *
     * @access public
     * @param  string $name radio name
     * @param  string $value radio value
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function radioField($name, $value = null, array $attributes = [])
    {
        return self::field('radio', $name, $value, $attributes);
    }

    /**
     * Render input text tag
     *
     * @access public
     * @param  string $name text name
     * @param  string $value text value
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function textField($name, $value = null, array $attributes = [])
    {
        return self::field('text', $name, $value, $attributes);
    }

    /**
     * Render input color tag
     *
     * @access public
     * @param  string $name color name
     * @param  string $value color value
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function colorField($name, $value = null, array $attributes = [])
    {
        return self::field('color', $name, $value, $attributes);
    }

    /**
     * Render input date tag
     *
     * @access public
     * @param  string $name date name
     * @param  string $value date value
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function dateField($name, $value = null, array $attributes = [])
    {
        return self::field('date', $name, $value, $attributes);
    }

    /**
     * Render input datetime tag
     *
     * @access public
     * @param  string $name datetime name
     * @param  string $value datetime value
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function datetimeField($name, $value = null, array $attributes = [])
    {
        return self::field('datetime', $name, $value, $attributes);
    }

    /**
     * Render input datetime-local tag
     *
     * @access public
     * @param  string $name datetime-local name
     * @param  string $value datetime-local value
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function datetimeLocalField($name, $value = null, array $attributes = [])
    {
        return self::field('datetime-local', $name, $value, $attributes);
    }

    /**
     * Render input email tag
     *
     * @access public
     * @param  string $name email name
     * @param  string $value email value
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function emailField($name, $value = null, array $attributes = [])
    {
        return self::field('email', $name, $value, $attributes);
    }

    /**
     * Render input number tag
     *
     * @access public
     * @param  string $name number name
     * @param  string $value number value
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function numberField($name, $value = null, array $attributes = [])
    {
        return self::field('number', $name, $value, $attributes);
    }

    /**
     * Render input range tag
     *
     * @access public
     * @param  string $name range name
     * @param  string $value range value
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function rangeField($name, $value = null, array $attributes = [])
    {
        return self::field('range', $name, $value, $attributes);
    }

    /**
     * Render input search tag
     *
     * @access public
     * @param  string $name search name
     * @param  string $value search value
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function searchField($name, $value = null, array $attributes = [])
    {
        return self::field('search', $name, $value, $attributes);
    }

    /**
     * Render input tel tag
     *
     * @access public
     * @param  string $name telephone name
     * @param  string $value telephone value
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function telField($name, $value = null, array $attributes = [])
    {
        return self::field('tel', $name, $value, $attributes);
    }

    /**
     * Render input time tag
     *
     * @access public
     * @param  string $name time name
     * @param  string $value time value
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function timeField($name, $value = null, array $attributes = [])
    {
        return self::field('time', $name, $value, $attributes);
    }

    /**
     * Render input url tag
     *
     * @access public
     * @param  string $name url name
     * @param  string $value url path
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function urlField($name, $value = null, array $attributes = [])
    {
        return self::field('url', $name, $value, $attributes);
    }

    /**
     * Render input month tag
     *
     * @access public
     * @param  string $name month name
     * @param  string $value month value
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function monthField($name, $value = null, array $attributes = [])
    {
        return self::field('month', $name, $value, $attributes);
    }

    /**
     * Render input week tag
     *
     * @access public
     * @param  string $name week name
     * @param  string $value week value
     * @param  array $attributes attributes tag
     * @return string
     * @static
     */
    public static function weekField($name, $value = null, array $attributes = [])
    {
        return self::field('week', $name, $value, $attributes);
    }

    // HTML5 Only
    /**
     * Render charset tag
     *
     * @access public
     * @param  string $name charset name
     * @return string
     * @static
     */
    public static function charset($name)
    {
        return self::tag('meta', ['charset' => $name]);
    }

    /**
     * Render video tag
     *
     * @access public
     * @param array $sources format type=>src
     * @param array $tracks format array(kind, src, srclang, label)
     * @param array $attributes attributes tag
     * @param string $noCodec text
     * @return string
     * @static
     */
    public static function video(array $sources = [], array $tracks = [], array $attributes = [], $noCodec = '')
    {
        $srcs = '';
        foreach ($sources AS $name => $value) {
            $srcs .= self::tag('source', ['type' => $name, 'src' => $value]);
        }
        foreach ($tracks AS $track) {
            $srcs .= self::tag('track', [
                'kind' => $track['kind'],
                'src' => $track['src'],
                'srclang' => $track['srclang'],
                'label' => $track['label']
            ]);
        }
        return self::openTag('video', $attributes) . $srcs . $noCodec . self::closeTag('video');
    }

    /**
     * Render audio tag
     *
     * @access public
     * @param array $sources format type=>src
     * @param array $tracks format array(kind, src, srclang, label)
     * @param array $attributes attributes tag
     * @param string $noCodec text
     * @return string
     * @static
     */
    public static function audio(array $sources = [], array $tracks = [], array $attributes = [], $noCodec = '')
    {
        $srcs = '';
        foreach ($sources AS $name => $value) {
            $srcs .= self::tag('audio', ['type' => $name, 'src' => $value]);
        }
        foreach ($tracks AS $track) {
            $srcs .= self::tag('track', [
                'kind' => $track['kind'],
                'src' => $track['src'],
                'srclang' => $track['srclang'],
                'label' => $track['label']
            ]);
        }
        return self::openTag('audio', $attributes) . $srcs . $noCodec . self::closeTag('audio');
    }

    /**
     * Render canvas tag
     *
     * @access public
     * @param array $attributes attributes tag
     * @param string $noCodec text
     * @return string
     * @static
     */
    public static function canvas(array $attributes = [], $noCodec = '')
    {
        return self::openTag('canvas', $attributes) . $noCodec . self::closeTag('canvas');
    }
}