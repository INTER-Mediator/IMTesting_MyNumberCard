function confirming(){
  location.href = INTERMediatorOnPage.oAuthParams["MyNumberCard-Sandbox"]["AuthURL"]
}

INTERMediatorOnPage.doBeforeConstruct = function () {
  INTERMediatorLog.suppressDebugMessageOnPage = true;
}

INTERMediatorOnPage.doAfterConstruct = function () {
  const button = document.getElementById("_im_oauthbutton_mynumbercard")
}



