function confirming(){
  location.href = INTERMediatorOnPage.oAuthParams["MyNumberCard-Sandbox"]["AuthURL"]
}

INTERMediatorOnPage.doBeforeConstruct = function () {
  INTERMediatorLog.suppressDebugMessageOnPage = true;
  const params = INTERMediatorOnPage.getURLParametersAsArray()
  let nodes;
  if(params['mode'] && params['mode'] == 'new'){
    nodes = document.querySelectorAll(".updatemsg")
  } else if (params['mode'] && params['mode'] == 'update') {
    nodes = document.querySelectorAll(".newmsg")
  }
  if(nodes) {
    [...nodes].map((node) => {
      node.style.display = "none"
    })
  }
}

INTERMediatorOnPage.doAfterConstruct = function () {
  const button = document.getElementById("_im_oauthbutton_mynumbercard")
}



