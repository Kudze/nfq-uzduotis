
//----------------- Navigation Bar
function InitializeNavbar(controllerID) {

    let el_navbarContent = document.getElementById(controllerID);
    if(el_navbarContent !== null) {
    
        let currentPageName = el_navbarContent.getAttribute("requestedPage");
        let el_navbarContentList = el_navbarContent.children[0];
    
        //Search for active navbar item.
        for(var i = 0; i < el_navbarContentList.children.length; i++) {
            let element = el_navbarContentList.children[i];

            if(element.getAttribute("pageName") == currentPageName)
                element.className = "nav-item nav-link active";

        }
    
    }

    else console.log("Navigation bar (" + controllerID + ") was not found!");
    

}
InitializeNavbar("navbarContent");