<?php
/**
 * This file is part of PHPWord - A pure PHP library for reading and writing
 * word processing documents.
 *
 * PHPWord is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPWord/contributors.
 *
 * @see         https://github.com/PHPOffice/PHPWord
 * @copyright   2010-2018 PHPWord contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

namespace PhpOffice\PhpWord\Writer\HTML\Element;

use \PhpOffice\PhpWord\Element\ListItemRun as ListItemRunElement;
use \PhpOffice\PhpWord\Element\ListItem as ListItemElement;
use PhpOffice\PhpWord\Settings;

/**
 * ListItem element HTML writer
 *
 * @since 0.10.0
 */
class ListItem extends AbstractElement
{
    /**
     * Write opening
     *
     * @return string
     */
    protected function writeOpening()
    {
        $content = '';

        $previous = $this->element->getPreviousElement();

        if(!($previous instanceof ListItemElement || $previous instanceof ListItemRunElement)) {
            $content .= '<ul>' . PHP_EOL;
        }

        $content .= '<li>';

        return $content;
    }

    /**
     * Write ending
     *
     * @return string
     */
    protected function writeClosing()
    {
        $content = '</li>' . PHP_EOL;

        $next = $this->element->getNextElement();

        if(!($next instanceof ListItemElement || $next instanceof ListItemRunElement)) {
            $content .= '</ul>' . PHP_EOL;
        }

        return $content;
    }

    /**
     * Write list item
     *
     * @return string
     */
    public function write()
    {
        if (!$this->element instanceof ListItemElement) {
            return '';
        }

        $content = '';

        $content .= $this->writeOpening();
        if (Settings::isOutputEscapingEnabled()) {
            $content .= $this->escaper->escapeHtml($this->element->getTextObject()->getText());
        } else {
            $content .= $this->element->getTextObject()->getText();
        }
        $content .= $this->writeClosing();

        return $content;
    }
}
