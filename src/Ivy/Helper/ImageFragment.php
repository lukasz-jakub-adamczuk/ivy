<?php

namespace Ivy\Helper;

class ImageFragment {

	public static function handleImageFragment($mId, $sImageType, $iImageTypeId, $sObject) {
		if (!empty($_POST['fragment'][$sImageType]['fragment'])) {
			// id_fragment
			$iFragmentId = $_POST['fragment'][$sImageType]['id_fragment'];

			if ($iFragmentId) {
				// update of existing fragment
				$oFragmentEntity = Dao::entity('fragment', $iFragmentId, 'id_fragment');
				
				$oFragmentEntity->setFields($_POST['fragment'][$sImageType]);

				$oFragmentEntity->setField('id_fragment_type', $iImageTypeId);
				$oFragmentEntity->setField('id_author', $_POST['dataset']['id_author']);

				// no creation date
				if (!isset($_POST['fragment'][$sImageType]['creation_date'])) {
					$oFragmentEntity->setField('creation_date', date('Y-m-d H:i:s'));
				}

				if ($oFragmentEntity->update()) {
					// manage object_fragment
					$oObjectFragmentEntity = Dao::entity('object_fragment', $_POST['hidden'][$sImageType]['id_object_fragment'], 'id_object_fragment');
				
					$oObjectFragmentEntity->setField('id_fragment', $iFragmentId);
					$oObjectFragmentEntity->setField('id_object', $mId);
					$oObjectFragmentEntity->setField('object', $sObject);

					if ($_POST['hidden'][$sImageType]['id_object_fragment']) {
						// update
						if ($iObjectFragmentId = $oObjectFragmentEntity->update()) {
							$sFragmentIdString = '<span class="hidden" data-object-id="cover-photo-fragment-id" data-object-value="'.$iFragmentId.'">';
							$sObjectFragmentIdString = '<span class="hidden" data-object-id="cover-photo-fragment-object-id" data-object-value="'.$iObjectFragmentId.'">';

							MessageList::raiseInfo($sFragmentIdString.$sObjectFragmentIdString.'Fragment <strong>'.$_POST['fragment'][$sImageType]['fragment'].'</strong> został zmieni i przypisany.');
						}
					} else {
						// insert
						if ($iObjectFragmentId = $oObjectFragmentEntity->insert()) {
							$sFragmentIdString = '<span class="hidden" data-object-id="cover-photo-fragment-id" data-object-value="'.$iFragmentId.'">';
							$sObjectFragmentIdString = '<span class="hidden" data-object-id="cover-photo-fragment-object-id" data-object-value="'.$iObjectFragmentId.'">';

							MessageList::raiseInfo($sFragmentIdString.$sObjectFragmentIdString.'Fragment <strong>'.$_POST['fragment'][$sImageType]['fragment'].'</strong> został dodany i przypisany.');
						}
					}
				}
			} else {
				// insert new fragment
		
				$oFragmentEntity = Dao::entity('fragment', 0, 'id_fragment');
				
				$oFragmentEntity->setFields($_POST['fragment'][$sImageType]);

				// TODO be sure that cover is value '1'
				$oFragmentEntity->setField('id_fragment_type', $iImageTypeId);
				$oFragmentEntity->setField('id_author', $_POST['dataset']['id_author']);

				// no creation date
				if (!isset($_POST['fragment'][$sImageType]['creation_date'])) {
					$oFragmentEntity->setField('creation_date', date('Y-m-d H:i:s'));
				}

				if ($iFragmentId = $oFragmentEntity->insert()) {
					// insert new object_fragment

					if ($iFragmentId) {
						$oObjectFragmentEntity = Dao::entity('object_fragment', 0, 'id_object_fragment');
				
						$oObjectFragmentEntity->setField('id_fragment', $iFragmentId);
						$oObjectFragmentEntity->setField('id_object', $mId);
						$oObjectFragmentEntity->setField('object', $sObject);

						if ($iObjectFragmentId = $oObjectFragmentEntity->insert()) {
							$sCallbackString = '<span class="callback">runArticleInfoCallback</span>';
							$sFragmentIdString = '<span class="hidden" data-object-id="'.$sImageType.'-image-fragment-id" data-object-value="'.$iFragmentId.'">';
							$sObjectFragmentIdString = '<span class="hidden" data-object-id="'.$sImageType.'-image-fragment-object-id" data-object-value="'.$iObjectFragmentId.'">';

							MessageList::raiseInfo($sCallbackString.$sFragmentIdString.$sObjectFragmentIdString.'Fragment <strong>'.$_POST['fragment'][$sImageType]['fragment'].'</strong> został dodany i przypisany.');
						}
					}
				}
			}
		}
	}
}