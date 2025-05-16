INTERMediatorOnPage.doBeforeConstruct = function () {
  INTERMediatorLog.suppressDebugMessageOnPage = true
}

function confirming(){
  location.href = INTERMediatorOnPage.oAuthParams["MyNumberCard-Sandbox_Confirm"]["AuthURL"]
}