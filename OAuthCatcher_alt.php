<?php
/**
 * INTER-Mediator
 * Copyright (c) INTER-Mediator Directive Committee (http://inter-mediator.org)
 * This project started at the end of 2009 by Masayuki Nii msyk@msyk.net.
 *
 * INTER-Mediator is supplied under MIT License.
 * Please see the full license for details:
 * https://github.com/INTER-Mediator/INTER-Mediator/blob/master/dist-docs/License.txt
 *
 * @copyright     Copyright (c) INTER-Mediator Directive Committee (http://inter-mediator.org)
 * @link          https://inter-mediator.com/
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

setlocale(LC_ALL, 'ja_JP', 'ja');
date_default_timezone_set('Asia/Tokyo');
// The variable pathToIM has to point the INTER-Mediator directory.
$pathToIM = "./vendor/inter-mediator/inter-mediator";   // Modify this to match your directories.
require_once("{$pathToIM}/INTER-Mediator.php"); // Loading INTER-Mediator and relevant libraries.
use INTERMediator\Auth\OAuthAuth;
use INTERMediator\DB\Proxy_ExtSupport;

class AccountInfo
{
    use Proxy_ExtSupport;

    public function getMaxIDNumber(): int
    {
        $dataSource = [[
            'name' => 'maxuserid',
            'aggregation-select' => 'max(id) as maxuserid',
            'aggregation-from' => 'authuser',]];
        $reesult = $this->dbRead('maxuserid', null, null, $dataSource);
        if (!isset($reesult[0]['maxuserid'])) {
            return 0;
        }
        return $reesult[0]['maxuserid'];
    }

    public function getUsername(string $sub): ?string
    {
        $dataSource = [['name' => 'authuser', 'key' => 'id', 'records' => 1,]];
        $reesult = $this->dbRead('authuser', ['sub' => $sub], null, $dataSource);
        if (!isset($reesult[0]['username'])) {
            return null;
        }
        return $reesult[0]['username'];
    }
}

$authObj = new OAuthAuth($_GET["state"]);
//$authObj->debugMode = true; // or comment here
$authObj->setDoRedirect(false);
if (!$authObj->isActive) {
    echo "Missing parameters for OAuth authentication. "
        . ($_GET['error_description'] ?? "")
        . $authObj->errorMessages();
    exit;
}
$err = "No Error";
$jsCode = "";
if ($authObj->afterAuth()) { // Checking whether the authentication is successful.
    $infoObj = new AccountInfo();
    $username = $infoObj->getUsername($authObj->getUserInfo()['sub']);
    if (is_null($username)) {
        $username = "a" . (($infoObj->getMaxIDNumber() + 1) + 20000);
    }
    $newPassword = IMUtil::generatePassword(10);
    $authObj->userInfoToLogin($username, $newPassword, true, true); // Set up user and automatic login.
    if ($authObj->debugMode) {
        $err = $authObj->errorMessages();
    }
    $param = $authObj->isCreate() ? "new" : "update";
    $jsCode = "location.href = '/enroll.html?mode={$param}';";
} else {
    $err = $authObj->errorMessages();
}
header("Content-Type: text/html; charset=UTF-8");

?>
<html>
<head>
    <script type="text/javascript"><?php echo $jsCode; ?></script>
</head>
<body>
Provider: <?php echo $authObj->oAuthProvider(); ?><br>
Status: <?php echo $err; ?>
<hr/>
<p>This page must be redirected to another page.</p>
</body>
</html>

