<?php
// wcf imports
require_once(WCF_DIR.'lib/data/user/User.class.php');
require_once(WCF_DIR.'lib/data/user/option/UserOptionOutput.class.php');
require_once(WCF_DIR.'lib/data/user/option/UserOptionOutputContactInformation.class.php');

/*
 * Implements an Xfire Profilefield
 * @svn			$Id: UserOptionOutputXFIRE.class.php 1417 2010-05-13 18:26:15Z TobiasH87 $
 * @author		Sani9000
 * @copyright	2009-2010 WoltLab Community
 * @license		Lesser General Public License <http://www.gnu.org/licenses/lgpl.html>
 * @package		com.woltlab.community.profile.xfire
*/
 
class UserOptionOutputXFIRE implements UserOptionOutput, UserOptionOutputContactInformation {
	protected $type = 'xfire';
	
	/*
	 * @see UserOptionOutput::getShortOutput()
	*/
	public function getShortOutput(User $user, $optionData, $value) {
		if (empty($value)) return '';
		return $this->getLink($user, $this->getImage($user, 'S'), $value);
	}

	/*
	 * @see UserOptionOutput::getMediumOutput()
	*/
  
	public function getMediumOutput(User $user, $optionData, $value) {
		if (empty($value)) return '';
		return $this->getLink($user, $this->getImage($user), $value);
	}
	
	/*
	 * @see UserOptionOutput::getOutput()
	*/
   
	public function getOutput(User $user, $optionData, $value) {
		if (empty($value)) return '';
		return $this->getImage($user) . ' ' . $this->getLink($user, StringUtil::encodeHTML($value), $value);
	}
	
	/*
	 * @see UserOptionContactInformation::getOutput()
	*/
   
	public function getOutputData(User $user, $optionData, $value) {
		if (empty($value)) return null;
	
		return array(
			'icon' => StyleManager::getStyle()->getIconPath($this->type.'M.png'),
			'title' => WCF::getLanguage()->get('wcf.user.option.'.$optionData['optionName']),
			'value' => StringUtil::encodeHTML($value),
			'url' => 'http://www.xfire.com/profile/'.StringUtil::encodeHTML($value)
		);
	}
	
	/*
	 * Returns the icon html code.
	 * 
	 * @return	string 
	*/
   
	protected function getImage(User $user, $imageSize = 'M') {
		$title = WCF::getLanguage()->get('wcf.user.profile.'.$this->type.'.title', array('$username' => StringUtil::encodeHTML($user->username)));
		return '<img src="'.RELATIVE_WCF_DIR.'icon/'.$this->type.$imageSize.'.png" alt="" title="'.$title.'" />';
	}
	
	/*
	 * Returns the link html code.
	 * 
	 * @return	string 
	*/
   
	protected function getLink(User $user, $title, $value) {
		return '<a href="http://www.xfire.com/profile/'.StringUtil::encodeHTML($value).'">'.$title.'</a>';
	}
}
?>