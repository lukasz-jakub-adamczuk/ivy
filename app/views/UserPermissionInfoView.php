<?php
require_once AYA_DIR.'/Core/View.php';

class UserPermissionInfoView extends View {

	public function fill() {
		// user
		$iId = $_GET['id'];
		$oInstance = Dao::entity('user', $iId);

		$this->_renderer->assign('aFields', $oInstance->getFields());

		// user group
		$oUserGroups = Dao::collection('user-group');
		// $oUserGroups->orderby('name');
		$oUserGroups->load(-1);

		$this->_renderer->assign('aUserGroups', $oUserGroups->getRows());

		// permission group
		$oPermissionGroups = Dao::collection('permission-group');
		$oPermissionGroups->orderby('idx');
		$oPermissionGroups->load(-1);

		$this->_renderer->assign('aPermissionGroups', $oPermissionGroups->getRows());

		// permissions
		$oPermissions = Dao::collection('permission');
		$oPermissions->orderby('name');
		$oPermissions->load(-1);

		$aPermissions = $oPermissions->getRows();

		$aGroupedPermissions = array();
		foreach ($aPermissions as $pk => $perm) {
			$aGroupedPermissions[$perm['id_permission_group']][] = $perm;
		}

		$this->_renderer->assign('aPermissions', $aGroupedPermissions);

		// types
		$oTypes = Dao::collection('story-category');
		$oTypes->orderby('name');
		$oTypes->load(-1);

		$this->_renderer->assign('aTypes', $oTypes->getRows());

		// categories
		$oCategories = Dao::collection('article-category');
		$oCategories->orderby('name');
		$oCategories->load(-1);

		$this->_renderer->assign('aCategories', $oCategories->getRows());
	}
}