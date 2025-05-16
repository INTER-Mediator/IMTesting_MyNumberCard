INTERMediatorOnPage.doBeforeConstruct = function () {
  INTERMediatorLog.suppressDebugMessageOnPage = true;
  INTERMediator.navigationLabel = [null, null, null, null, null, null, null, null, null, null, null, false];
}

INTERMediatorOnPage.doAfterConstruct = function () {
  document.querySelector("#loginuser").innerHTML = INTERMediatorOnPage.authUser()
}