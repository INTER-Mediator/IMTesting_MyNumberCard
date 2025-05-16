INTERMediatorOnPage.doBeforeConstruct = function () {
  INTERMediatorLog.suppressDebugMessageOnPage = true;
}

function setPassword(id) {
  const passwd = document.getElementById('inputpassword').value
  const hashvalue = INTERMediatorLib.generatePasswordHash(passwd)
  const context = IMLibContextPool.contextFromName('authuser')
  context.setDataWithKey(id, 'hashedpasswd', hashvalue)
}