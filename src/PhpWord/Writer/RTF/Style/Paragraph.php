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
 * @link        https://github.com/PHPOffice/PHPWord
 * @copyright   2010-2014 PHPWord contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

namespace PhpOffice\PhpWord\Writer\RTF\Style;

use PhpOffice\PhpWord\Style\Alignment;

/**
 * RTF paragraph style writer
 *
 * @since 0.11.0
 */
class Paragraph extends AbstractStyle
{
    /**
     * Write style
     *
     * @return string
     */
    public function write()
    {
        $style = $this->getStyle();
        if (!$style instanceof \PhpOffice\PhpWord\Style\Paragraph) {
            return '';
        }

        $alignments = array(
            Alignment::ALIGN_LEFT => '\ql',
            Alignment::ALIGN_RIGHT => '\qr',
            Alignment::ALIGN_CENTER => '\qc',
            Alignment::ALIGN_BOTH => '\qj',
        );

        $align = $style->getAlign();
        $spaceAfter = $style->getSpaceAfter();
        $spaceBefore = $style->getSpaceBefore();

        $content = '\pard\nowidctlpar';
        if (isset($alignments[$align])) {
            $content .= $alignments[$align];
        }
        $content .= $this->getValueIf($spaceBefore !== null, '\sb' . $spaceBefore);
        $content .= $this->getValueIf($spaceAfter !== null, '\sa' . $spaceAfter);

        return $content;
    }
}