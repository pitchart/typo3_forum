<?php
namespace Mittwald\Typo3Forum\Domain\Validator\Forum;
/*                                                                    - *
 *  COPYRIGHT NOTICE                                                    *
 *                                                                      *
 *  (c) 2012 Martin Helmich <typo3@martin-helmich.de>                   *
 *           All rights reserved                                        *
 *                                                                      *
 *  This script is part of the TYPO3 project. The TYPO3 project is      *
 *  free software; you can redistribute it and/or modify                *
 *  it under the terms of the GNU General Public License as published   *
 *  by the Free Software Foundation; either version 2 of the License,   *
 *  or (at your option) any later version.                              *
 *                                                                      *
 *  The GNU General Public License can be found at                      *
 *  http://www.gnu.org/copyleft/gpl.html.                               *
 *                                                                      *
 *  This script is distributed in the hope that it will be useful,      *
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of      *
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the       *
 *  GNU General Public License for more details.                        *
 *                                                                      *
 *  This copyright notice MUST APPEAR in all copies of the script!      *
 *                                                                      */



/**
 *
 * A validator class for author names. This class validates a username ONLY if
 * no user is currently logged in.
 *
 * @author     Ruven Fehling <r.fehling@mittwald.de>
 * @package    Typo3Forum
 * @subpackage Domain\Validator\Forum
 * @version    $Id$
 *
 * @copyright  2013 Ruven Fehling <r.fehling@mittwald.de>
 * @license    GNU Public License, version 2
 *             http://opensource.org/licenses/gpl-license.php
 *
 */
class TagValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {


	/**
	 * An instance of the tag repository.
	 * @var \Mittwald\Typo3Forum\Domain\Repository\Forum\TagRepository
	 * @inject
	 */
	protected $tagRepository;

	/**
	 * Check if $value is valid. If it is not valid, needs to add an error
	 * to Result.
	 *
	 * @param string $name
	 * @return void
	 */
	protected function isValid($name="") {
		$result = TRUE;

		if(trim($name) == "") {
			$this->addError('The name can\'t be empty!.', 1373871955);
			$result = FALSE;
		}
		$name = ucfirst($name);
		$res = $this->tagRepository->findTagWithSpecificName($name);
		if($res[0] != false) {
			$this->addError('The tag already exists!.', 1373871960);
			$result = FALSE;
		}
		return $result;
	}
}
